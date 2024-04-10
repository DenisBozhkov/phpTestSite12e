<?php
	session_start();
	if(!isset($_SESSION['id']))
		Header("Location:login.html");
	try
	{
		if(isset($_GET['home']))
			echo "<h2>Hello, ".$_SESSION['user']."! | <a href=\"logout.php\">Log out</a></h2>";
		$link=mysqli_connect("localhost","root","","testPHPSite");
		$id=$_GET['id']??-1;
		if(!isset($_GET['save']))
		{
			$res=mysqli_query($link,"select * from users where id=$id");
			$data=mysqli_fetch_array($res);
			$firstname=$data['firstname'];
			$lastname=$data['lastname'];
			$username=$data['username'];
			if(!$data)
				echo "Record with id $id does not exist";
			else 
			{
				echo "<form action=\"update.php?id=$id&save\" method=\"post\">
						First name: <input type=\"text\" name=\"firstname\" value=\"$firstname\"><br>
						Last name: <input type=\"text\" name=\"lastname\" value=\"$lastname\"><br>
						Username: <input type=\"text\" name=\"username\" value=\"$username\"><br>
						Set new password: <input type=\"password\" name=\"password\"><br>";
				if($_SESSION['admin']!='0')
				{
					if($data['admin']==0)
						echo "<input type=\"checkbox\" name=\"admin\"> Admin<br>";
					else if($data['admin']==1)
						echo "<input type=\"checkbox\" name=\"admin\" checked=\"checked\"> Admin<br>";
				}
				echo "<input type=\"submit\" value=\"Update\"></form>";
			}
		}
		else
		{
			$firstname=$_POST['firstname'];
			$lastname=$_POST['lastname'];
			$username=$_POST['username'];
			$admin=isset($_POST['admin'])?1:0;
			$sql="update users set 
				firstname='$firstname',
				lastname='$lastname',
				username='$username',";
			if(isset($_POST['password'])&&trim($_POST['password'])!="")
				$sql.="password='".md5($_POST['password'])."',";
			$sql.="admin=$admin where id=$id";
			mysqli_query($link,$sql);
			Header("Location:index.php");
		}
	}
	catch(Exception $e)
	{
		print_r($e);
	}
?>