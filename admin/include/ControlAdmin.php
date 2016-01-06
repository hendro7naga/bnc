<?php
require_once("../convikx/DebeSQL.php");
require_once("Browser.php");
class ControlAdmin {
  private static $controladmin;
  public $db;
  private function __construct() {
    #code...
  }
  function __destruct() {
    #code...
  }

  static function getInstanceMe() {
    if (self::$controladmin == null) {
      self::$controladmin = 1;
      return new static;
    }
    else {
      return null;
    }
  }

  function initDBInstanceController() {
    $this->db = DebeSQL::getInstanceDebeAdmin($this);
    if ($this->db == null) {
      return 0;
    }
    else {
      if (!$this->db->initInstanceProp())
        return 0;
      else
        return 1;
    }
  }

  function cleanTagAndSlicing($content, $lengthSplice, $return = null) {
    $data = rtrim(trim(preg_replace("/<.*?>/", " ", $content)));
    $dataArr = mb_split(" ", $data, mb_substr_count($data, " ") + 1);

    array_splice($dataArr, $lengthSplice);
    for ($i = 0; $i < count($dataArr); $i += 1) {
      if ($dataArr[$i] == "") {
        unset($dataArr[$i]);
      }
    }
    if($return != null)
    {
      return count($dataArr);
    }
    else
    {
      array_values($dataArr);
      return implode(" ", $dataArr);
    }
  }

  function rupiah($num){
  if($num <= 0){
    return "Rp. 0";
  }else{
    $rp=number_format($num,0,",",".");
    return "Rp. ".$rp;
    }
  }

  function ekripPass($q)
  {
    $key = "HENDROwaspadaBNConLY";
    $temp = $key.md5($q).sha1($key);
    return md5($temp);
  }

  function cekLogin($u, $p)
  {
    $q = "SELECT * FROM t_menuinfo_bnc WHERE namemenu = '$u' AND submenu='".$this->ekripPass($p)."'";
    $data = $this->db->selectData($q);
    if (count($data) > 0)
    {
      //return print_r($data);
      return "1";
    }
    return "0";

  }

  function buatPass($q)
  {
    return $this->ekripPass($q);
  }

  function getNamaLengkap($q)
  {
    $queris = "SELECT * FROM t_menuinfo_bnc WHERE namemenu = '".$this->db->amanin($q)."'";
    $data = $this->db->selectDataSingle($queris);
    return $data['detail_menu'];
  }

  function getFotoAdmin($q)
  {
    $queris = "SELECT * FROM t_menuinfo_bnc WHERE namemenu = '".$this->db->amanin($q)."'";
    $data = $this->db->selectDataSingle($queris);
    return $data['foto_menu'];
  }

  function getNamaDepan($q)
  {
    $h = explode(' ',trim($q));
    echo $h[0];
  }

  function getLogLogin($q)
  {
    $queris = "SELECT * FROM t_loglogin_bnc where uname = '".$this->db->amanin($q)."' order by id DESC LIMIT 5";
    $data = $this->db->selectData($queris);

    $h = "";
    for($i=0; $i<count($data); $i++):
      $browser = new Browser($data[$i]["user_agent"]);
      $h  .= '<li class="collection-item dismissable">';
      $h  .= '<label for="task1">'.$browser->getOS().'/'.$browser->getBrowser().' '.$browser->getVersion().'<a href="javascript:void(0);" class="secondary-content"><span class="ultra-small">'.$this->ubahTimeStamp($data[$i]["tgl"]).'</span></a></label>';
      $h  .= '<span class="task-cat teal">'.$data[$i]["ip"].'</span>';
      $h  .= '</li>';
    endfor;
    return $h;
  }

  function ubahTimeStamp($s)
  {
    return date("d/m/Y H:i:s", strtotime($s))." WIB";
  }

