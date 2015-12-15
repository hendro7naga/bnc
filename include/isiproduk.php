<?php
require_once("./convikx/apps.php");
?>
<!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left"><?php echo ($_GET['id'] =="1") ? 'Makanan':'Minuman'; ?></h1>
            <ul class="pull-right breadcrumb">
                <li><a href="index.html">Beranda</a></li>
                <li><a href="">Produk</a></li>
                <li class="active"><?php echo ($_GET['id'] =="1") ? 'Makanan':'Minuman'; ?></li>
            </ul>
        </div><!--/container-->
    </div><!--/breadcrumbs-->
    <!--=== End Breadcrumbs ===-->

    <!--=== Content ===-->
    <div class="container">
    <!-- Recent Works -->
        <div class="row margin-bottom-20">
        <?php echo $kontrol->getProduk($_GET['id']); ?>
        </div>
    	<!-- End Recent Works -->
    	</div> <!-- akhir konten -->
    <!--=== End Content ===-->
