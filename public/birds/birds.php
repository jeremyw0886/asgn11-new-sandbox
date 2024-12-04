<?php
if(!isset($database)) {
    require_once('../../private/initialize.php');
}

// Get all birds from database
$sql = "SELECT * FROM birds";
$result = $database->query($sql);

// Check if query was successful
if (!$result) {
    exit("Database query failed.");
}

// Check if user is logged in to determine which actions to show
$logged_in = isset($session) && $session->is_logged_in();
?>

<table class="list">
    <tr>
        <th>Name</th>
        <th>Habitat</th>
        <th>Food</th>
        <th>Conservation</th>
        <th>Backyard Tips</th>
        <th>&nbsp;</th>
    </tr>

    <?php while($bird = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo h($bird['common_name']); ?></td>
            <td><?php echo h($bird['habitat']); ?></td>
            <td><?php echo h($bird['food']); ?></td>
            <td><?php echo h(Bird::CONSERVATION_OPTIONS[$bird['conservation_id']]); ?></td>
            <td><?php echo h($bird['backyard_tips']); ?></td>
            <td class="actions">
                <a class="action" href="<?php echo url_for('/birds/detail.php?id=' . h(u($bird['id']))); ?>">View</a>
                <?php if($logged_in) { ?>
                    <a class="action" href="<?php echo url_for('/birds/edit.php?id=' . h(u($bird['id']))); ?>">Edit</a>
                    <a class="action" href="<?php echo url_for('/birds/delete.php?id=' . h(u($bird['id']))); ?>">Delete</a>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
</table>

<?php
$result->free();
?>
