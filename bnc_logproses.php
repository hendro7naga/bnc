<?php
if (!isset($_SESSION)) {
  session_start();
}

require_once("./convikx/apps.php");

if(strtoupper($_POST['kode']) == $_SESSION['captcha_id'])
	{
		$u = $_POST['username'];
		$p = $_POST['password'];
		$ok = $kontrol->cekLogin($u, $p);
		if($ok != "1")
		{
			die("Login Gagal!");
		}
		else
		{
			$_SESSION['login'] = $u;
			if($kontrol->buatLog($u) == "1")
			{
				echo "<br/><center><img src='img/sebentarya-hijau.GIF'></center>";
				echo "<script type='text/javascript'> setTimeout('window.location.href = \"admin/\";', 3000); </script>";
			}
			else
			{
				echo '<center><br/><h1>Fatal Error!</h1></center>';
			}
		}
	}

// Else echo '0' as a string
else
	echo '<center><br/><h1>Kode Salah!</h1></center>';
?>