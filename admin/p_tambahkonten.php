<?php
if (!isset($_SESSION)) {
  session_start();
}
if(empty($_SESSION['login']))
	header("Location:../");

if(isset($_GET['keluar']))
{
	session_destroy();
	header("Location:../");
}

require_once("../convikx/appsadmin.php");

echo "<h2>Helo</h2>";

?>