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
  session_start();
  $id=$_GET['id'];


  if($_SERVER["REQUEST_METHOD"]=="POST"){
    $content=$_POST['content'];
    $query="INSERT INTO `comments` (`content`, `comment_que_id`, `posted_by`, `posted_time`) VALUES ('$content', '$id', '0', current_timestamp());";
    $result=mysqli_query($conn,$query);
  }

  
  $query="SELECT * FROM `question_list` WHERE `que_id`=$id;";
  $result=mysqli_query($conn,$query);
  $row=mysqli_fetch_assoc($result);
  echo '<div class="container">
  <div class="jumbotron">
  <h1 class="display-4">'.$row["que_title"].'</h1>
  <p class="lead">'.$row["que_des"].'</p>
  <hr class="my-4">
  <p>No Spam / Advertising / Self-promote in the forums are not allowed. Do not post copyright-infringing material. Do not post “offensive” posts, links or images. Remain respectful of other members at all times.</p>
  <p>Posted By Parminder on: '.$row["posted_time"].'</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
  </p>
</div>';

echo "<h1>Solutions</h1>";
$noResult=true;
$query="SELECT * FROM `comments` WHERE `comment_que_id`='$id';";
$result=mysqli_query($conn,$query);
while($rows=mysqli_fetch_assoc($result)){
  $noResult=false;
  echo'<div class="media my-4">
  <img class="mr-3" src="images/user.jpg" alt="Generic placeholder image" style="height:54px">
  <div class="media-body">
    <h5 class="mt-0">'.$_SESSION["user_name"].'</h5>
    '.$rows["content"].'
    </div>
    <h5 class="mt-0">at '.$rows["posted_time"].'</h5>
</div>';
}

if($noResult){
  echo '<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">No Solutions Found</h1>
    <p class="lead">Be the first person to share the solution.</p>
    </div>
  </div>';
}



?>

<h1 class="mt-5">Share Your Solution</h1>
<?php
if(isset($_SESSION['loggedin']) and $_SESSION['loggedin']==true){
  echo '<hr><form action="'.$_SERVER["REQUEST_URI"].'" method="POST">
  <div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Solution</label>
  <textarea class="form-control" id="content" name="content" rows="3"></textarea>
</div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>';
}else{
  echo "<hr><h3 class='mb-5' style= color:grey>You need to log in to share your solution.</h3>";
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