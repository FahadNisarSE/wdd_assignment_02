<?php
    $title = isset($_GET['action']) ? 'Edit Course' : 'Add Course';
    include_once('component/header.php');
    include_once('component/navbar.php');
    include_once('utils/is_logged_in.php');
    include_once('utils/connect_db.php');
    require_once('controller/course.controller.php');

    $course_id = null;
    $course_name = null;
    $course_code = null;
    $credit_hours= null;

    if (isset($_GET['action']) && $_GET['action'] === 'edit') {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $course = getCourseByID($_GET['id'], $connection);
            $course_id = $course['id'];
            $course_name = $course['name'];
            $course_code = $course['code'];
            $credit_hours = $course['credit_hours'];
        }
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $course_name = isset($_POST['course_name']) ? $_POST['course_name'] : '';
        $course_code = isset($_POST['course_code']) ? $_POST['course_code'] : '';
        $credit_hours = isset($_POST['credit_hours']) ? $_POST['credit_hours'] : '';

        // Save editted course to the database
        if(isset($_GET['action']) && $_GET['action'] === 'edit') {
            updateCourseById($course_id, $course_name, $course_code, $credit_hours, $connection);
            
            header('Location: list.php?type=courses');
        } 
        
        // Save new course to the database
        else {
            addCourse($course_name, $course_code, $credit_hours, $connection);

            header('Location: list.php?type=courses');
        }
    }
?>

<h1 class="login-heading">
    <?= isset($_GET['id']) ? "Edit Course Id=" . $_GET['id'] : "Add Course" ?>
</h1>

<form action="" method="post" class="login-form">
    <label class="login-label" for="course_name"><input type="text" name="course_name" id="course_name" placeholder="course_name" required value=<?= $course_name ?> ></label>
    <label class="login-label" for="course_code"><input type="text" name="course_code" id="course_code" placeholder="course_code" required value=<?= $course_code ?> ></label>
    <label class="login-label"for="credit_hours"><input type="text" name="credit_hours" id="credit_hours" placeholder="credit_hours" required value=<?= $credit_hours ?> ></label>
    <button class="normal-button"> <?= isset($_GET['action']) && $_GET['action'] ==='edit' ? 'Update' : 'Add'; ?> </button>
</form>

<?php include_once('component/footer.php'); ?>