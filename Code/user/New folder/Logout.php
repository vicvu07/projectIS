<?php
session_start();
session_destroy();
if(session_destroy())
{
	header("location:index.php");   	
}  
?>
