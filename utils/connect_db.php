<?php
    try {
        $connection = mysqli_connect('localhost', 'root', '', 'learning_management_db');
    } catch (\Throwable $th) {
        die("DB Connection Error! ". mysqli_connect_error());
    }
?>