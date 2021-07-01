<?php
    function issetUser($email,$usernameQuery)
    {
        require_once "../database.php";
        
        $sql = "SELECT * FROM users WHERE email='$email' OR username='$usernameQuery'";
        $result = mysqli_query($con,$sql);
        
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            return true;
        }else{
            return false;
        }
    }

    function login($email,$password)
    {
        require_once "../database.php";
        
        $passwordHashed = md5($password);
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$passwordHashed'";
        $result = mysqli_query($con,$sql);
        
        $num_rows = mysqli_num_rows($result);
        $user = mysqli_fetch_assoc($result);
        if ($num_rows > 0) {
            $_SESSION['user_info'] = $user;
            return true;
        }else{
            return false;
        }
    }
    
    function createUser($email,$usernameQuery,$password)
    {
        require "../database.php";
        $passwordHashed = md5($password);
        $sql = "INSERT INTO users (email,username,password) VALUES('$email','$usernameQuery','$passwordHashed')";
        $result = mysqli_query($con,$sql);
        if ($result) {
            return true;
        }else{
            return false;
        }
    }
    
    function deleteProduct($id)
    {
        require_once "../database.php";
        $sql = "DELETE FROM products WHERE id='$id'";
        $result = mysqli_query($con,$sql);
        if ($result) {
            return true;
        }else{
            return false;
        }
    }

    
    function updateProduct($id,$name,$desciption,$precio)
    {
        require "../database.php";
            $sql = "UPDATE products SET name='$name',description='$desciption',price='$precio' WHERE id='$id'";
            $result = mysqli_query($con,$sql);
            
            echo $result;
            if ($result) {
                return true;
            }else{
                return false;
            }
    }

    
    function createProduct($name,$description,$precio)
    {
        require "../database.php";
        $sql = "INSERT INTO products (name,description,price) VALUES('$name','$description','$precio')";
        $result = mysqli_query($con,$sql);
        if ($result) {
            return true;
        }else{
            return false;
        }
    }
?>