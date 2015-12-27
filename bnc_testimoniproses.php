<?php
if (!isset($_SESSION)) {
  session_start();
}

require_once("./convikx/apps.php");

if(strtoupper($_POST['kode']) == $_SESSION['captcha_id'])
{
	if (trim($_POST['name']) == '') {
	$error[] = '- Nama harus diisi...';
	}
	if (trim($_POST['email']) == '') {
		$error[] = '- Email harus diisi...';
	}
	if (trim($_POST['message']) == '') {
		$error[] = '- Testimoni harus diisi...';
	}
	if (isset($error)) {
		//echo '<b>Maaf! </b>: <br />'.implode('<br />', $error);
		echo '<div><br/></div>
		<div class="col-md-12 col-sm-6">
		    <div class="service-block service-block-red service-or">
		        <div class="service-bg"></div>                
		        <i class="icon-custom icon-lg icon-color-light fa fa-exclamation-triangle"></i>
		        <h2 class="heading-md">Maaf!</h2>
		        <p>'.implode('<br />', $error).'</p>
		    </div>
		</div>';

	} else {

		$h = $kontrol->inputTestimoni($_POST['name'], $_POST['email'], $_POST['message'], '2');
		if($h <= 0)
		{
			echo '<div><br/></div>
			<div class="col-md-12 col-sm-6">
			    <div class="service-block service-block-red service-or">
			        <div class="service-bg"></div>                
			        <i class="icon-custom icon-lg icon-color-light fa fa-exclamation-triangle"></i>
			        <h2 class="heading-md">Error!</h2>
			        <p>Silahkan hubungi webmaster.</p>
			    </div>
			</div>';
			die();
		}
?>
			<div><br/></div>
			<div class="col-md-12 col-sm-6">
			    <div class="service-block service-block-sea service-or">
			        <div class="service-bg"></div>                
			        <i class="icon-custom icon-lg icon-bg-light fa fa-thumbs-up"></i>
			        <h2 class="heading-md">Testimoni Anda telah disimpan.</h2>
			        <p>Testimoni Anda akan direview terlebih dahulu.</p>
			        <p>Dan akan ditampilkan di halaman depan website kami.</p>
			        <p>Terima kasih.</p>                        
			    </div>
			</div>
<?php
		//echo "<center><h3>Pesan Anda telah disimpan.<br/>Customer Service kami akan merespon pesan Anda secepatnya.<br/>Terima Kasih.";
		//echo "<br/>Halaman ini akan di refresh dalam 5 detik.</h3></center>";
		//echo "<script type='text/javascript'> setTimeout('window.location.href = \"kontak_kami.html\";', 5000); </script>";
	}
}
else
{
?>
		<div><br/></div>
		<div class="col-md-12 col-sm-6">
		    <div class="service-block service-block-red service-or">
		        <div class="service-bg"></div>                
		        <i class="icon-custom icon-lg icon-color-light fa fa-exclamation-triangle"></i>
		        <h2 class="heading-md">Kode Salah.</h2>
		        <p>Maaf, kode yang Anda masukkan salah.</p>
		    </div>
		</div>
<?php
	//echo '<center><br/><h1>Kode Salah!</h1></center>';
}
?>
