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

if (isset($_GET['actions'])) :
  $aksi = $_GET['actions'];
  if ($aksi == "deletekonten"):
    $tmp = $_GET['data'];
    $tmp = explode('_', $tmp);
    $q = "DELETE FROM t_berita_bnc WHERE bid='$tmp[1]'";
    $h = $kontrol->db->insertData($q);
    if (!$h) {
      echo "0";
    } else {
      echo "1";
    }
  endif;
endif;

?>
