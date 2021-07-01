<?php
    session_start();    
    $_SESSION['logued'] = false;
    session_unset();
    header("Location: ../index.php");
?>