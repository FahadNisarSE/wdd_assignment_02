<?php
$title = "Login";
include_once('component/header.php');
include_once('utils/connect_db.php');
include_once('controller/auth.controller.php');

// LOGIN LOGIC
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!$_POST['email'] && empty($_POST['email']))
        array_push($errors, "Invalid or empty email!");

    if (!$_POST['password'] && empty($_POST['password']))
        array_push($errors, "Invalid or empty password!");

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $user = isUser($_POST['email'], $_POST['password'], $_POST['role'], $connection);

        if ($user) {
            session_start();
            $_SESSION['username'] = $user['name'];
            header('Location: list.php');
        } else {
            array_push($errors, "Invalid email or Password.");
        }
    }
}
?>

<h1 class="login-heading">LMS | Login</h1>

<form action="" method="post" class="login-form">
    <label for="role" class="login-label">
        <select name="role" id="role">
            <option class="option-styles" value="students">student</option>
            <option class="option-styles" value="teachers">teacher</option>
        </select>
    </label>
    <label for="email" class="login-label">
        Email:
        <input type="email" name="email" id="email" placeholder="Enter you Email..." required>
    </label>
    <label for="password" class="login-label">
        Password:
        <input type="password" name="password" id="password" placeholder="Enter Password.." required>
    </label>
    <button type="submit" class="normal-button">LOG IN</button>

    <div class="errors">
        <?php foreach ($errors as $key => $value) { ?>
            <span>
                <?= $value ?>
            </span>
        <?php } ?>
    </div>
</form>

<?php include_once('component/footer.php'); ?>