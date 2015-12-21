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

if (isset($_POST['dataPost'])) {
  $dataPost = $_POST['dataPost'];
  if ($dataPost === "tambahKonten"):
    $authors = $_POST['author'];
    $judul = $_POST['judulKonten'];
    $konten = $_POST['editor1'];
  else:
    echo "Edit/hapus kontent";
  endif;
} else {
  echo "Fom tidak diterima";
}

?>
