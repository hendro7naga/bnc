<?php
require_once("../admin/include/ControlAdmin.php");
$kontrol = ControlAdmin::getInstanceMe();
if ($kontrol == null) {
  die("<h4 style=color:#fff;>Sorry.. Access denied</h4><hr style=color:#f00;/>");
} else if (!$kontrol->initDBInstanceController()) {
  die("<hr/><h5>Sorry.. Server Disconnected...</h5><hr/>");
}
?>
