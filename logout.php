<?php
session_start();

if(!isset($_SESSION["email"])){
	header("LOCATION:home.php");
}else{
session_destroy();
header("LOCATION:home.php");
exit();
}
?>