<?php
    session_start();

    if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
        
    } else {
        header('Location: index.php');
    }
?>