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
<script type="text/javascript" src="js/expression.js"></script>
<?php
if (isset($_POST['dataPost'])) {
  $dataPost = $_POST['dataPost'];
  if ($dataPost === "tambahkonten"):
    $juduls = $_POST['judulKonten'];
    $konten = $_POST['editor1'];
    $author = "Admin";
    $tampilkandepan = 0;
    //echo "<div>{$judul}</div><div>$konten</div>";
    $qb = "SELECT * FROM t_berita_bnc WHERE tampildepan=1";
    $baris = $kontrol->db->jumlahBaris($qb);
    if ($baris < 3):
      $tampilkandepan = 1;
    endif;

    $qi = "INSERT INTO t_berita_bnc (judul, isi, penulis, tampildepan) VALUES ('$juduls', '$konten', '$author', '$tampilkandepan')";
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
      header('Refresh: 2, URL=index.html');
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
       header('Refresh: 2, URL=tampilkonten');
    endif;
    //echo "Test : " . $kontrol->db->tryConn();

  else:
    echo "Edit/hapus kontent";
  endif;
} else {
  echo "Fom tidak diterima";
}

?>
