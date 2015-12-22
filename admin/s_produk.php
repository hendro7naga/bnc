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

if (trim($_POST['nama']) == '') {
	$error[] = '- Nama Produk harus diisi...';
}
if (trim($_POST['harga']) == '') {
	$error[] = '- Harga Produk harus diisi...';
}
if(isset($_POST['jenis']))
{
	if (trim($_POST['jenis']) == "") {
		$error[] = '- Jenis Produk harus dipilih...';
	}
}
else
{
	$error[] = '- Jenis Produk harus dipilih...';
}
if(isset($_POST['tampil']))
{
	if (trim($_POST['tampil']) == "") {
		$error[] = '- Apakah produk ini ditampilkan?';
	}
}
else
{
	$error[] = '- Apakah produk ini ditampilkan?';
}

if(strlen(strip_tags(trim($_POST['des']))) <= 0)
{
	$error[] = '- Deskripsi Produk tidak boleh kosong...';
}

if (isset($error)) {
	echo '<b>Maaf! </b>: <br />'.implode('<br />', $error);
} else {

	if(!isset($_GET['exc']))
	{


	$h = $kontrol->insertProduk($_POST['nama'], '-', $_POST['harga'], $_POST['jenis'], $_POST['tampil'], $_POST['des']);
	if(!$h)
	{
		die("Error Query");
	}
	echo "Data berhasil di simpan!<br/>Silahkan upload gambar produk.";
	//echo "<script type='text/javascript'> setTimeout('window.location.href = \"?keluar\";', 1000); </script>";
?>
		<div class="row">
        <form action="p_ubah_foto" method="post" enctype="multipart/form-data" id="UploadForm">
  			<table width="500" border="0">
  			  <tr>
  			    <td>Gambar : </td>
  			    <td><input name="ImageFile" type="file" /></td>
  			  </tr>
  			  <input type="hidden" name="x" value="p" />
  			  <input type="hidden" name="q" value="<?php echo $kontrol->db->lastId(); ?>" />
  			  <tr>
  			    <td>&nbsp;</td>
  			    <td><input type="submit"  id="SubmitButton" value="Upload Gambar" /></td>
  			  </tr>
  			</table>
  			</form>

			<div id="progressbox"><div id="progressbar"></div ><div id="statustxt">0%</div ></div>
			<div id="output"></div>
      </div>
      

<?php
	}
	else
	{
		if(!isset($_POST['en']))
		{

			if(isset($_POST['id']))
			{
				$h = $kontrol->updateProduk($_POST['nama'], '-', $_POST['harga'], $_POST['jenis'], $_POST['tampil'], $_POST['des'],$_POST['id']);
				if(!$h)
				{
					die("Error Query");
				}
				echo "Data berhasil di Edit!<br/>Silahkan upload gambar produk jika ingin di ubah.";
?>

				<div class="row">
			        <form action="p_ubah_foto" method="post" enctype="multipart/form-data" id="UploadForm">
			  			<table width="500" border="0">
			  			  <tr>
			  			    <td>Gambar : </td>
			  			    <td><input name="ImageFile" type="file" /></td>
			  			  </tr>
			  			  <input type="hidden" name="x" value="p" />
			  			  <input type="hidden" name="q" value="<?php echo $_POST['id']; ?>" />
			  			  <tr>
			  			    <td>&nbsp;</td>
			  			    <td>
			  			    	<button class="btn cyan waves-effect waves-light left" type="submit" name="action">Ganti Gambar
			                    	<i class="mdi-content-send right"></i>
			                  	</button>
			  			    </td>
			  			  </tr>
			  			</table>
			  			</form>

						<div id="progressbox"><div id="progressbar"></div ><div id="statustxt">0%</div ></div>
						<div id="output"></div>
			      </div>

<?php
			}
			else
			{
				echo "Program lagi bingung...";
			}
?>
			<script type="text/javascript" src="js/cb_asset.js"></script>
			    <script>
			        $(document).ready(function() {
					//elements
					var progressbox 	= $('#progressbox');
					var progressbar 	= $('#progressbar');
					var statustxt 		= $('#statustxt');
					var submitbutton 	= $("#SubmitButton");
					var myform 			= $("#UploadForm");
					var output 			= $("#output");
					var completed 		= '0%';

							$(myform).ajaxForm({
								beforeSend: function() { //brfore sending form
									submitbutton.attr('disabled', ''); // disable upload button
									statustxt.empty();
									progressbox.show(); //show progressbar
									progressbar.width(completed); //initial value 0% of progressbar
									statustxt.html(completed); //set status text
									statustxt.css('color','#000'); //initial color of status text
								},
								uploadProgress: function(event, position, total, percentComplete) { //on progress
									progressbar.width(percentComplete + '%') //update progressbar percent complete
									statustxt.html(percentComplete + '%'); //update status text
									if(percentComplete>50)
										{
											statustxt.css('color','#fff'); //change status text to white after 50%
										}
									},
								complete: function(response) { // on complete
									output.html(response.responseText); //update element with received data
									myform.resetForm();  // reset form
									submitbutton.removeAttr('disabled'); //enable submit button
									progressbox.hide(); // hide progressbar
								}
						});
			        });

			    </script>

<?php	
		}
		else
		{
			$h = $kontrol->hapusProduk($_POST['id']);
			if(!$h)
			{
				die("Error Query");
			}
			echo "Data berhasil di hapus!";
		}	
	}
}

?>
