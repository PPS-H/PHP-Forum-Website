<?php
session_start();
session_unset();
echo "Logging you out......Please wait";
session_destroy();
header('Location:/forum/home.php');
?>