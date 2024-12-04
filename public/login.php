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
    $member = Member::find_by_username($username);
    if($member != false && $member->verify_password($password)) {
      $session->login($member);
      redirect_to(url_for('/birds/birds.php'));
    } else {
      // username not found or password does not match
      $errors[] = "Log in was unsuccessful.";
    }
  }
}

$page_title = 'Log in';
include(SHARED_PATH . '/public_header.php');
?>

<div id="content">
  <h1>Log in</h1>

  <?php echo display_errors($errors); ?>

  <form action="login.php" method="post">
    <dl>
      <dt>Username</dt>
      <dd><input type="text" name="username" value="<?php echo h($username); ?>" /></dd>
    </dl>
    <dl>
      <dt>Password</dt>
      <dd><input type="password" name="password" value="" /></dd>
    </dl>
    <p>
      <input type="submit" name="submit" value="Log in" />
    </p>
  </form>
  
  <p>Don't have an account? <a href="<?php echo url_for('/signup.php'); ?>">Sign up here</a>.</p>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
