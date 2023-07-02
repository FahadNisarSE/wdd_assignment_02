<?php
    $title = isset($_GET['type']) ? $_GET['type'] : 'Students';
    include_once('component/header.php');
    include_once('component/navbar.php');
    include_once('utils/is_logged_in.php');
    include_once('utils/connect_db.php');

    $content = null;

    if (!isset($_GET['type']) || $_GET['type'] === 'students') {
        require_once('controller/student.controller.php');

        $content = getAllStudents($connection);

        // Logic to delete the students
        if (isset($_GET['action']) && $_GET['action'] === 'delete') {

            if (isset($_GET['id']) && !empty($_GET['id']))
                deleteStudentById($_GET['id'], $connection);

            header("Location: list.php");
        }

    } else if (isset($_GET['type']) && $_GET['type'] === 'teachers') {
        require_once('controller/teacher.controller.php');
        $content = getAllTeachers($connection);

        // Logic to delete the student
        if (isset($_GET['action']) && $_GET['action'] === 'delete') {

            if (isset($_GET['id']) && !empty($_GET['id']))
                deleteTeacherById($_GET['id'], $connection);

            header("Location: list.php?type=teachers");
        }

    } else if (isset($_GET['type']) && $_GET['type'] === 'courses') {
        require_once('controller/course.controller.php');
        $content = getAllCourses($connection);

        // Logic to delete the course
        if (isset($_GET['action']) && $_GET['action'] === 'delete') {

            if (isset($_GET['id']) && !empty($_GET['id']))
                deleteCourseById($_GET['id'], $connection);

            header("Location: list.php?type=courses");
        }
    }
?>
<div class="header">
    <h1>
        <?= isset($_GET['type']) ? $_GET['type'] : 'Students'; ?>
    </h1>
    <button class="normal-button">
        <a href="<?= $title ?>.php">
            Add
            <?= isset($_GET['type']) ? $_GET['type'] : 'Students'; ?>
        </a>
    </button>
</div>

<table class="list-table">
    <tr class="table-head">
        <?php foreach ($content[0] as $column_name => $row) { ?>
            <th>
                <?= $column_name ?>
            </th>
        <?php } ?>
        <th>
            Edit
        </th>
        <th>
            Delete
        </th>
        <th>
            View Profile
        </th>
    </tr>
    <?php foreach ($content as $index => $row) { ?>
        <tr class="table-row">
            <?php foreach ($row as $column_name => $data) { ?>
                <td>
                    <?= $data ?>
                </td>
            <?php } ?>
            <td>
                <a href="<?= $title ?>.php?action=edit&id=<?= $row['id'] ?>">Edit</a>
            </td>
            <td>
                <a href="list.php?action=delete&id=<?= $row['id'] ?>">Delete</a>
            </td>
            <td>
                <a href="<?= $title ?>_profile.php?id=<?= $row['id'] ?>">View</a>
            </td>
        </tr>
    <?php } ?>

</table>

<?php include_once('component/footer.php'); ?>