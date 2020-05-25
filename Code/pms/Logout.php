<?php
session_start();
if(session_destroy())
{
	header("location:../pms/userlogin.php");   	
}  
?>
