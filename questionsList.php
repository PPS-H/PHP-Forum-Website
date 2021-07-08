<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Discussion Forum</title>
  </head>
  <body>

  <?php
  
  require 'components/dbconnect.php';

  $id=$_GET['id'];

  if($_SERVER["REQUEST_METHOD"]=="POST"){
    $title=$_POST['title'];
    $description=$_POST['description'];
    $query="INSERT INTO `question_list` (`que_title`, `que_des`, `que_cat_id`, `que_user_id`, `posted_time`) VALUES ('$title', '$description', '$id', '0', current_timestamp());";
    $result=mysqli_query($conn,$query);
  }
  
  $query="SELECT * FROM `discussion forum` WHERE `Sno.`='$id';";
  $result=mysqli_query($conn,$query);
  $row=mysqli_fetch_assoc($result);
  echo '<div class="container">
  <div class="jumbotron">
  <h1 class="display-4">'.$row["category_name"].'</h1>
  <p class="lead">'.$row["category_description"].'</p>
  <hr class="my-4">
  <p>No Spam / Advertising / Self-promote in the forums are not allowed. Do not post copyright-infringing material. Do not post “offensive” posts, links or images. Remain respectful of other members at all times.</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
  </p>
</div>';


echo "<h1>Related Questions</h1><hr>";


$ques_query="SELECT * FROM `question_list` WHERE `que_cat_id`='$id';";
$ques_result=mysqli_query($conn,$ques_query);
$noResult=true;
while($rows=mysqli_fetch_assoc($ques_result)){
  $noResult=false;
  echo'<div class="media my-4">
  <img class="mr-3" src="images/user.jpg" alt="Generic placeholder image" style="height:54px">
  <div class="media-body">
    <h5 class="mt-0"><a href="question.php?id='.$rows["que_id"].'">'.$rows["que_title"].'</a></h5>'.$rows["que_des"].'
  </div>
</div>';
}

if($noResult){
  echo '<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">No Questions Found</h1>
    <p class="lead">Be the first person to start the conversation.</p>
    </div>
  </div>';
}

?>


<h1 class="mt-5">Ask Your Question</h1>

<?php
session_start();
if(isset($_SESSION['loggedin']) and $_SESSION['loggedin']==true){
 echo'<hr><form action="'.$_SERVER["REQUEST_URI"].'" method="POST">
 <div class="mb-3">
   <label for="exampleInputEmail1" class="form-label">Problem title</label>
   <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
   <div id="emailHelp" class="form-text">Keep your title as small as possible.</div>
 </div>
 <div class="mb-3">
 <label for="exampleFormControlTextarea1" class="form-label">Problem description</label>
 <textarea class="form-control" id="description" name="description" rows="3"></textarea>
</div>
 <button type="submit" class="btn btn-primary">Submit</button>
</form>';
}else{
  echo "<hr><h3 class='mb-5' style= color:grey>You need to log in to ask a question.</h3>";
}
?>


</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>