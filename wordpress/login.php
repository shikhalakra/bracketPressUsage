<?php 
$username=$_POST['username'];
$password=$_POST['password'];
$username=mysql_real_escape_string($username);
$password=mysql_real_escape_string($password);
$conn=mysql_connect("localhost","root","");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysql_select_db("bracketpress");
$result = mysql_query("select * from login where username='$username' and password='$password'")
or die("Failed to query database".mysql_error());
$row = mysql_fetch_array($result);
if (($row['username']) == $username && $row['password'] ==$password)
{
	//echo "Welcome".$row['username'];
	header( "Location: bracket-tournament-details/index.php" );
}
else
{
		header( "Location: nologin.php" );
} 
?>