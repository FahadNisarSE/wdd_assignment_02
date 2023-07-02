<?php
    function log_out() {
        session_destroy();
    }

    if(isset($_GET['logout']) && $_GET['logout'] === 'true') {
        session_start();

        log_out();

        header('Location: index.php');
    }
?>