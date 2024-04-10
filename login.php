<?php
	session_start();
	if(isset($_SESSION['id']))
		Header("Location:index.php");
	if(!isset($_POST['username'])||!isset($_POST['password']))
		die("Invalid data!");
	$link=mysqli_connect("localhost","root","","testPHPSite");
	$res=mysqli_query($link,"select * from users where username='{$_POST['username']}'");
	$data=mysqli_fetch_array($res);
	if($data&&$data['password']==md5($_POST['password']))
	{
		$_SESSION['id']=$data['id'];
		$_SESSION['user']=$data['username'];
		$_SESSION['admin']=$data['admin'];
		Header("Location:index.php");
	}
	echo 'Invalid data! <a href="login.html">Go back</a>';
?>