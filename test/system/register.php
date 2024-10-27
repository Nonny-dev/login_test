<?php

if (isset($_POST['register'])) {


    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    include_once('db.php');
    $sql = "INSERT INTO users(username, email, password, id_role) VALUES('$username', '$email', '$password', '2')";

    if ($conn->query($sql)) {
        $_SESSION['alert'] = "Register Success";
        header('location: ../login.php');
        exit(0);
    } else {
        $_SESSION['alert'] = "Register Fail";
        header('location: ../register.php');
        exit(0);
    }

}




?>