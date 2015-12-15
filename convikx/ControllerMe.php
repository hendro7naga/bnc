<?php
require_once("DebeSQL.php");
class ControllerMe {
  private static $controllerme;
  private $db;
  private function __construct() {
    #code...
  }
  function __destruct() {
    #code...
  }

  static function getInstanceMe() {
    if (self::$controllerme == null) {
      self::$controllerme = 1;
      return new static;
      //self::$controllerme = new static;
      //return self::$controllerme;
    }
    else {
      //return self::$controllerme;
      return null;
    }
  }

  function initDBInstanceController() {
    $this->db = DebeSQL::getInstanceDebe($this);
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

  function cekSubParentId($q)
  {
    $queris = "SELECT subID, subParentID FROM t_submenuhead_bnc WHERE subID = '".$this->db->amanin($q)."' LIMIT 1";
    $data = $this->db->selectDataSingle($queris);
    $parentId = $data['subParentID'];
    return $parentId;
  }

  function urlSubMenu($induk)
  {
    if($induk == "101") // id produk
      return "produk";
    elseif($induk == "102") // id info
      return "info";
    elseif($induk == "103") // id info member
      return "infomember";
    elseif($induk == "104") // id fasilitas
      return "fasilitas";
    elseif($induk == "105") // id Lainnya
      return "konten";
    else
      return "error";
  }

  function fillMenuHeader() {
    $q = "SELECT * FROM t_menuhead_bnc";
    $dataMain = $this->db->selectData($q);
    $str = "";
    for ($i = 0; $i < count($dataMain); $i+=1)
    {
      $str .= "<li class=dropdown><a class=dropdown-toggle data-toggle=dropdown href=javascript:void(0);>";
      $str .= $dataMain[$i]['menuNama'] . "</a>".PHP_EOL;

      $qSub = "SELECT subID, subNama FROM t_submenuhead_bnc WHERE subParentID='".$this->db->amanin($dataMain[$i]['menuID'])."';";
      $dataSub = $this->db->selectData($qSub);
      if (count($dataSub) > 0)
      {
        $str .= "<ul class=dropdown-menu>";
        for ($j = 0; $j < count($dataSub); $j += 1)
        {

          $str .= "<li><a href=".$this->urlSubMenu($this->cekSubParentId($dataSub[$j]['subID']))."_".$dataSub[$j]['subID'].".html>".$dataSub[$j]['subNama']."</a></li>".PHP_EOL;
        }
        $str .= "</ul>".PHP_EOL;
      }
      $str .= "</li>".PHP_EOL;
    }
    $str .= "<li class=dropdown><a class=dropdown-toggle data-toggle=dropdown href=javascript:void(0);>Kontak Kami</a>" .
            "<ul class=dropdown-menu><li><a href=kontak_kami.html>Kontak Kami</a></li><li><a href=testimoni.html>Testimoni</a></li></ul>";
    return $str;
  }

    /*.. for middle ...*/
  #$lengthSplice penanda jumlah kata yang akan diambil / ekstrak
  function cleanTagAndSlicing($content, $lengthSplice) {
    $data = rtrim(trim(preg_replace("/<.*?>/", " ", $content)));
    $dataArr = mb_split(" ", $data, mb_substr_count($data, " ") + 1);

    array_splice($dataArr, $lengthSplice);
    for ($i = 0; $i < count($dataArr); $i += 1) {
      if ($dataArr[$i] == "") {
        unset($dataArr[$i]);
      }
    }
    array_values($dataArr);
    return implode(" ", $dataArr);;
  }

  function loadPreviewContent($ids) {
    $q = "SELECT * FROM t_info_bnc WHERE infoID='".$this->db->amanin($ids)."'";
    $data = $this->db->selectDataSingle($q);


    $contents = $this->cleanTagAndSlicing($data['infoKonten'], 16);
    $contents .= "....";

    $str = "<h3 class=\"title-v3-bg text-uppercase\">{$data['infoJudul']}</h3>
    <p>{$contents}.</p>
    <a class=\"text-uppercase\" href=\"info_{$data['infoID']}.html\">Read More</a>";
    return $str;
  }

  function getUcapan() {
    $q = "SELECT * FROM t_ucapan_bnc";
    $data = $this->db->selectDataSingle($q);
    $str = "<p>{$data['isi']}</p>" . PHP_EOL;
    $str .= "<small style=\"color:#31708F !important; font-weight: 400;\">- {$data['penulis']} -</small>" . PHP_EOL;
    return $str;
  }

  function getBeritaTerbaru() {
    $q = "SELECT * FROM t_berita_bnc WHERE tampildepan=1 LIMIT 3";
    $data = $this->db->selectData($q);
    $str = "";
    for ($i = 0; $i < count($data); $i += 1) {
      $str .= "<div class=\"col-sm-4 col-sm-offset-3\">
          <div class=\"thumbnails-v1\">
              <div class=\"thumbnail-img\">
                  <img class=\"img-responsive\" src=\"img/{$data[$i]['gambarUtama']}\" alt=bnCoffeeImages>
              </div>
              <div class=caption>
                  <h3><a href=javascript:void(0)>{$data[$i]['judul']}</a></h3>
                  <p>". $this->cleanTagAndSlicing($data[$i]['isi'], 17) ." .....</p>
                  <p><a class=\"read-more\" href=berita_{$data[$i]['bid']}.html>See More</a></p>
              </div>
          </div>
      </div>" . PHP_EOL;
    }
    return $str;
  }

  function getTestimonial() {
    $q = "SELECT * FROM t_testimoni_bnc";
    $data = $this->db->selectData($q);
    $str = "";

    for ($i = 0; $i < count($data); $i += 1) {
      if ($i == 0)
        $str .= "<div class=\"item active\">" . PHP_EOL;
      else
        $str .= "<div class=item>" . PHP_EOL;

      $str .= "<div class=\"headline-center-v2 headline-center-v2-dark\">
              <h2>Apa kata orang mengenai kami?</h2>
              <span class=\"bordered-icon\"><i class=\"fa fa-th-large\"></i></span>
              <p>{$data[$i]['isi']}</p>
              <span class=\"author\">{$data[$i]['nama']}, <a href=\"http://{$data[$i]['website']}\" target=_blank>{$data[$i]['jabatan']}</a></span></div>" . PHP_EOL;
      $str .= "</div>" . PHP_EOL;
    }
    return $str;
  }

  /*.. end of middle ...*/

  /*... for footer ...*/
  function getLocation() {
    $q = "SELECT infoJalan, infoKota, infoProvinsi, infoNegara, infoTelepon, infoFax, infoMails FROM t_informasi_bnc";
    $dataLokasi = $this->db->selectData($q);
    $str = "<address class=md-margin-bottom-40>";
    for ($i = 0; $i < count($dataLokasi); $i += 1) {
      $str .= $dataLokasi[$i]['infoJalan'] . " ";
      $str .= $dataLokasi[$i]['infoKota'];
      $str .= ", ".$dataLokasi[$i]['infoProvinsi'] . "<br/>" . PHP_EOL;
      $str .= $dataLokasi[$i]['infoNegara'] . "<br/>" . PHP_EOL;
      $str .= "Phone: " . $dataLokasi[$i]['infoTelepon'] . "<br/>" . PHP_EOL;
      $str .= "Fax: " . $dataLokasi[$i]['infoFax'] . "<br/>" . PHP_EOL;
      $str .= "Email: <a href=mailto:{$dataLokasi[$i]['infoMails']} class=>" . $dataLokasi[$i]['infoMails'] . "</a>" . PHP_EOL;
    }
    $str .= "</address>";
    return $str;
  }

  function getTimeOpened() {
    $q = "SELECT * FROM t_info_bnc WHERE infoID=114";
    $data = $this->db->selectDataSingle($q);
    return $data['infoKonten'];
  }

  function getGreetings() {
    $q = "SELECT infoKonten FROM t_info_bnc WHERE infoID=115";
    $data = $this->db->selectDataSingle($q);
    return $data['infoKonten'];
  }

  function getSosMed() 
  {
    $q = "SELECT * FROM t_sosmed_bnc";
    $dataSosmed = $this->db->selectData($q);
    $str = "";
    for ($i = 0; $i < count($dataSosmed); $i += 1) {
      if (!$dataSosmed[$i]['userSosmed'] == null):
        $str .= "<li><a href=http://{$dataSosmed[$i]['urlSosmed']}/{$dataSosmed[$i]['userSosmed']} class=tooltips data-toggle=tooltip data-placement=top title=\"\" data-original-title=".ucwords(str_replace("-plus","+",$dataSosmed[$i]['namaSosmed']))." target=_blank><i class=\"fa fa-{$dataSosmed[$i]['namaSosmed']}\"></i></a></li>";
      endif;
    }
    return $str;
  }
  /*... end for footer ...*/

  // begin login
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

  function catatUserAgent()
  {
    return $_SERVER['HTTP_USER_AGENT'];
  }

  function buatLog($user)
  {
    $q = "INSERT INTO `t_loglogin_bnc` (`id`, `uname`, `ip`, `user_agent`, `tgl`) VALUES (NULL, '$user', '".$_SERVER['REMOTE_ADDR']."', '".$this->catatUserAgent()."', CURRENT_TIMESTAMP)";
    $h = $this->db->insertData($q);
    if(!$h)
      return "0";
    return "1";
  }
  // end login

}

?>