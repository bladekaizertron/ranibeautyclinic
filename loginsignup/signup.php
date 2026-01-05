<?php
session_start();
include "db_conn.php";

if (isset($_POST['email']) && isset($_POST['password'])
    && isset($_POST['re_password'])) {

    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

    $email = validate($_POST['email']);
    $pass = validate($_POST['password']);
    $re_pass = validate($_POST['re_password']);

    $user_data = 'email='. $email;


    if (empty($email)) {
        header("Location: signup.html?error=Email is required&$user_data");
        exit();
    }else if(empty($pass)){
        header("Location: signup.html?error=Password is required&$user_data");
        exit();
    }else if(empty($re_pass)){
        header("Location: signup.html?error=Re Password is required&$user_data");
        exit();
    }else if($pass !== $re_pass){
        header("Location: signup.html?error=The confirmation password  does not match&$user_data");
        exit();
    }else{

        // hashing the password
        $pass = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            header("Location: signup.html?error=The username is taken try another&$user_data");
            exit();
        }else{
           $sql2 = "INSERT INTO users(email, password) VALUES('$email', '$pass')";
           $result2 = mysqli_query($conn, $sql2);
           if ($result2) {
            header("Location: dashboard.php");
            exit();
           }else {
               header("Location: signup.html?error=unknown error occurred&$user_data");
               exit();
           }
        }
    }

}else{
    header("Location: signup.html");
    exit();
}
