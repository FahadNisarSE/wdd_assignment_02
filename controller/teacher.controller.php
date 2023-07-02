<?php
    function getAllTeachers($db_connection) {
        $query = 'SELECT id, name, email FROM teachers';

        $result = mysqli_query($db_connection, $query);
        $teachers = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $teachers;
    }

    function getTeacherByID($teacher_id, $db_connection) {
        $query = 'SELECT * FROM teachers WHERE id='.$teacher_id;

        $result = mysqli_query($db_connection, $query);
        $teacher = mysqli_fetch_assoc($result);

        return $teacher;
    }

    function deleteTeacherById($teahcer_id, $db_connection) {
        $query = "DELETE FROM teachers WHERE id=".$teahcer_id;

        $result = mysqli_query($db_connection, $query);

        print_r($result);
    }

    function addTeacher($name, $email, $password, $db_connection) {
        $query = "INSERT INTO teachers (name, email, password) VALUES ('".$name."', '".$email."', '".$password."')";

        mysqli_query($db_connection, $query);
    }

    function updateTeacherById($id, $name, $email, $password, $db_connection) {
        $query = "UPDATE teachers SET 
                    name = '".$name."',
                    email = '".$email."',
                    password = '".$password."'
                    WHERE id = ".$id;

        mysqli_query($db_connection, $query);
    }
?>