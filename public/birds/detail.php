<?php
require_once('../../private/initialize.php');

$id = $_GET['id'] ?? '1';
$sql = "SELECT * FROM birds WHERE id = '" . $database->escape_string($id) . "'";
$result = $database->query($sql);
$bird = $result->fetch_assoc();

if(!$bird) {
  redirect_to(url_for('/index.php'));
}

$page_title = 'Bird Details: ' . h($bird['common_name']);
include(SHARED_PATH . '/public_header.php');
?>

<div id="main">
  <a href="<?php echo url_for('/index.php'); ?>">&laquo; Back to List</a>

  <div class="bird detail">
    <h1>Bird: <?php echo h($bird['common_name']); ?></h1>

    <div class="attributes">
      <dl>
        <dt>Name</dt>
        <dd><?php echo h($bird['common_name']); ?></dd>
      </dl>
      <dl>
        <dt>Habitat</dt>
        <dd><?php echo h($bird['habitat']); ?></dd>
      </dl>
      <dl>
        <dt>Food</dt>
        <dd><?php echo h($bird['food']); ?></dd>
      </dl>
      <dl>
        <dt>Conservation Status</dt>
        <dd><?php echo get_conservation_level($bird['conservation_id']); ?></dd>
      </dl>
      <dl>
        <dt>Backyard Tips</dt>
        <dd><?php echo h($bird['backyard_tips']); ?></dd>
      </dl>
    </div>
  </div>
</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
