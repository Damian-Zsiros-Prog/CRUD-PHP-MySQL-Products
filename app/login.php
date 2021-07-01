<?php
    require_once "../functions.php";

    session_start();

    $email = $_POST['email'];
    $password = $_POST['password'];

    $logued = login($email,$password);

    if ($logued) {
        $_SESSION['logued'] = true;
        $_SESSION['message'] = "Logueado correctamente...";
        $_SESSION['type'] = "success";
        $_SESSION['notifications'] = [];
        $fecha = new DateTime();
        $timestamp = $fecha->format('Y-m-d H:i:s') ;
        array_push($_SESSION['notifications'],"Logueado correctamente en la fecha: ".$timestamp);
        header("Location: ../views/admin.php");
    }else{
        $_SESSION['logued'] = false;
        $_SESSION['message'] = "Usuario y/o password incorrectos.";
        $_SESSION['type'] = "danger";
        header("Location: ../index.php");
    }
?>