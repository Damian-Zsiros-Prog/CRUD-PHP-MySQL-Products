<?php
    require_once "../functions.php";

    session_start();

    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];

    $issetUser = issetUser($email,$username);
    if (!$issetUser) {
        $created = createUser($email,$username,$password);
        if ($created) {
            $_SESSION['message'] = "Registrado correctamente...";
            $_SESSION['type'] = "success";
            header("Location: ../index.php");
        }else{
            $_SESSION['message'] = "Error en el registro del usuario...";
            $_SESSION['type'] = "danger";
            header("Location: ../register.php");
        }
    }else{
        $_SESSION['message'] = "Usuario ya existe...";
        $_SESSION['type'] = "danger";
        header("Location: ../register.php");
    }
?>