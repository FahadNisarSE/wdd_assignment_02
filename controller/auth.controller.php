<?php
    function isUser($email, $password, $table_name, $db_connection) {
        $query = "SELECT * FROM  $table_name WHERE email='".$email."' AND password='".$password."'";

        $result = mysqli_query($db_connection, $query);
        
        $user = mysqli_fetch_assoc($result);

        return $user;
    }
?>