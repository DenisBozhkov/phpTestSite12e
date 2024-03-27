<?php
	try
	{
		$link=mysqli_connect("localhost","root","","testPHPSite");
		$id=$_GET['id']??-1;
		if(!isset($_GET['save']))
		{
			$res=mysqli_query($link,"select * from users where id=$id");
			$data=mysqli_fetch_array($res);
			$firstname=$data['firstname'];
			$lastname=$data['lastname'];
			if(!$data)
				echo "Record with id $id does not exist";
			else echo "<form action=\"update.php?id=$id&save\" method=\"post\">
						First name: <input type=\"text\" name=\"firstname\" value=\"$firstname\"><br>
						Last name: <input type=\"text\" name=\"lastname\" value=\"$lastname\"><br>
						<input type=\"submit\" value=\"Update\">
					   </form>";
		}
		else
		{
			$firstname=$_POST['firstname'];
			$lastname=$_POST['lastname'];
			$sql="update users set firstname='$firstname',lastname='$lastname' where id=$id";
			mysqli_query($link,$sql);
			Header("Location:index.php");
		}
	}
	catch(Exception $e)
	{
		print_r($e);
	}
?>