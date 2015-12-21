<?php
// untuk koneksi database.
class DebeSQL {
    private $server;
    private $db;
    private $user;
    private $userPass;
    private $conn;
    private static $debesql;

    private function __construct() {
    }
    function __destruct() {}

    function initInstanceProp() {
      $this->server = "localhost";
      $this->db = "bnc";
      $this->user = "root";
      $this->userPass = "";
      return $this->initConnection();
    }

    private function initConnection() {
      $this->conn = new mysqli($this->server, $this->user, $this->userPass, $this->db);
      if ($this->conn->connect_errno)
        return 0;
      else
        return 1;
    }

    private function closeConnection() {
      $this->conn->close();
    }

    function amanin($str) {
      if ($this->initConnection()) { // harus open koneksi dulu
        return $this->conn->real_escape_string($str);
      }
    }

    static function getInstanceDebe(ControllerMe $pengontrol) {
      //cek atau validasi dulu isi parameter...
      if (self::$debesql != null && !($pengontrol instanceof DebeSQL)) {
        return null;
      }
      else {
        return new static;
      }
    }

    static function getInstanceDebeAdmin(ControlAdmin $pengontrol) {
      //cek atau validasi dulu isi parameter...
      if (self::$debesql != null && !($pengontrol instanceof DebeSQL)) {
        return null;
      }
      else {
        return new static;
      }
    }

    /*
    * All query to db start here...
    */
    function selectData($queris) {
      $data = array();
      if ($this->initConnection()) {
        if ($result = $this->conn->query($queris)) {
          while ($rows = $result->fetch_assoc()):
            array_push($data, $rows);
          endwhile;
          //$fieldNum = $result->field_count;
          $result->free();
          $this->closeConnection();
          return $data;
        }
      }
      else {
        return null;
      }
    }

    function selectDataSingle($queris) {
      $data = null;
      if ($this->initConnection()) {
        if ($result = $this->conn->query($queris)) {
          while ($rows = $result->fetch_assoc()):
            $data = $rows;
          endwhile;
          $result->free();
          $this->closeConnection();
          return $data;
        }
      } else {
        return null;
      }
    }

    function jumlahBaris($q) {
      if ($this->initConnection()) {
        if ($result = $this->conn->query($q)) {
          return $result->num_rows;
        }
      }
      else {
        return null;
      }
    }

    function insertData($q) {
      if ($this->initConnection()) {
        return $this->conn->query($q);
      }
      else {
        return null;
      }
    }
    //end of query db ...

    public function bnc()
    {
      return "BNC";
    }

    public function urlBnc()
    {
      return "http://localhost/bnc/";
    }
}

/*.... end of DebeSQL class ....*/
?>
