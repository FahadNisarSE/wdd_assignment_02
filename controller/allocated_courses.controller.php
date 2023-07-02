<?php
    function getCoursesByTeachersId($teacher_id, $db_connection)
    {
        $query = "SELECT course_id FROM course_allocation WHERE teacher_id=" . $teacher_id;

        $result = mysqli_query($db_connection, $query);

        $allocated_courses = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $allocated_courses[] = $row['course_id'];
        }

        return $allocated_courses;
    }

    function addCourseAllocation($teacher_id, $course_ids, $db_connection)
    {
        foreach ($course_ids as $course_id) {
            $query = "INSERT INTO course_allocation (teacher_id, course_id) VALUES ('$teacher_id', '$course_id')";
            mysqli_query($db_connection, $query);
        }
    }

    function updateAllocatedCourses($teacher_id, $existing_courses, $updating_courses, $db_connection)
    {
        $courses_to_add = array();
        $courses_to_remove = array();

        $courses_to_add = array_diff($updating_courses, $existing_courses);
        $courses_to_remove = array_diff($existing_courses, $updating_courses);

        foreach ($courses_to_add as $course_id) {
            $insert_query = "INSERT INTO
                            course_allocation (teacher_id, course_id) 
                            VALUES ('$teacher_id', '$course_id')";

            mysqli_query($db_connection, $insert_query);
        }

        foreach ($courses_to_remove as $course_id) {
            $delete_query = "DELETE FROM
                            `course_allocation`
                            WHERE `teacher_id`='" . $teacher_id . "'
                            AND `course_id`='" . $course_id . "'";
            mysqli_query($db_connection, $delete_query);
        }
    }
?>