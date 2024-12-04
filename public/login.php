<?php
require_once('../private/initialize.php');

$errors = [];
$username = '';
$password = '';

if(is_post_request()) {
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  // Validations
  if(is_blank($username)) {
    $errors[] = "Username cannot be blank.";
  }
  if(is_blank($password)) {
    $errors[] = "Password cannot be blank.";
  }

  // if there were no errors, try to login
  if(empty($errors)) {
    // Find admin by username
    $user = Member::find_by_username($username);
    
    if($user != false && $user->verify_password($password)) {
      // Password matches
      $session->login($user);
      $_SESSION['user_level'] = $user->user_level;
      redirect_to(url_for('/members/show.php?id=' . $user->id));
    } else {
      // username not found or password does not match
      $errors[] = "Log in was unsuccessful.";
    }
  }
}

$page_title = 'Log in';
include(SHARED_PATH . '/public_header.php');
?>

<div id="main">
  <div id="page">
    <div class="login-form">
      <h1>Log in</h1>

      <?php echo display_errors($errors); ?>

      <form action="login.php" method="post">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" value="<?php echo h($username); ?>" />
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" value="" />
        </div>

        <div class="form-buttons">
          <input type="submit" name="submit" value="Log in" />
        </div>
      </form>

      <p>Don't have an account? <a href="<?php echo url_for('/signup.php'); ?>">Sign up here</a>.</p>
    </div>
  </div>
</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
