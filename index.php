<?php
	session_start();
	if(!isset($_SESSION['user']))
		Header("Location:login.html");
	echo "<h2>Hello, ".$_SESSION['user']."! | <a href=\"logout.php\">Log out</a>";
?>
<h1>Users</h1>
<a href="create.html">Create user</a>
<table border="1">
	<tr>
		<th>Id</th>
		<th>First name</th>
		<th>Last name</th>
		<th>Update</th>
		<th>Delete</th>
	</tr>
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
	
	$result=mysqli_query($link,"select * from users");
	while($row=mysqli_fetch_array($result))
	{
		echo "<tr>";
		echo "<td>".$row['id']."</td>";
		echo "<td>".$row['firstname']."</td>";
		echo "<td>".$row['lastname']."</td>";
		echo '<td><a href="update.php?id='.$row['id'].'">Update</a></td>';
		echo '<td><a href="delete.php?id='.$row['id'].'">Delete</a></td>';
		echo "</tr>";
	}
?>
</table>