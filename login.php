<?php
	session_start();
	if(isset($_SESSION['user']))
		Header("Location:index.php");
	if(!isset($_POST['username'])||!isset($_POST['password']))
		die("Invalid data!");
	if($_POST['username']=='admin'&&$_POST['password']=="123")
	{
		$_SESSION['user']='admin';
		Header("Location:index.php");
	}
	echo 'Invalid data! <a href="login.html">Go back</a>';
?>