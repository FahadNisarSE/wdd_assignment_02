<?php
    function getAllStudents($db_connection) {
        $query = 'SELECT id, name, registration, roll_no, email FROM students';

        $result = mysqli_query($db_connection, $query);
        $students = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $students;
    }

    function getStudentByID($student_id, $db_connection) {
        $query = 'SELECT * FROM students WHERE id='.$student_id;

        $result = mysqli_query($db_connection, $query);
        $student = mysqli_fetch_array($result);

        return $student;
    }

    function deleteStudentById($student_id, $db_connection) {
        $query = "DELETE FROM students WHERE id=".$student_id;

        $result = mysqli_query($db_connection, $query);

        print_r($result);
    }

    function addStudent($name, $registration, $roll_no, $password, $email, $db_connection) {
        $query = "INSERT INTO students 
                    (name, registration, roll_no, password, email) VALUES
                    ('".$name."', '".$registration."', '".$roll_no."', '".$password."', '".$email."')";

        $result = mysqli_query($db_connection, $query);
    }

    function updateStudentById($id, $name, $registration, $roll_no, $password, $email, $db_connection) {
        $query = "UPDATE students SET 
                    name = '".$name."',
                    registration = '".$registration."',
                    roll_no = '".$roll_no."',
                    password = '".$password."',
                    email = '".$email."'
                    WHERE id = ".$id;

        $result = mysqli_query($db_connection, $query);
    }
?>