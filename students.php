<?php
    $title = isset($_GET['action']) ? 'Edit Students' : 'Add Students';
    include_once('component/header.php');
    include_once('component/navbar.php');
    include_once('utils/is_logged_in.php');
    include_once('utils/connect_db.php');
    require_once('controller/student.controller.php');
    require_once('controller/registered_courses.controller.php');

    $id = null;
    $name = null;
    $registration = null;
    $roll_no = null;
    $password = null;
    $email = null;
    $courses = null;

    if (isset($_GET['action']) && $_GET['action'] === 'edit') {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $student = getStudentByID($_GET['id'], $connection);
            $id = $student['id'];
            $name = $student['name'];
            $registration = $student['registration'];
            $roll_no = $student['roll_no'];
            $password = $student['password'];
            $email = $student['email'];

            $courses = getCoursesByStudentId($id, $connection);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $registration = isset($_POST['registration']) ? $_POST['registration'] : '';
        $roll_no = isset($_POST['roll_no']) ? $_POST['roll_no'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $updated_courses = isset($_POST['courses']) ? $_POST['courses'] : [];

        // Save editted course to the database
        if (isset($_GET['action']) && $_GET['action'] === 'edit') {
            updateStudentById($id, $name, $registration, $roll_no, $password, $email, $connection);
            udpateRegisteredCourses($id, $courses, $updated_courses, $connection);

            header('Location: list.php?type=students');
        }

        // Save new course to the database
        else {
            addStudent($name, $registration, $roll_no, $password, $email, $connection);
            addCourseRegistration($id, $updated_courses, $connection);

            header('Location: list.php?type=students');
        }
    }
?>
<main>
    <h1 class="login-heading">
        <?= isset($_GET['id']) ? "Edit Student Id=" . $_GET['id'] : "Add Student" ?>
    </h1>

    <form class="login-form" action="" method="post">
        <label class="login-label special-label" for="name"><input type="text" name="name" id="name" required
                placeholder="name" value=<?= $name ?>></label>
        <label class="login-label special-label" for="registration"><input type="text" name="registration"
                id="registration" required placeholder="registration no" value=<?= $registration ?>></label>
        <label class="login-label special-label" for="roll_no"><input type="text" name="roll_no" id="roll_no" required
                placeholder="roll no" value=<?= $roll_no ?>></label>
        <label class="login-label special-label" for="password"><input type="text" name="password" id="password"
                required placeholder="password" value=<?= $password ?>></label>
        <label class="login-label special-label" for="email"><input type="email" name="email" id="email" required
                placeholder="email" value=<?= $email ?>></label>
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
                    <label for=<?= $row['id'] ?>> <?= $row['id'] ?>     <?= $row['name'] ?></label>
                </div>
            <?php } ?>
        </div>
        <button class="normal-button">
            <?= isset($_GET['action']) && $_GET['action'] === 'edit' ? 'Update' : 'Add'; ?>
        </button>
    </form>
</main>

<?php include_once('component/footer.php'); ?>