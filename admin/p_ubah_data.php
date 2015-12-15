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
// require_once("../convikx/DebeSQL.php");

if (trim($_POST['uname']) == '') {
	$error[] = '- Username harus diisi...';
}
if (trim($_POST['nama']) == '') {
	$error[] = '- Nama Lengkap harus diisi...';
}
if (trim($_POST['email']) == '') {
	$error[] = '- Email harus diisi...';
}
if(trim($_POST['baru']) == '')
{
	$error[] = '- Password Baru harus diisi...';
}
if(trim($_POST['uname']) == trim($_POST['baru']))
{
	$error[] = '- Password tidak boleh sama dengan Username.';
}
// $a =$kontrol->cekLogin($_SESSION['login'], $_POST['lama']);

if($kontrol->cekLogin($_SESSION['login'], $_POST['lama']) <= 0)
{
	$error[] = '- Password Lama salah!';
}
if (isset($error)) {
	echo '<b>Maaf! </b>: <br />'.implode('<br />', $error);
} else {
	$id = $kontrol->getIdUser($_SESSION['login']);


	$queris =  "UPDATE `t_menuinfo_bnc` SET namemenu='".$_POST['uname']."', katmenu='".$_POST['email']."', submenu='".$kontrol->buatPass($_POST['baru'])."', detail_menu = '".$_POST['nama']."' WHERE id = '".$kontrol->db->amanin($id)."'";
	$h = $kontrol->db->insertData($queris);
	if(!$h)
	{
		die("Error Query");
	}
	echo "Data berhasil di update!";
	echo "<script type='text/javascript'> setTimeout('window.location.href = \"?keluar\";', 1000); </script>";
}

?>