  function dataAnda($u)
  {
    $queris = "SELECT * FROM t_menuinfo_bnc WHERE namemenu= '".$this->db->amanin($u)."'";
    $data = $this->db->selectData($queris);

    $h = "";
    for($i=0; $i<count($data); $i++):
      $h .= '<div class="col s12 m4 l4">';
      $h .= '<h4 class="header">Welcome,</h4><div id="profile-card" class="card"><div class="card-image waves-effect waves-block waves-light"><img class="activator" src="images/user-bg.jpg" alt="user bg"></div>';
      $h .= '<div class="card-content"><img src="images/'.$data[$i]['foto_menu'].'" alt="" class="circle responsive-img activator card-profile-image"><a class="btn-floating activator btn-move-up waves-effect waves-light darken-2 right"><i class="mdi-editor-mode-edit"></i></a>';
      $h .= '<span class="card-title activator grey-text text-darken-4">'.$data[$i]["detail_menu"].'</span>';
      $h .= '<p><i class="mdi-communication-email"></i> '.$data[$i]["katmenu"].'</p>';
      $h .= '</div>';
      $h .= '<div class="card-reveal">';
      $h .= '<span class="card-title grey-text text-darken-4">'.$data[$i]["detail_menu"].' <i class="mdi-navigation-close right"></i></span>';
      $h .= '<p>Berikut informasi data Anda</p>';
      $h .= '<p><i class="mdi-action-perm-identity"></i> Administrator</p>';
      $h .= '<p><i class="mdi-communication-email"></i>'.$data[$i]["katmenu"].'</p>';
      $h .= '</div></div></div>';
    endfor;
    return $h;
  }

  function menuAdmin()
  {
    $str = "";
    $str .= '<li class="bold"><a href="#" class="waves-effect waves-cyan"><i class="mdi-communication-email"></i> Info</a></li>';
    $str .= '<li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-editor-insert-comment"></i> Produk</a>';
    $str .= '<div class="collapsible-body"><ul><li><a href="t_produk">Tambah</a></li><li><a href="l_produk">Edit/Hapus</a></li></ul></div></li>';
    $str .= '<li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-editor-insert-comment"></i> SubMenu</a>';
    $str .= '<div class="collapsible-body"><ul><li><a href="submenu?actions=tambahsubmenu">Tambah</a></li><li><a href="esubmenu">Edit/Hapus</a></li></ul></div></li>';
    $str .= '<li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-editor-insert-comment"></i> Konten</a>';
    $str .= '<div class="collapsible-body"><ul><li><a href="konten?actions=tambahkonten">Tambah</a></li><li><a href="tampilkonten">Edit/Hapus</a></li></ul></div></li>';
    $str .= '<li class="bold"><a href="l_kontak" class="waves-effect waves-cyan"><i class="mdi-communication-email"></i> Kontak Kami '.(($this->countUnreadKontak() > 0) ? ' <span class="new badge">'.$this->countUnreadKontak().'</span></a>':'').'</li>';
    $str .= '<li class="bold"><a href="l_testimoni" class="waves-effect waves-cyan"><i class="mdi-communication-email"></i> Testimoni '.(($this->countUnreadTestimoni() > 0) ? ' <span class="new badge">'.$this->countUnreadTestimoni().'</span></a>':'').'</li>';
    $str .= '<li class="bold"><a href="ucapan" class="waves-effect waves-cyan"><i class="mdi-communication-email"></i> Ucapan </a></li>';
    $str .= '<li class="bold"><a href="?keluar" class="waves-effect waves-cyan"><i class="mdi-hardware-keyboard-tab"></i> Keluar </a></li>';
    return $str;
  }

  function getIdUser($u)
  {
    $q = "SELECT * FROM t_menuinfo_bnc WHERE namemenu = '".$this->db->amanin($u)."'";
    $data = $this->db->selectDataSingle($q);
    return $data['id'];
  }

