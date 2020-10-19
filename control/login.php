<?php
require 'connection.php';

$userName = isset($_POST['username']) ? filter_var($_POST['username'],FILTER_SANITIZE_STRING) : '';
$password = isset($_POST['password']) ? filter_var($_POST['password'],FILTER_SANITIZE_STRING): '';

$send = isset($_POST['submit-form']);
if(!$send){
    header('location: ../index.php?error=complete_el_form');
}


if(empty($userName)){
    header('location: ../index.php?error=username_required');
    exit();
}
elseif(empty($password)){
    header('location: ../index.php?error=password_required&username='.$userName);
    exit();
}

else{
   $sql="SELECT * FROM login WHERE USERNAME = ? OR EMAIL = ? AND PASSWORD = ?";
   $stmt = mysqli_stmt_init($conn);
   if(!mysqli_stmt_prepare($stmt,$sql)){
    header('location: ../index.php?error=SQL_ERROR');
    exit();
   }
   else{
       mysqli_stmt_bind_param($stmt,'sss',$userName,$userName,$password);
       mysqli_stmt_execute($stmt);
       $result=mysqli_stmt_get_result($stmt);
       if($row = mysqli_fetch_assoc($result)){
           $pwdCheck = password_verify($password,$row['PASSWORD']);
           if($pwdCheck ==false){
            header('location: ../index.php?error=wrong-password');
            exit();
           }elseif($pwdCheck ==true){
                session_start();
                $_SESSION['uname']=$row['USERNAME'];
                $_SESSION['uid'] = $row['ID'];
                header('location: ../index.php?login=success');
            exit();
           }
       }else{
        header('location: ../index.php?error=no_user_found');
        exit();
       }
   }
}
