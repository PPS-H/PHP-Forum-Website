<?php
$login=false;
if(isset($_GET['loginsuccess']) and $_GET['loginsuccess']=="true"){
    $login=true;
}
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Discussion Forum</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link active" href="#">About</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
            </li>
            <li class="nav-item">
            <a class="nav-link active" href="#" tabindex="-1" aria-disabled="true">Contact</a>
            </li>
        </ul>
        <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-primary" type="submit">Search</button>
        </form>
        </div>';
        ?>
<?php
        if($login){
            session_start();
            echo '<p class="mb-0 mx-2" style= color:white>Welcome '.$_SESSION["user_name"].'!</p>';
            echo '<a href="/forum/components/handlelogout.php"><button class="btn btn-outline-primary mx-2" type="submit">Log Out</button></a>
        </div>
    </nav>';
        }else{
            echo '<button class="btn btn-outline-primary mx-2" type="submit" data-bs-toggle="modal" data-bs-target="#loginModal">Log In</button>

            <button class="btn btn-outline-primary" type="submit" data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</button>
        </div>
    </nav>';
        }
        
include "components/loginModal.php";
include "components/signupModal.php";

if(isset($_GET['signupsuccess']) and $_GET['signupsuccess']=='true'){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your account has been created succesfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}

if(isset($_GET['signupsuccess']) and $_GET['signupsuccess']=='false'){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> '.$_GET['error'].'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>'; 
}
?>

