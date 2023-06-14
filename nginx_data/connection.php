<?php
$server = 'database-container';
$username = 'webserver';
$password = 'bjit@23';
$databasename = 'expense_db';

$conn = mysqli_connect($server, $username, $password);

$abc=mysqli_select_db($conn, $databasename);

if(!$abc)
{
	die("disconnect");
}
?>
