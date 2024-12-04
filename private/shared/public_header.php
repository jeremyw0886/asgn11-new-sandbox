<?php
  if(!isset($page_title)) { $page_title = 'Bird Sanctuary'; }
?>

<!doctype html>
<html lang="en">
  <head>
    <title>WNC Birds - <?php echo h($page_title); ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/style.css'); ?>" />
  </head>

  <body>
    <header>
      <h1>Western North Carolina Birds</h1>
    </header>

    <navigation>
      <ul>
        <?php if($session->is_logged_in()) { ?>
          <li>User: <?php echo $session->username; ?></li>
          <li><a href="<?php echo url_for('/birds/index.php'); ?>">Birds</a></li>
          <li><a href="<?php echo url_for('/members/index.php'); ?>">Members</a></li>
          <li><a href="<?php echo url_for('/logout.php'); ?>">Logout</a></li>
        <?php } else { ?>
          <li><a href="<?php echo url_for('/login.php'); ?>">Login</a></li>
          <li><a href="<?php echo url_for('/signup.php'); ?>">Sign Up</a></li>
        <?php } ?>
      </ul>
    </navigation>

    <?php echo display_session_message(); ?>
