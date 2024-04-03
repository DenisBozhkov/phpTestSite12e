<?php
	session_start();
	if(!isset($_SESSION['user']))
		Header("Location:login.html");
	$id=$_GET['id']??-1;
	try
	{
		$link=mysqli_connect("localhost","root","","testPHPSite");
		$result=mysqli_query($link,"delete from users where id=$id");
		if(mysqli_affected_rows($link)==0)
			echo "Record with id $id does not exist";
		else header("Location:index.php");
	}
	catch(Exception $e)
	{
		print_r($e);
	}
?>