<?php
$title = 'Student Profile ' . $_GET['id'];
include_once('component/header.php');
include_once('component/navbar.php');
include_once('utils/is_logged_in.php');
include_once('utils/connect_db.php');
require_once('controller/course.controller.php');

$id = null;

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $course = getCourseByID($_GET['id'], $connection);
}
?>

<section class="profile-container">
    <div class="profile-header">
        <h1 class="profile-heading">
            <?php echo $course['name'] ?>
        </h1>
        <button class="normal-button" onclick="window.location.href='courses.php?action=edit&id=<?= $id ?>'">
            Edit
            <?= $course['name']; ?>
        </button>
    </div>
    <div class='profile-body'>
        <div>
            <strong>Course Code: </strong>
            <span>
                <?= $course['code'] ?>
            </span>
        </div>
        <div>
            <strong>Credit Hours: </strong>
            <span>
                <?= $course['credit_hours'] ?> Hrs
            </span>
        </div>
    </div>
</section>