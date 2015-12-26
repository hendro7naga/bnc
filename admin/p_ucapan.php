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
if (isset($_POST['konten'])) :
	$k = $_POST['konten'];
	$q = "UPDATE t_ucapan_bnc SET isi='$k' WHERE uid=1";
	$res = $kontrol->db->insertData($q);
	if ($res != null) {
		echo 1;
	} else {
		echo 0;
	}
endif;
?>
