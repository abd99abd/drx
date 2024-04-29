<?php
$singout=$_GET['Signout']; 
$login=$_GET['Login'];
if(isset($singout) && $login=="true"){
     session_start(); 
if(isset($_SESSION['doctor']) || isset($_SESSION['pharmacy']) ){ 
     session_destroy();
     header("Location:index");
     exit();
}else{
	header("Location:index");
    exit();}
}else{
	header("Location:index");
    exit();}?>
