<?php
require 'dbconnect.php';
if($_SERVER["REQUEST_METHOD"]=="POST"){
  $showError="";
  $user_name=$_POST["user_name"];
  $user_email=$_POST["user_email"];
  $user_password=$_POST["user_password"];
  $user_cpassword=$_POST["user_cpassword"];
  $query="SELECT * FROM `users14` WHERE `user_email`='$user_email';";
  $result=mysqli_query($conn,$query);
  $numRows=mysqli_num_rows($result);
  if($numRows>0){
    $showError="There is an account exists with this email.Use another email account.";
  }else{
    if($user_password==$user_cpassword){
      $password=password_hash($user_password,PASSWORD_DEFAULT);
      $query="INSERT INTO `users14` (`name`,`user_email`, `user_password`, `time`) VALUES ('$user_name','$user_email', '$password', current_timestamp());";
      $result=mysqli_query($conn,$query);
      if($result){
        header('Location:/forum/home.php?signupsuccess=true');
        exit();
      }
    }else{
      $showError="Passwords didn't match.";
    }
  }
  header("Location:/forum/home.php?signupsuccess=false&error=$showError");
  exit();
}
?>