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
<html lang="en">
<head>
  <?php include("include/head.php"); ?>
  <title>BNC - Sub Menu</title>
  <script src="ckeditor/ckeditor.js"></script>
  <style type="text/css">
    #loadInfo {
      position: fixed;
      top: 75px;
      right: 10%;
      display: none;
      font-size: 10pt;
      background-color: #0091ea;
      color: #333;
      padding: 2px 6px;
      box-shadow: 0 0 4px 1px #999;
    }
  </style>
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
                <h5 class="breadcrumbs-title">Sub Menu</h5>
                <ol class="breadcrumb">
                  <li><a href="index">Beranda</a>
                  </li>
                  <li class="active">Informasi Sub Menu</li>
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
          NB: Sebelum melakukan edit atau hapus data, pastikan dahulu bahwa data tersebut merupakan data yang diinginkan.
            <!-- //////////////////////////////////////////////////////////////////////////// -->
            <div class="divider"></div>
            <!-- Form with validation -->
              <div class="col s12 m12 l6">
                <div class="card-panel">
                  <h4 class="header2">Data Sub Menu</h4>
                  <div class="divider"></div>
                  <div class="row">
                    <?php //echo $kontrol->formUbahData($_SESSION['login']); ?>
                    <div class="col s12">
                      <?php echo $kontrol->loadSubMenuItems(); ?>
                      <!--<ul class="collection with-header">
                        <li class="collection-header"><h5>First Names</h5>
                          <ul class="collection datasub">
                            <li class="collection-item">
                              <div class="row">
                                <div class="col s10">Sub Content</div>
                                <div class="col s2">
                                  <a href="" class="btn-floating waves-effect waves-light light-blue darken-4"><i class="material-icons small mdi-editor-mode-edit"></i></a>&nbsp; <a class="btn-floating waves-effect waves-light red btnDelete"><i class="material-icons small mdi-content-clear"></i></a>
                                </div>
                              </div>
                            </li>
                            <li class="collection-item">Sub</li>
                            <li class="collection-item">Sub</li>
                            <li class="collection-item">Sub</li>
                          </ul>
                        </li>
                        <li class="collection-header"><h5>Seconds Names</h5>
                          <ul class="collection datasub">
                            <li class="collection-item">Sub</li>
                            <li class="collection-item">Sub</li>
                            <li class="collection-item">Sub</li>
                            <li class="collection-item">Sub</li>
                          </ul>
                        </li>
                        <li class="collection-header"><h5>Third Names</h5>
                          <ul class="collection datasub">
                            <li class="collection-item">Sub</li>
                            <li class="collection-item">Sub</li>
                            <li class="collection-item">Sub</li>
                            <li class="collection-item">Sub</li>
                          </ul>
                        </li>
                      </ul> -->
                    </div>
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
    <script src="js/expression.js"></script>

  <!-- untuk validasi delete konten -->
  <script type="text/javascript">
  (function () {
    'use strict';
    var colHead   = $('.collection-header'),
        colItem  = $('.collection-item'),
        btndel    = $('.btnDelete'),
        tes       = null,
        xhr       = new XMLHttpRequest(),
        clicked   = function (evt) {
          evt.stopPropagation();
          var targets = evt.currentTarget.firstChild.nextSibling.nextSibling;
          $(targets).slideToggle();
          $(evt.currentTarget).toggleClass("active-selected");
        },
        getItem   = function (evt) {
          evt.stopPropagation();
        },
        deleteSubMenu = function (evt) {
          evt.stopPropagation();
          //alert(evt.currentTarget.id);
          if (confirm('Apa Anda yakin menghapus data ini?')) {
            if (!window.XMLHttpRequest) {
              expression.modals("Browser tidak mendukung teknologi terbaru kami. Silahkan perbaharui browser Anda.");
              return;
            } else {
              var nodes = evt.currentTarget.parentNode.parentNode;
              xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                  $("#loadInfo").css("display", "none");
                  if (xhr.status == 200) {
                    var respon = xhr.responseText;
                    if (respon == "1") {
                      //var el = document.getElementById(elId);
                      $(nodes).slideUp().remove();
                      expression.modals("Data berhasil dihapus!!!");
                    } else {
                      expression.modals("Terjadi kesalahan pada server. Harap hubungi pihak developer. Terima kasih!!!");
                    }
                  } else {
                    expression.modals("Terjadi kesalahan. Harap hubungi pihak developer. Terima kasih!!!");
                  }
                } else {
                  $("#loadInfo").css("display", "block");
                }
              };
              xhr.open("GET","p_hapussubm.php?actions=deletesubm&data="+evt.currentTarget.id, true);
              xhr.send(null);
            }
          } 
          //end of deletSubMenu function
        };
    $(function () {
      //$('.btnDelete').on('click', deleteFunc);
      $(colHead).on('click', clicked);
      $(colItem).on('click', getItem);
      $(btndel).on('click', deleteSubMenu);
    });
  
  })(jQuery, window, document);
  </script>

</body>

</html>
