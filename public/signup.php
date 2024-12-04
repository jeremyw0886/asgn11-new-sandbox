<?php
require_once('../private/initialize.php');

if(is_post_request()) {
  $args = $_POST['member'];
  $member = new Member($args);
  $result = $member->save();

  if($result === true) {
    $session->login($member);
    $_SESSION['user_level'] = $member->user_level;
    $session->message('You have signed up successfully.');
    redirect_to(url_for('/members/show.php?id=' . $member->id));
  } else {
    // show errors
  }
} else {
  // display the form
  $member = new Member;
}

$page_title = 'Sign Up';
include(SHARED_PATH . '/public_header.php');
?>

<div id="content">
  <h1>Sign Up</h1>

  <?php echo display_errors($member->errors); ?>

  <form action="<?php echo url_for('/signup.php'); ?>" method="post">

    <dl>
      <dt>First name</dt>
      <dd><input type="text" name="member[first_name]" value="<?php echo h($member->first_name); ?>" /></dd>
    </dl>

    <dl>
      <dt>Last name</dt>
      <dd><input type="text" name="member[last_name]" value="<?php echo h($member->last_name); ?>" /></dd>
    </dl>

    <dl>
      <dt>Email</dt>
      <dd><input type="text" name="member[email]" value="<?php echo h($member->email); ?>" /></dd>
    </dl>

    <dl>
      <dt>Username</dt>
      <dd><input type="text" name="member[username]" value="<?php echo h($member->username); ?>" /></dd>
    </dl>

    <dl>
      <dt>Password</dt>
      <dd><input type="password" name="member[password]" value="" /></dd>
    </dl>

    <dl>
      <dt>Confirm Password</dt>
      <dd><input type="password" name="member[confirm_password]" value="" /></dd>
    </dl>

    <p>
      Password requirements:
      <ul>
        <li>At least 12 characters long</li>
        <li>At least one uppercase letter</li>
        <li>At least one lowercase letter</li>
        <li>At least one number</li>
        <li>At least one symbol</li>
      </ul>
    </p>

    <div id="operations">
      <input type="submit" value="Sign Up" />
    </div>
  </form>

  <p>Already have an account? <a href="<?php echo url_for('/login.php'); ?>">Log in here</a>.</p>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
