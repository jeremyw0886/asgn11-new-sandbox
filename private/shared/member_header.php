<!doctype html>
<html lang="en">
  <head>
    <title>WNC Birds - <?php echo h($page_title); ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/style.css'); ?>" />
  </head>
  <body>
    <header>
      <h1>WNC Birds</h1>
      <div class="user-info">
        Welcome, <?php echo $session->username; ?>
      </div>
      <nav>
        <ul>
          <li><a href="<?php echo url_for('/birds/index.php'); ?>">Birds</a></li>
          <?php if($session->user_level === 'A') { ?>
            <li><a href="<?php echo url_for('/members/index.php'); ?>">Members</a></li>
          <?php } ?>
          <li><a href="<?php echo url_for('/birds/about.php'); ?>">About Us</a></li>
          <li><a href="<?php echo url_for('/logout.php'); ?>">Logout</a></li>
        </ul>
      </nav>
    </header>
