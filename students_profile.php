<?php
$title = 'Student Profile ' . $_GET['id'];
include_once('component/header.php');
include_once('component/navbar.php');
include_once('utils/is_logged_in.php');
include_once('utils/connect_db.php');
require_once('controller/student.controller.php');
require_once('controller/course.controller.php');

$id = null;

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $student = getStudentByID($_GET['id'], $connection);
    $registered_courses = getRegisteredCoursesByStudent($_GET['id'], $connection);
}
?>

<section class="profile-container">
    <div class="profile-header">
        <h1 class="profile-heading">
            <?php echo $student['name'] ?>
        </h1>
        <button class="normal-button" onclick="window.location.href='students.php?action=edit&id=<?= $id ?>'">
            Edit
            <?= $student['name']; ?>
        </button>
    </div>
    <div class='profile-body'>
        <div>
            <strong>Roll no: </strong>
            <span>
                <?= $student['roll_no'] ?>
            </span>
        </div>
        <div>
            <strong>Registration: </strong>
            <span>
                <?= $student['registration'] ?>
            </span>
        </div>
        <div>
            <strong>Email: </strong>
            <span>
                <?= $student['email'] ?>
            </span>
        </div>
        <div>
            <strong>Registered Courses: </strong>
            <div class='course-container'>
                <?php foreach ($registered_courses as $course) { ?>
                    <span>
                        <?= $course['name'] ?>
                    </span>
                <?php } ?>
            </div>
        </div>
    </div>

</section>