  function formUbahData($u)
  {
    $q = "SELECT * FROM t_menuinfo_bnc WHERE namemenu = '".$this->db->amanin($u)."'";
    $data = $this->db->selectData($q);
    for($i=0; $i<count($data); $i++):
?>

      <form class="col s12" method="post" id="bnc" action="p_ubah_data">
          <div class="row">
            <div class="input-field col s12">
              <i class="mdi-action-account-circle prefix"></i>
              <input id="name4" type="text" name="uname" value="<?php echo $data[$i]['namemenu']; ?>" class="validate">
              <label for="user_name">Username</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <i class="mdi-action-account-circle prefix"></i>
              <input id="name4" type="text" name="nama" value="<?php echo $data[$i]['detail_menu']; ?>" class="validate">
              <label for="first_name">Nama Lengkap</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <i class="mdi-communication-email prefix"></i>
              <input id="email4" name="email" type="email" value="<?php echo $data[$i]['katmenu']; ?>" class="validate">
              <label for="email">Email</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <i class="mdi-action-lock-outline prefix"></i>
              <input id="baru" name="baru" type="password" class="validate">
              <label for="password">Password Baru</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <i class="mdi-action-lock-outline prefix"></i>
              <input id="lama" name="lama" type="password" class="validate">
              <label for="password">Password Lama</label>
            </div>
          </div>
          <div class="row">
            <div class="row">
              <div class="input-field col s12">
                <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Simpan
                  <i class="mdi-content-send right"></i>
                </button>
              </div>
            </div>
          </div>
          <div id="tunggu" style="display:none;"><img src="../img/loading01.gif" alt="loading..." width="100px" height="100px" /> Loading...</div>
          <div id="hasil"></div>
        </form>
<?php

    endfor;
  } // end formUbahData

  // begin untuk upload gambar
  // function
  // end untuk upload gambar

  // begin produk
  function insertProduk($nama, $img=NULL, $harga, $tipe, $status, $des)
  {
    $q = "INSERT INTO `t_produk_bnc` (`id`, `namaProduk`, `imgProduk`, `hargaProduk`, `tipeProduk`, `status`, `tglBuat`, `descProduk`) VALUES (NULL, '$nama', '$img', '$harga', '$tipe', '$status', CURRENT_TIMESTAMP, '$des')";
    $h = $this->db->insertData($q);
    if(!$h)
      return "0";
    return "1";
  }

  function updateProduk($nama, $img=NULL, $harga, $tipe, $status, $des, $id)
  {
    $q = "UPDATE `t_produk_bnc` set `namaProduk` = '$nama', `hargaProduk` = '$harga', `tipeProduk` = '$tipe', `status` = '$status', `descProduk` = '$des' WHERE id = '".$this->db->amanin($id)."'";
    $h = $this->db->insertData($q);
    if(!$h)
      return "0";
    return "1";
  }

  function hapusProduk($id)
  {
    $q = "DELETE from `t_produk_bnc` WHERE id = '".$this->db->amanin($id)."'";
    $h = $this->db->insertData($q);
    if(!$h)
      return "0";
    return "1";
  }

  function laporanProduk()
  {
    $q = "SELECT * FROM t_produk_bnc order by id DESC";
    $data = $this->db->selectData($q);
    $h = "";
    for($i=0; $i<count($data); $i++):
      $h .= '<tr><td class="tooltipped z-depth-2" data-tooltip="'.$data[$i]["namaProduk"].'" data-position="top">'.(($this->cleanTagAndSlicing($data[$i]["namaProduk"], 9, 1) > 5) ? $this->cleanTagAndSlicing($data[$i]["namaProduk"], 9)."...": $data[$i]["namaProduk"]).'</td><td>'.$this->rupiah($data[$i]["hargaProduk"]).'</td><td><a class="waves-effect waves-light btn modal-trigger" href="#foto'.$i.'">Lihat</a></td>';
      $h .= '<td>'.(($data[$i]["tipeProduk"] == "1") ? "Makanan" : "Minuman").'</td><td>'.(($data[$i]["status"] == "1") ? "Tampil" : "Tdk Tampil").'</td><td>'.$this->ubahTimeStamp($data[$i]["tglBuat"]).'</td>';
      $h .= '<td>';
      $h .= '<a href="produk_aksi?a=e&q='.$data[$i]["id"].'" class="btn-floating waves-effect waves-light light-blue tooltipped z-depth-2" data-position="left" data-tooltip="Edit '.$data[$i]["namaProduk"].'"><i class=" mdi-editor-mode-edit"></i></a>';
      $h .= '<a href="produk_aksi?a=x&q='.$data[$i]["id"].'"" class="btn-floating waves-effect waves-light light-red tooltipped z-depth-2" data-position="left" data-tooltip="Hapus '.$data[$i]["namaProduk"].'"><i class=" mdi-content-clear"></i></a>';
      $h .= '</td></tr>';
      $h .= '<div id="foto'.$i.'" class="modal modal-fixed-footer"><div class="modal-content">';
      $h .= '<img src="../img/'.$data[$i]["imgProduk"].'" width="100%" height="100%">';
      $h .= '</div><div class="modal-footer"><a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat ">Tutup</a></div></div>';

    endfor;
    return $h;
  }

