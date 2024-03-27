<?php
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	try
	{
		$link=mysqli_connect("localhost","root","","testPHPSite");
		$sql="insert into users value(0,'$firstname','$lastname')";
		mysqli_query($link,$sql);
		Header("Location:index.php");
	}
	catch(Exception $e)
	{
		print_r($e);
	}
?>