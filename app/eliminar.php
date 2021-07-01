<?php
    require_once "../functions.php";
    session_start();
    $id = $_GET['id'];

    $deleted = deleteProduct($id);
    
    if ($deleted) {
        $_SESSION['message'] = "Producto eliminado correctamente...";
        $_SESSION['type'] = "danger";
        $fecha = new DateTime();
        $timestamp = $fecha->format('Y-m-d H:i:s') ;
        array_push($_SESSION['notifications'],"Producto ".$id." eliminado correctamente el ".$timestamp);
        header("Location: ../views/admin.php");
    }else{
        $_SESSION['message'] = "Error al eliminar el producto.";
        $_SESSION['type'] = "danger";
        $fecha = new DateTime();
        $timestamp = $fecha->format('Y-m-d H:i:s') ;
        array_push($_SESSION['notifications'],"Error al eliminar el producto ".$id." el ".$timestamp);
        header("Location: ../views/admin.php");
    }
?>