  function formubahProduk($q)
  {
    $queris = "SELECT * FROM t_produk_bnc WHERE id = '".$this->db->amanin($q)."'";
    $data = $this->db->selectData($queris);
    for($i=0; $i<count($data); $i++):
?>

  <!--Form Advance-->
          <div class="row">
            <div class="col s12 m12 l12">
              <div class="card-panel">
                <h4 class="header2">Edit Produk</h4>
                <div class="row">
                  <form class="col s12" method="post" id="bnc" action="s_produk?exc">
                    <div class="row">
                      <div class="input-field col s12">
                        <input id="nama" name="nama" type="text" value="<?php echo $data[$i]["namaProduk"]; ?>">
                        <label for="nama">Nama Produk</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <input id="harga" name="harga" type="text" value="<?php echo $data[$i]["hargaProduk"]; ?>">
                        <label for="harga">Harga</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s6">
                        <select name="jenis">
                          <option value="" disabled selected>Pilih Jenis Produk</option>
                          <option value="1" <?php echo ($data[$i]["tipeProduk"] == "1") ? 'selected':''; ?>>Makanan</option>
                          <option value="2" <?php echo ($data[$i]["tipeProduk"] == "2") ? 'selected':''; ?>>Minuman</option>
                        </select>
                        <label>Jenis Produk</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                      <label>Deskripsi Produk</label>
                      <br/><br/><br/>
                        <textarea id="message5" class="ckeditor" name="des"><?php echo $data[$i]["descProduk"]; ?></textarea>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s6">
                        <select name="tampil">
                          <option value="" disabled selected>Tampil/Tidak</option>
                          <option value="1" <?php echo ($data[$i]["status"] == "1") ? 'selected':''; ?>>Ya</option>
                          <option value="0" <?php echo ($data[$i]["status"] == "0") ? 'selected':''; ?>>Tidak</option>
                        </select>
                        <label>Tampil/Tidak</label>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <button class="btn cyan waves-effect waves-light right" type="submit" name="action" onClick="CKupdate();">Simpan
                            <i class="mdi-content-send right"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $data[$i]["id"]; ?>" />
                    <div id="tunggu" style="display:none;"><img src="../img/loading01.gif" alt="loading..." width="100px" height="100px" /> Loading...</div>
                    <div id="hasil"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!--end container-->

<?php
    endfor;
  }

