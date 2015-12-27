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

if(!isset($_GET['x']))
{
	if(isset($_GET['id']))
	{
		echo $kontrol->getKontak($_GET["id"]);
		$h = $kontrol->updateKontakStatus($_GET['id']);
		if(!$h)
			echo "<br/>BNC.";
	}
	else
	{
		echo "Fatal Error!";
	}
}
elseif(isset($_GET['x']) AND isset($_GET['x']) == "t")
{
	if(isset($_GET['id']))
	{
		echo $kontrol->getTestimoni($_GET["id"]);
	}
	else
	{
		echo "Fatal Error!";
	}
}
else
{
	echo "Fatal Error!";
}
?>
