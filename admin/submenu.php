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
if (isset($_GET['actions'])) {
  $reqs = $_GET['actions'];
  $aksi = null;
  $heads = null;
  $fomname = null;
  $judul = "";
  $isiData = "";
  $kontenId = "";
  $parents = "";
  if ($reqs == 'tambahsubmenu') :
    $heads = "Tambah Sub Menu";
  elseif ($reqs == 'editsubmenu') :
  	$parents = $_GET['p'];
    $heads = "Edit Sub Menu";
    $kontenId = $_GET['dataId'];
    $q = "SELECT subID, subNama, subKonten FROM t_submenuhead_bnc WHERE subID='$kontenId'";
    $data = $kontrol->db->selectDataSingle($q);
    $judul = $data['subNama'];
    $isiData = $data['subKonten'];
  endif;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include("include/head.php"); ?>
  <title>BNC - <?php echo $heads; ?></title>
  <script src="ckeditor/ckeditor.js"></script>
  <script src="js/expression.js"></script>
  <link rel="stylesheet" type="text/css" href="css/custom.css">
</head>

<body>
  <!-- Start Page Loading -->
    <div id="loader-wrapper">
    Loading...
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!-- End Page Loading -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START HEADER -->
  <header id="header" class="page-topbar">
        <!-- start header nav-->
        <div class="navbar-fixed">
            <nav class="cyan">
                <div class="nav-wrapper">
                    <h1 class="logo-wrapper"><a href="index.html" class="brand-logo darken-1"><img src="../logos/bnLogoHeader.png" alt="bn coffee"></a> <span class="logo-text">BN Coffee</span></h1>
                    <ul class="right hide-on-med-and-down">
                        <li class="search-out">
                            <input type="text" class="search-out-text">
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect waves-block waves-light show-search"><i class="mdi-action-search"></i></a>
                        </li>
                        <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen"><i class="mdi-action-settings-overscan"></i></a>
                        </li>
                        <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light"><i class="mdi-social-notifications"></i></a>
                        </li>
                        <!-- Dropdown Trigger -->
                        <li><a href="#" data-activates="chat-out" class="waves-effect waves-block waves-light chat-collapse"><i class="mdi-communication-chat"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- end header nav-->
  </header>
  <!-- END HEADER -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START MAIN -->
  <div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">

      <!-- START LEFT SIDEBAR NAV-->
      <aside id="left-sidebar-nav">
        <?php include("include/menu.php"); ?>
        <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only darken-2"><i class="mdi-navigation-menu" ></i></a>
      </aside>
      <!-- END LEFT SIDEBAR NAV-->

      <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- START CONTENT -->
      <section id="content">

        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper" class=" grey lighten-3">
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Konten</h5>
                <ol class="breadcrumb">
                  <li><a href="index">Beranda</a>
                  </li>
                  <li class="active"><?php echo $heads; ?></li>
                </ol>
              </div>
            </div>
            <span id="loadInfo">Sedang proses...</span>
          </div>
        </div>
        <!--breadcrumbs end-->


        <!--start container-->
        <div class="container">
          <div class="section">
          NB: Isikan data konten dengan sebenar-benarnya.
            <!-- //////////////////////////////////////////////////////////////////////////// -->
            <div class="divider"></div>
            <!-- Form with validation -->
              <div class="col s12 m12 l6">
                <div class="card-panel">
                  <div class="row">
                    <form class="col s12" name="fommenu" id="fommenu" action="pt_submenu.php" method="POST">
                       <div class="row" id="rowparentmenu">
                       	<div class="input-field col s6">
											    <?php
											    	if ($reqs == "editsubmenu") : 
											    		echo $kontrol->loadMenus($parents) . PHP_EOL;
											    	?>
											    		<input type="hidden" name="kontenId" value="<?php echo $kontenId; ?> /">
											    	<?php
											    	else :
											    		echo $kontrol->loadMenus() . PHP_EOL;
											    	endif;
											    ?>
											    <label>Pilih Menu</label>
												</div>
                       </div>
                       <div class="divider"></div>
                        <div class="row">
	                        <div class="input-field col s6">
	                            <i class="material-icons mdi-av-subtitles prefix"></i>
	                            <input id="judulSubMenu" name="judulSubMenu" type="text" class="validate" value="<?php echo $judul; ?>">
	                            <label for="judulSubMenu">Judul Sub Menu</label>
	                        </div>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <div class="section">
                                <div class="input-field col s12">
                                  <textarea id="editor1" name="editor1" class="materialize-textarea"><?php echo $isiData; ?></textarea>
                                  <script>CKEDITOR.replace('editor1');</script>
                                  <br/><div class="divider"></div>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="section">
                                <input type="hidden" name="dataPost" value="<?php echo $reqs; ?>">
                                <div class="input-field col s12">
                                    <button class="btn waves-effect waves-light right" id="btnSimpan" type="button" name="action">Submit
                                        <i class="mdi-content-save right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
        </div>
        <!--end container-->

      </section>
      <!-- END CONTENT -->

    </div>
    <!-- END WRAPPER -->

  </div>
  <!-- END MAIN -->



  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START FOOTER -->
  <?php include("include/footer.php"); ?>
  <!-- END FOOTER -->



    <!-- ================================================
    Scripts
    ================================================ -->

    <!-- jQuery Library -->
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <!--materialize js-->
    <script type="text/javascript" src="js/materialize.js"></script>
    <!--prism-->
    <script type="text/javascript" src="js/prism.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <!-- chartjs -->
    <script type="text/javascript" src="js/plugins/chartjs/chart.min.js"></script>
    <script type="text/javascript" src="js/plugins/chartjs/chart-script.js"></script>

    <!-- sparkline -->
    <script type="text/javascript" src="js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script type="text/javascript" src="js/plugins/sparkline/sparkline-script.js"></script>

    <!-- chartist -->
    <script type="text/javascript" src="js/plugins/chartist-js/chartist.min.js"></script>

    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.js"></script>
	<script type="text/javascript" src="js/formaksi.js"></script>

<script type="text/javascript">
    /*Untuk fungsionalitas*/
    (function () {
    	'use strict';
    	var selectmenu	= document.getElementById("menupilihan"),
    		coba					= null,
    		dataKonten = CKEDITOR.instances.editor1,
    		judul 				= document.getElementById("judulSubMenu"),
    		btnSimpan 		= document.getElementById("btnSimpan"),
    		menudipilih		= "",
    		menuchoose		= function (evt) {
    			evt.stopPropagation();
    			var isi = selectmenu.options[selectmenu.selectedIndex].value;
    			menudipilih = isi;
    		},
    		validations		= function () {
    			//var dataKonten = CKEDITOR.instances.editor1;
    			<?php
    			if ($reqs == "tambahsubmenu") :
    			?>
    			if (menudipilih == "" || menudipilih == undefined) {
    				expression.modals("Silahkan pilih menu yang akan dijadikan sebagai menu utama dari submenu yang akan dibuat.");
    				selectmenu.focus();
    				return;
    			}
    			<?php
    			endif;
    			?>
    			if (!expression.validation.inputText(judul.value, 3)) {
    			    expression.modals("Harap isikan judul dengan benar!");
    			    judul.focus();
    			    return;
    			}
    		},
    		submitData		= function (evt) {
    			evt.stopPropagation();
    			dataKonten.updateElement();
    			validations();
    			$("#fommenu").submit();
    		};

	    $(function () {
	      $(selectmenu).on('change', menuchoose);
	      $(btnSimpan).on('click', submitData);
	    });
  
  	})(jQuery, window, document);
</script>

</body>

</html>
