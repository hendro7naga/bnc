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
?>
<!DOCTYPE html>
<html>
<head>
  <?php include("include/head.php"); ?>
  <script type="text/javascript" src="js/expression.js"></script>
</head>
<body>
<?php
if (isset($_POST['dataPost'])) {
  $dataPost = $_POST['dataPost'];
  $juduls = $_POST['judulSubMenu'];
  $konten = $_POST['editor1'];
  
  $author = "Admin";
  if ($dataPost === "tambahsubmenu"):
  	$arrData= explode('_', $_POST['menupilihan']);
  	//print_r($arrData);
    $qi = "INSERT INTO t_submenuhead_bnc (subParentID, subNama, subKonten) VALUES ('$arrData[1]', '$juduls', '$konten')";
    $res = $kontrol->db->insertData($qi);
    if ($res == null):
      ?>
      <div class="section">
        <div class="row">
          <div class="col s10">
            <h5>Maaf!!!</h5>
            <div class="divider"></div>
            Tidak dapat menambah data pada server.<br/>Silahkan hubungi Developer Aplikasi.<br/>Terima kasih...<br/>
            <b>Nb: </b> Anda akan dialihkan secara otomatis...
          </div>
        </div>
      </div>
      <?php
      header('Refresh: 2, URL=esubmenu');
    else:
      ?>
      <div class="section">
        <div class="row">
          <div class="col s10">
            <h5>Penambahan Data Berhasil</h5>
            <div class="divider"></div>
            <p>Anda akan dialihkan secara otomatis.<br/><br/>Terima kasih...</p>
          </div>
        </div>
      </div>
      <?php
       header('Refresh: 2, URL=esubmenu');
    endif;

  elseif ($dataPost == "editsubmenu"):
    $kontenid = $_POST['kontenId'];
	$q = "UPDATE t_submenuhead_bnc set subNama = '$juduls', subKonten = '$konten' WHERE subID='$kontenid'";
	//echo "<p>Judul : ". $juduls . " - ID : " . $kontenid . " - Isi : " . $konten ."</p>";
    /*if ($gambar == "gambar_default.jpg") {
      $q = "UPDATE t_berita_bnc SET judul='$juduls', isi='$konten' WHERE bid='$kontenid'";
    }
    else {
      $q = "UPDATE t_berita_bnc SET judul='$juduls', isi='$konten', gambarUtama='$gambar' WHERE bid='$kontenid'";
    }*/
    $res = $kontrol->db->insertData($q);
    if ($res == null) {
      ?>
        <div class="section">
          <div class="row">
            <div class="col s10">
              <h5>Maaf!!!</h5>
              <div class="divider"></div>
              Tidak dapat mengedit data pada server.<br/>Silahkan hubungi Developer Aplikasi.<br/>Terima kasih...<br/>
              <b>Nb: </b> Anda akan dialihkan secara otomatis...
            </div>
          </div>
        </div>
        <?php
        header('Refresh: 2.6, URL=index.html');
    } else {
      ?>
        <div class="section">
          <div class="row">
            <div class="col s10">
              <h5>Pengeditan Data Berhasil</h5>
              <div class="divider"></div>
              <p>Anda akan dialihkan secara otomatis.<br/><br/>Terima kasih...</p>
            </div>
          </div>
        </div>
        <?php
         header('Refresh: 2.6, URL=esubmenu');
    } //end elseif editkonten
  endif;
}

?>
  <!-- jQuery Library -->
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <!--materialize js-->
    <script type="text/javascript" src="js/materialize.js"></script>
  </body>
</html>
