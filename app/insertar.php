<?php
    require_once "../functions.php";
    session_start();

    $name = $_POST['createName'];
    $description = $_POST['createDescription'];
    $precio = $_POST['createPrecio'];
    $created = createProduct($name,$description,$precio);
    
    if ($created) {
        $_SESSION['message'] = "Producto creado correctamente...";
        $_SESSION['type'] = "success";
        $fecha = new DateTime();
        $timestamp = $fecha->format('Y-m-d H:i:s') ;
        array_push($_SESSION['notifications'],"Producto creado correctamente el ".$timestamp);
        header("Location: ../views/admin.php");
    }else{
        $_SESSION['message'] = "Error al crear el producto.";
        $_SESSION['type'] = "danger";
        $fecha = new DateTime();
        $timestamp = $fecha->format('Y-m-d H:i:s') ;
        array_push($_SESSION['notifications'],"Error al crear producto el ".$timestamp);
        header("Location: ../views/admin.php");
    }
?>