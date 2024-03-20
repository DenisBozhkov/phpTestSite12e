<?php
	function prepair_db($link)
	{
		mysqli_query($link,"create database testPHPSite");
		mysqli_select_db($link,"testPHPSite");
		$sql="create table users(
				id int auto_increment primary key,
				firstname varchar(50) not null,
				lastname varchar(50) not null)";
		mysqli_query($link,$sql);
	}
	
	$link=mysqli_connect("localhost","root","");
	try
	{
		mysqli_select_db($link,"testPHPSite");
	}
	catch(Exception)
	{
		prepair_db($link);
	}
?>