  function formhapusProduk($q)
  {
    $queris = "SELECT * FROM t_produk_bnc WHERE id = '".$this->db->amanin($q)."'";
    $data = $this->db->selectData($queris);
    for($i=0; $i<count($data); $i++):
?>

  <!--Form Advance-->
          <div class="row">
            <div class="col s12 m12 l12">
              <div class="card-panel">
                <h4 class="header2">Apa Anda yakin menghapus produk ini?</h4>
                <div class="row">
                  <form class="col s12" method="post" id="bnc" action="s_produk?exc">
                    <div class="row">
                      <div class="input-field col s12">
                        <input id="nama" name="nama" type="text" value="<?php echo $data[$i]["namaProduk"]; ?>">
                        <label for="nama">Nama Produk</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <input id="harga" name="harga" type="text" value="<?php echo $data[$i]["hargaProduk"]; ?>">
                        <label for="harga">Harga</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s6">
                        <select name="jenis">
                          <option value="" disabled selected>Pilih Jenis Produk</option>
                          <option value="1" <?php echo ($data[$i]["tipeProduk"] == "1") ? 'selected':''; ?>>Makanan</option>
                          <option value="2" <?php echo ($data[$i]["tipeProduk"] == "2") ? 'selected':''; ?>>Minuman</option>
                        </select>
                        <label>Jenis Produk</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                      <label>Deskripsi Produk</label>
                      <br/><br/><br/>
                        <textarea id="message5" class="ckeditor" name="des"><?php echo $data[$i]["descProduk"]; ?></textarea>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s6">
                        <select name="tampil">
                          <option value="" disabled selected>Tampil/Tidak</option>
                          <option value="1" <?php echo ($data[$i]["status"] == "1") ? 'selected':''; ?>>Ya</option>
                          <option value="0" <?php echo ($data[$i]["status"] == "0") ? 'selected':''; ?>>Tidak</option>
                        </select>
                        <label>Tampil/Tidak</label>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Hapus Produk
                            <i class="mdi-content-send right"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $data[$i]["id"]; ?>" />
                    <input type="hidden" name="en" value="takedown" />
                    <div id="tunggu" style="display:none;"><img src="../img/loading01.gif" alt="loading..." width="100px" height="100px" /> Loading...</div>
                    <div id="hasil"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!--end container-->

<?php
    endfor;
  }


  // end produk

  /* -- start submenu -- */
  function loadMenus($parents = "") {
    $q = "SELECT * FROM t_menuhead_bnc";
    $data = $this->db->selectData($q);
    $readonlys = ($parents == "") ? "" : "disabled";
    $str = "<div class=section></div><select name=menupilihan id=menupilihan {$readonlys}>" . PHP_EOL;
    $str .= "<option value= selected> -- Pilih Menu -- </option>";
    for ($i = 0; $i < count($data); $i += 1) :
      if ($data[$i]['menuID'] == 101 || $data[$i]['menuID'] == "101") :
        continue;
      endif;
      if ($parents == $data[$i]['menuID']) :
        $str .= "<option value=menu_{data[$i]['menuID']} selected=true>" . $data[$i]['menuNama'] . "</option>";
      else :
        $str .= "<option value=menu_{$data[$i]['menuID']}>" . $data[$i]['menuNama'] . "</option>";
      endif;
    endfor;
    $str .= "</select>" . PHP_EOL;
    return $str;
  }
  function loadSubMenuItems() {
    $q = "SELECT * FROM t_menuhead_bnc";
    $dataMenu = $this->db->selectData($q);
    $str = "<ul class=\"collection with-header\">";
    for ($i = 0; $i < count($dataMenu); $i += 1) :
      $parentsId = $dataMenu[$i]['menuID'];
      if ($parentsId == 101 || $parentsId == "101") :
        continue;
      endif;
      $str .= "<li class=\"collection-header\"><h5>{$dataMenu[$i]['menuNama']}</h5>" . PHP_EOL;
      $str .= "<ul class=\"collection datasub\">";

      $qSub = "SELECT subID, subNama FROM t_submenuhead_bnc WHERE subParentID='$parentsId'";
      $dataSub = $this->db->selectData($qSub);
      for ($j=0; $j < count($dataSub); $j+=1) { 
        $str .= "<li class=\"collection-item\">
                  <div class=row>
                    <div class=\"col s10\">{$dataSub[$j]['subNama']}</div>
                    <div class=\"col s2\">
                      <a href=\"submenu?actions=editsubmenu&dataId={$dataSub[$j]['subID']}&p={$parentsId}\" class=\"btn-floating waves-effect waves-light light-blue darken-4\">
                        <i class=\"material-icons small mdi-editor-mode-edit\"></i></a>&nbsp; 
                      <a class=\"btn-floating waves-effect waves-light red btnDelete\" id=data_{$dataSub[$j]['subID']}>
                        <i class=\"material-icons small mdi-content-clear\"></i></a>
                    </div>
                  </div>
                </li>";
      }
      $str .= "</ul>";
    endfor;
    $str .= "</ul>";
    return $str;
  }
  /* -- end submenu -- */

