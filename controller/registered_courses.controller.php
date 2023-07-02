<?php
  function getCoursesByStudentId($studentId, $db_connection)
  {
    $query = 'SELECT course_id FROM course_registration WHERE student_id=' . $studentId;

    $result = mysqli_query($db_connection, $query);
    $registered_courses = array();
    while ($row = mysqli_fetch_assoc($result)) {
      $registered_courses[] = $row['course_id'];
    }

    return $registered_courses;
  }

  function addCourseRegistration($student_id, $course_ids, $db_connection) {
    foreach ($course_ids as $course_id) {
      $query = "INSERT INTO course_registration (student_id, course_id) VALUES ('$student_id', '$course_id')";
      mysqli_query($db_connection, $query);
    }
  }

  function udpateRegisteredCourses($student_id, $existing_courses, $updating_courses, $db_connection)
  {
    $courses_to_add = array();
    $courses_to_remove = array();

    $courses_to_add = array_diff($updating_courses, $existing_courses);
    $courses_to_remove = array_diff($existing_courses, $updating_courses);

    foreach ($courses_to_add as $course_id) {
      $insert_query = "INSERT INTO 
                            `course_registration`
                            (`course_id`, `student_id`)
                            VALUES ('".$course_id."', '".$student_id."')";

      mysqli_query($db_connection, $insert_query);
    }

    foreach ($courses_to_remove as $course_id) {
      $delete_query = "DELETE FROM
                            `course_registration`
                            WHERE `student_id`='".$student_id."'
                            AND `course_id`='".$course_id."'";
      mysqli_query($db_connection, $delete_query);
    }
  }
?>