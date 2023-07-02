<?php
    function getAllCourses($db_connection) {
        $query = 'SELECT id, name, code, credit_hours FROM courses';

        $result = mysqli_query($db_connection, $query);
        $courses = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $courses;
    }

    function getCourseByID($course_id, $db_connection) {
        $query = 'SELECT * FROM courses WHERE id='.$course_id;

        $result = mysqli_query($db_connection, $query);
        $course = mysqli_fetch_assoc($result);

        return $course;
    }

    function getRegisteredCoursesByStudent($student_id, $db_connection) {
        $query = "SELECT name FROM courses c
                  INNER JOIN course_registration cr ON c.id = cr.course_id
                  WHERE cr.student_id = '".$student_id."'";

        $result = mysqli_query($db_connection, $query);

        $courses = array();

        foreach($result as $row) {
            array_push($courses, $row);
        }

        return $courses;
    }

    function getAllocatedCoursesByTeacher($teacher_id, $db_connection) {
        $query = "SELECT name from courses c
                  INNER JOIN course_allocation ca ON c.id = ca.course_id
                  WHERE ca.teacher_id = '".$teacher_id."'";

        $result = mysqli_query($db_connection, $query);

        $courses = array ();

        foreach ($result as $row) {
            array_push($courses, $row);
        }

        return $courses;
    }

    function deleteCourseById($course_id, $db_connection) {
        $query = 'DELETE  FROM courses WHERE id='.$course_id;

        mysqli_query($db_connection, $query);
    }
    

    function addCourse($course_name, $course_code, $credit_hours, $db_connection) {
        $query = "INSERT INTO courses (name, code, credit_hours) VALUES ('".$course_name."', '".$course_code."', '".$credit_hours."')";

        mysqli_query($db_connection, $query);
    }

    function updateCourseById($course_id, $course_name, $course_code, $credit_hours, $db_connection) {
        $query = "UPDATE courses SET 
                    name = '".$course_name."',
                    code = '".$course_code."',
                    credit_hours = '".$credit_hours."'
                    WHERE id = ".$course_id;

        mysqli_query($db_connection, $query);
    }
?>