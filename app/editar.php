<?php
    require_once "../functions.php";
    session_start();
    $id = $_POST['id'];
    $email = $_POST['newName'];
    $password = $_POST['newDescription'];
    $precio = $_POST['newPrecio'];

    $updated = updateProduct($id,$email,$password,$precio);
    
    if ($updated) {
        $_SESSION['message'] = "Producto editado correctamente...";
        $_SESSION['type'] = "success";
        $fecha = new DateTime();
        $timestamp = $fecha->format('Y-m-d H:i:s') ;
        array_push($_SESSION['notifications'],"Producto ".$id." editado correctamente el ".$timestamp);
        header("Location: ../views/admin.php");
    }else{
        $_SESSION['message'] = "Error al editar el producto.";
        $_SESSION['type'] = "danger";
        $fecha = new DateTime();
        $timestamp = $fecha->format('Y-m-d H:i:s') ;
        array_push($_SESSION['notifications'],"Error al editar el producto ".$id." el ".$timestamp);
        header("Location: ../views/admin.php");
    }
?>