  function showKonten() {
    $q = "SELECT bid, judul, isi, tampildepan FROM t_berita_bnc";
    $data = $this->db->selectData($q);
    $str = "";
    for ($i = 0; $i < count($data); $i += 1) :
      $str .= "<tr id=berita_{$data[$i]['bid']}><td>" . $data[$i]['judul'] . "</td><td>" . $this->cleanTagAndSlicing($data[$i]['isi'], 10) . "</td><td>
        <a href=\"konten?actions=editkonten&dataid=". $data[$i]['bid'] ."\" class=\"btn-floating waves-effect waves-light light-blue darken-4\"><i class=\"material-icons\ small mdi-editor-mode-edit\"></i></a>&nbsp; <a class=\"btn-floating waves-effect waves-light red btnDelete\"><i class=\"material-icons\ small mdi-content-clear\"></i></a>
      </td>";
      $str .= "</tr>" . PHP_EOL;
    endfor;
    return $str;
  }

  // begin kontak testimoni
  function countUnreadKontak()
  {
    $q = "SELECT count(id) as byk FROM t_kontak_bnc WHERE status = '2'";
    $data = $this->db->selectDataSingle($q);
    return $data["byk"];
  }

  function statusKontakid($s)
  {
    if($s == "1")
      return "Sudah Dibaca.";
    elseif($s == "2")
      return "Belum Dibaca.";
    elseif($s == "3")
      return "Belum Direspon.";
    elseif($s == "4")
      return "Sudah Direspon.";
  }

  function statusKontaken($s)
  {
    if($s == "2")
      return "Unread.";
    elseif($s == "3")
      return "Not Replied.";
    elseif($s == "4")
      return "Replied.";
  }

  function updateKontakStatus($id)
  {
    $q = "UPDATE t_kontak_bnc set status = '3' WHERE id = '".$this->db->amanin($id)."'";
    $h = $this->db->insertData($q);
    if(!$h)
      return "0";
    return "1";
  }

  function getKontak($id)
  {
    $q = "SELECT * FROM t_kontak_bnc WHERE id = '".$this->db->amanin($id)."'";
    $data = $this->db->selectData($q);
    $h = "";
    for($i=0; $i<count($data); $i++):
      $h .= 'Dari : '.$data[$i]["nama"]."<br/>";
      $h .= 'E-Mail : '.$data[$i]["email"]."<br/>";
      $h .= "Tgl : ".$this->ubahTimeStamp($data[$i]["tgl"])."<br/>";
      $h .= "Pesan :<br/>";
      $h .= $data[$i]["pesan"];
      $h .= '<br/><a href=javascript:window.close();>Tutup</a>';
    endfor;
    return $h;
  }

  function getTestimoni($id)
  {
    $q = "SELECT * FROM t_testimoni_bnc WHERE id = '".$this->db->amanin($id)."'";
    $data = $this->db->selectData($q);
    $h = "";
    for($i=0; $i<count($data); $i++):
      $h .= 'Dari : '.$data[$i]["nama"]."<br/>";
      $h .= 'E-Mail : '.$data[$i]["email"]."<br/>";
      $h .= "Tgl : ".$this->ubahTimeStamp($data[$i]["tgl"])."<br/>";
      $h .= "Testimoni :<br/>";
      $h .= $data[$i]["pesan"];
      $h .= '<br/><a href=javascript:window.close();>Tutup</a>';
    endfor;
    return $h;
  }

