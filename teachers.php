<?php
    $title = isset($_GET['action']) ? 'Edit Students' : 'Add Students';
    include_once('component/header.php');
    include_once('component/navbar.php');
    include_once('utils/is_logged_in.php');
    include_once('utils/connect_db.php');
    require_once('controller/teacher.controller.php');
    require_once('controller/allocated_courses.controller.php');

    $id = null;
    $name = null;
    $password = null;
    $email = null;
    $courses = null;

    if (isset($_GET['action']) && $_GET['action'] === 'edit') {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $teacher = getTeacherByID($_GET['id'], $connection);
            $id = $teacher['id'];
            $name = $teacher['name'];
            $password = $teacher['password'];
            $email = $teacher['email'];

            $courses = getCoursesByTeachersId($id, $connection);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $updated_courses = isset($_POST['courses']) ? $_POST['courses'] : [];

        // Save editted course to the database
        if (isset($_GET['action']) && $_GET['action'] === 'edit') {
            updateTeacherById($id, $name, $email, $password, $connection);
            updateAllocatedCourses($id, $courses, $updated_courses, $connection);

            header('Location: list.php?type=teachers');
        }

        // Save new course to the database
        else {
            addTeacher($name, $email, $password, $connection);
            addCourseAllocation($id, $updated_courses, $connection);

            header('Location: list.php?type=teachers');
        }
    }

?>

<h1 class="login-heading">
    <?= isset($_GET['id']) ? "Edit Teacher Id=" . $_GET['id'] : "Add Teacher" ?>
</h1>

<form action="" method="post" class="login-form">
    <label class="login-label special-label" for="name"><input type="text" name="name" id="name" required placeholder="name"
            value=<?= $name ?>></label>
    <label class="login-label special-label" for="password"><input type="text" name="password" id="password" required
            placeholder="password" value=<?= $password ?>></label>
    <label class="login-label special-label" for="email"><input type="email" name="email" id="email" required placeholder="email"
            value=<?= $email ?>></label>
    <div class="check-box-container special-label">
        <?php
        $query = 'SELECT `id`, `name` FROM courses';
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="check-box-wrapper">
                <input type="checkbox" name="courses[]" value=<?= $row['id'] ?> id=<?= $row['id'] ?>     <?php
                          if (isset($_GET['action']) && $_GET['action'] === 'edit') {
                              echo in_array($row['id'], $courses) ? "checked" : '';
                          }
                          ?>>
                <label for=<?= $row['id'] ?>> <?= $row['id'] ?> <?= $row['name'] ?></label>
            </div>
        <?php } ?>
    </div>
    <button class="normal-button">
        <?= isset($_GET['action']) && $_GET['action'] === 'edit' ? 'Update' : 'Add'; ?>
    </button>
</form>

<?php include_once('component/footer.php'); ?>