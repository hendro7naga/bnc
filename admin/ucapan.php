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
  <title>BNC - Ucapan</title>
  <script src="ckeditor/ckeditor.js"></script>
  <script src="js/expression.js"></script>
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
                <h5 class="breadcrumbs-title">Ucapan</h5>
                <ol class="breadcrumb">
                  <li><a href="index">Beranda</a>
                  </li>
                  <li class="active">Edit Ucapan</li>
                </ol>
              </div>
            </div>
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
                    <?php //echo $kontrol->formUbahData($_SESSION['login']); ?>
                    <div class="col s12">
                      <?php
                      $q = "SELECT * FROM t_ucapan_bnc";
                      $data = $kontrol->db->selectDataSingle($q);
                      ?>
                      <!-- start here -->
                      <div class="section">
                        <span>Ubah Gambar : </span>
                        <div class="file-field input-field">
                          <div class="btn">
                            <span>File</span>
                            <input type="file" id="ubahgambar">
                          </div>
                          <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                          </div>
                        </div><br/>
                        <img class="responsive-img" src="../img/<?php echo $data['gambarUtama']; ?>" alt="" />
                      </div>
                      <div class="divider"></div>
                      <div class="section">
                        <div class="input-field col s12">
                          <i class="material-icons mdi-av-subtitles prefix"></i>
                          <textarea id="kontenucapan" name="kontenucapan" class="materialize-textarea" readonly="readonly"><?php echo $data['isi']; ?></textarea>
                          <label for="kontenucapan">Isi Ucapan :</label>
                          <div class="row right">
                            <div class="col s4" id="btnedit">
                              <a class="btn-floating waves-effect waves-light light-blue darken-4" title="Edit"><i class="material-icons small mdi-editor-mode-edit"></i></a>&nbsp;&nbsp;
                            </div>
                            <div class="col s4" id="btnsimpan" style="display: none !important;">
                              <a class="btn-floating waves-effect waves-light light-blue darken-4" title="Simpan"><i class="material-icons small mdi-content-save"></i></a>
                            </div>
                            <div class="col s4" id="btnbatal" style="display: none !important;">
                              <a class="btn-floating waves-effect waves-light light-blue darken-4" title="Batal"><i class="material-icons small mdi-navigation-cancel"></i></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <script type="text/javascript">
                  /*var fom         = document.getElementById('fomKonten'),
                      btn         = document.getElementById('btnSimpan'),
                      judul       = document.getElementById('judulKonten'),
                      dataKonten  = CKEDITOR.instances.editor1,
                      simpan      = function (evt) {
                          evt.stopPropagation();
                          if (!expression.validation.inputText(judul.value, 2)) {
                              expression.modals("Harap isikan judul dengan benar!");
                              judul.focus();
                              return;
                          }

                          dataKonten.updateElement();
                          if (expression.cleanTag(dataKonten.getData()).trim().length < 12) {
                            expression.modals("Konten yang akan disimpan tidak boleh kosong!!!");
                            return;
                          }

                          fom.submit();
                      };
                  btn.addEventListener('click', simpan);*/
              </script>
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
    (function () {
      'use strict';
      var xhr           = new XMLHttpRequest(),
          btnEdit       = $('#btnedit'),
          btnSimpan     = $('#btnsimpan'),
          btnBatal      = $('#btnbatal'),
          konten        = $('#kontenucapan'),
          xhrRespon     = function () {
            /*if (xhr.readyState === 4) {
              $("#loadInfo").css("display", "none");
              if (xhr.status === 200) {
                var respon = xhr.responseText;
                if (respon === 1) {
                  var el = document.getElementById(elId);
                  $(el).slideUp().remove();
                  expression.modals("Data berhasil dihapus!!!");
                } else {
                  expression.modals("Terjadi kesalahan pada server. Harap hubungi pihak developer. Terima kasih!!!");
                }
              } else {
                expression.modals("Terjadi kesalahan. Harap hubungi pihak developer. Terima kasih!!!");
              }
            } else {
              $("#loadInfo").css("display", "block");
            }*/
          },
          editFunc    = function (evt) {
            evt.stopPropagation();
            kontenucapan.removeAttribute("readonly");
            $(btnEdit).css("display", "none");
            $(btnSimpan).css("display", "inline-block");
            $(btnBatal).css("display", "inline-block");
            //alert(evt.target.nodeName);
          };

      $(function () {
        //$('.btnDelete').on('click', deleteFunc);
        $(btnEdit).on('click', editFunc);
      });

    })(jQuery, window, document);
    </script>



</body>
</html>
