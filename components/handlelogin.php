<?php
  require 'dbconnect.php';
if($_SERVER["REQUEST_METHOD"]=="POST"){
  $showError="";
  $user_email=$_POST["user_email"];
  $user_password=$_POST["user_password"];
  
  $query="SELECT * FROM `users14` WHERE `user_email`='$user_email';";
  $result=mysqli_query($conn,$query);
  $rows_number=mysqli_num_rows($result);
  if($rows_number>0){
    $row=mysqli_fetch_assoc($result);
    if(password_verify($user_password,$row['user_password'])){
        session_start();
        $_SESSION['loggedin']=true;
        $_SESSION['user_name']=$row['name'];
      header('Location:/forum/home.php?loginsuccess=true');
      exit();
    }else{
      $showError="Password didn't match.";
    }
  }else{
    $showError="User doesn't exists.";
  }
  header("Location:forum/home.php?loginsuccess=false&error=$showError");

}
?>