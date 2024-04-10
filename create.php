<?php
	session_start();
	if(!isset($_SESSION['user']))
		Header("Location:login.html");
	if(isset($_GET['save']))
	{
		$firstname=$_POST['firstname'];
		$lastname=$_POST['lastname'];
		$username=$_POST['username'];
		$password=md5($_POST['password']);
		$admin=isset($_POST['admin'])?1:0;
		try
		{
			$link=mysqli_connect("localhost","root","","testPHPSite");
			$sql="insert into users value(0,'$firstname','$lastname','$username','$password',$admin)";
			mysqli_query($link,$sql);
			Header("Location:index.php");
		}
		catch(Exception $e)
		{
			print_r($e);
		}
	}
	else
	{
		echo "<form action=\"create.php?save\" method=\"post\">
			First name: <input type=\"text\" name=\"firstname\"><br>
			Last name: <input type=\"text\" name=\"lastname\"><br>
			Username: <input type=\"text\" name=\"username\"><br>
			Password: <input type=\"password\" name=\"password\"><br>";
		if($_SESSION['admin']!=0)
			echo "<input type=\"checkbox\" name=\"admin\"> Admin<br>";
		echo "<input type=\"submit\" value=\"Create\"></form>";
	}
?>