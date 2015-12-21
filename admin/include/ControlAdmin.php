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
    $str .= '<li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-editor-insert-comment"></i> SubMenu</a>';
    $str .= '<div class="collapsible-body"><ul><li><a href="#">Tambah</a></li><li><a href="#">Edit/Hapus</a></li></ul></div></li>';
    $str .= '<li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-editor-insert-comment"></i> Konten</a>';
    $str .= '<div class="collapsible-body"><ul><li><a href="tambahkonten">Tambah</a></li><li><a href="#">Edit/Hapus</a></li></ul></div></li>';
    $str .= '<li class="bold"><a href="#" class="waves-effect waves-cyan"><i class="mdi-communication-email"></i> Kontak Kami <span class="new badge">4</span></a></li>';
    $str .= '<li class="bold"><a href="#" class="waves-effect waves-cyan"><i class="mdi-communication-email"></i> Testimoni <span class="new badge">4</span></a></li>';
    $str .= '<li class="bold"><a href="#" class="waves-effect waves-cyan"><i class="mdi-communication-email"></i> Ucapan </a></li>';
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
    $h = "";
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

  // function updateData()
  // {
  //   $queris = "UPDATE `t_menuinfo_bnc` SET namemenu='".$_POST['uname']."', katmenu='".$_POST['email']."', submenu='".$kontrol->buatPass($_POST['baru'])."', detail_menu = '".$_POST['nama']."' WHERE `id` = '".mysql_real_escape_string($id)."'
  // }

}

 ?>