  function countUnreadTestimoni()
  {
    $q = "SELECT count(id) as byk FROM t_testimoni_bnc WHERE status = '3'";
    $data = $this->db->selectDataSingle($q);
    return $data["byk"];
  }

  function laporanKontak()
  {
    $q = "SELECT * FROM t_kontak_bnc order by tgl DESC";
    $data = $this->db->selectData($q);
    $h = "";
    for($i=0; $i<count($data); $i++):
      $h .= '<tr><td class="tooltipped z-depth-2" data-tooltip=" Dari : '.$data[$i]["nama"].'" data-position="top">'.$data[$i]["nama"].'</td><td>'.$data[$i]["email"].'</td>';
      $h .= '<td><a class="waves-effect waves-light btn modal-trigger" href="readkontak?id='.$data[$i]["id"].'" target="_blank">Baca</a></td>';
      $h .= '<td>'.$this->ubahTimeStamp($data[$i]["tgl"]).'</td><td>'.$this->statusKontaken($data[$i]["status"]).'</td>';
      $h .= '<td>';
      $h .= '<a href="produk_aksi?a=e&q='.$data[$i]["id"].'" class="btn-floating waves-effect waves-light light-blue tooltipped z-depth-2" data-position="left" data-tooltip="Edit Dari '.$data[$i]["nama"].'"><i class=" mdi-editor-mode-edit"></i></a>';
      $h .= '<a href="produk_aksi?a=x&q='.$data[$i]["id"].'"" class="btn-floating waves-effect waves-light light-red tooltipped z-depth-2" data-position="left" data-tooltip="Hapus Dari '.$data[$i]["nama"].'"><i class=" mdi-content-clear"></i></a>';
      $h .= '</td></tr>';
      // $h .= '<div id="pesan'.$i.'" class="modal modal-fixed-footer"><div class="modal-content">';
      // $h .= $data[$i]["pesan"];
      // $h .= $this->updateKontakStatus($data[$i]["id"]);
      // $h .= '</div><div class="modal-footer"><a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat ">Tutup</a></div></div>';

    endfor;
    return $h;
  }

  function laporanTestimoni()
  {
    $q = "SELECT * FROM t_testimoni_bnc order by tgl DESC";
    $data = $this->db->selectData($q);
    $h = "";
    for($i=0; $i<count($data); $i++):
      $h .= '<tr><td class="tooltipped z-depth-2" data-tooltip=" Dari : '.$data[$i]["nama"].'" data-position="top">'.$data[$i]["nama"].'</td><td>'.$data[$i]["email"].'</td>';
      $h .= '<td><a class="waves-effect waves-light btn modal-trigger" href="readkontak?x=t&id='.$data[$i]["id"].'" target="_blank">Baca</a></td>';
      $h .= '<td>'.$this->ubahTimeStamp($data[$i]["tgl"]).'</td><td>'.(($data[$i]["status"] == "1") ? "Tampil" : "Tdk Tampil").'</td>';
      $h .= '<td>';
      $h .= '<a href="produk_aksi?a=e&q='.$data[$i]["id"].'" class="btn-floating waves-effect waves-light light-blue tooltipped z-depth-2" data-position="left" data-tooltip="Edit Dari '.$data[$i]["nama"].'"><i class=" mdi-editor-mode-edit"></i></a>';
      $h .= '<a href="produk_aksi?a=x&q='.$data[$i]["id"].'"" class="btn-floating waves-effect waves-light light-red tooltipped z-depth-2" data-position="left" data-tooltip="Hapus Dari '.$data[$i]["nama"].'"><i class=" mdi-content-clear"></i></a>';
      $h .= '</td></tr>';
      // $h .= '<div id="pesan'.$i.'" class="modal modal-fixed-footer"><div class="modal-content">';
      // $h .= $data[$i]["pesan"];
      // $h .= $this->updateKontakStatus($data[$i]["id"]);
      // $h .= '</div><div class="modal-footer"><a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat ">Tutup</a></div></div>';

    endfor;
    return $h;
  }

  // end kontak testimoni


}

 ?>
