<?php

require 'connection.php';

$userName = isset($_POST['username']) ? filter_var($_POST['username'],FILTER_SANITIZE_STRING) : '';
$email = isset($_POST['email']) ? filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) : '';
$password = isset($_POST['password']) ? filter_var($_POST['password'],FILTER_SANITIZE_STRING): '';
$repeatPassword = isset($_POST['repeat-password']) ? filter_var($_POST['repeat-password'],FILTER_SANITIZE_STRING): '';

$send = isset($_POST['register-form']);
if(!$send){
    header('location: ../sign-in_form.php?error=complete_el_form');
}

if(empty($userName)){
    header('location: ../sign-in_form.php?error=username_required&email='.$email);
    exit();
}
if(empty($email)){
    header('location: ../sign-in_form.php?error=email_required_or_non_valid');
    exit();
}
if(empty($password)){
    header('location: ../sign-in_form.php?error=password_required&email='.$email);
    exit();
}
if(empty($repeatPassword)){
    header('location: ../sign-in_form.php?error=repeat_password&email='.$email);
    exit();
}

elseif($password !== $repeatPassword){
    header('location: ../sign-in_form.php?error=password_filed_doesnt_match&email='.$email);
    exit();
}
else{
    $sql='SELECT * FROM login WHERE USERNAME = ?';
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header('location: ../sign-in_form.php?error=SQL_ERROR');
        exit();
    }
    else{

        mysqli_stmt_bind_param($stmt,'s',$userName);
        mysqli_stmt_execute($stmt);
       mysqli_stmt_store_result($stmt);
       $result = mysqli_stmt_num_rows($stmt);
       if($result > 0){
        header('location: ../sign-in_form.php?error=user_exist');
        exit();
       }
       else{
            
           $insert = 'INSERT INTO login (USERNAME,EMAIL,PASSWORD) VALUES(?,?,?)';
           $stmt = mysqli_stmt_init($conn);
           if(!mysqli_stmt_prepare($stmt,$insert)){
            header('location: ../sign-in_form.php?error=SQL_ERROR');
            exit();
           }else{
            $hashedPWD = password_hash($password,PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt,'sss',$userName,$email,$hashedPWD);
            mysqli_stmt_execute($stmt);
            header('location: ../sign-in_form.php?Success=sign-in_successfully');
            exit();
           }
       }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}