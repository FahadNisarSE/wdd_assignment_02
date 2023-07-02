<?php
$title = 'Student Profile ' . $_GET['id'];
include_once('component/header.php');
include_once('component/navbar.php');
include_once('utils/is_logged_in.php');
include_once('utils/connect_db.php');
require_once('controller/teacher.controller.php');
require_once('controller/course.controller.php');

$id = null;

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $teacher = getTeacherByID($_GET['id'], $connection);
    $allocated_courses = getAllocatedCoursesByTeacher($_GET['id'], $connection);
}
?>

<section class="profile-container">
    <div class="profile-header">
        <h1 class="profile-heading">
            <?php echo $teacher['name'] ?>
        </h1>
        <button class="normal-button" onclick="window.location.href='teachers.php?action=edit&id=<?= $id ?>'">
            Edit
            <?= $teacher['name']; ?>
        </button>
    </div>
    <div class='profile-body'>
        <div>
            <strong>Email: </strong>
            <span>
                <?= $teacher['email'] ?>
            </span>
        </div>
        <div>
            <strong>Allocated Courses: </strong>
            <div class='course-container'>
                <?php foreach ($allocated_courses as $course) { ?>
                    <span>
                        <?= $course['name'] ?>
                    </span>
                <?php } ?>
            </div>
        </div>
    </div>
</section>