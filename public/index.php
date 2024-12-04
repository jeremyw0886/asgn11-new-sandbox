<?php 
require_once('../private/initialize.php');
$page_title = 'Home';
include(SHARED_PATH . '/public_header.php'); 
?>

<navigation>
  <ul>
    <?php if($session->is_logged_in()) { ?>
      <li>Welcome, <?php echo $session->username; ?></li>
      <li><a href="<?php echo url_for('/logout.php'); ?>">Log out</a></li>
    <?php } else { ?>
      <li><a href="<?php echo url_for('/login.php'); ?>">Log in</a></li>
      <li><a href="<?php echo url_for('/signup.php'); ?>">Sign Up</a></li>
    <?php } ?>
    <li><a href="<?php echo url_for('/birds/about.php'); ?>">About Us</a></li>
  </ul>
</navigation>

<div id="main">
    <div id="page">
        <h2>Bird inventory</h2>
        <p>This is a short list – start your birding!</p>
        <?php include('birds/birds.php'); ?>
    </div>
</div>

<?php 
include(SHARED_PATH . '/copyright_disclaimer.php');
include(SHARED_PATH . '/public_footer.php'); 
?>
