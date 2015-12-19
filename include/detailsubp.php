<?php
require_once("./convikx/apps.php");
?>
	<!--=== Breadcrumbs ===-->
	<div class="breadcrumbs">
	    <div class="container">
	        <h1 class="pull-left"><?php echo ($kontrol->idtipeProduk($_GET['idp']) =="1") ? 'Makanan':'Minuman'; ?></h1>
	        <ul class="pull-right breadcrumb">
	            <li><a href="index.html">Beranda</a></li>
	            <li><a href="">Produk</a></li>
	            <li class="active"><?php echo ($kontrol->idtipeProduk($_GET['idp']) =="1") ? 'Makanan':'Minuman'; ?></li>
	        </ul>
	    </div><!--/container-->
	</div><!--/breadcrumbs-->
	<!--=== End Breadcrumbs ===-->

     <!--=== Content Part ===-->
    <div class="container content">		
    	<div class="row blog-page blog-item">
            <!-- Left Sidebar -->
        	<div class="col-md-9 md-margin-bottom-60">
                <!--Blog Post-->        
                <?php echo $kontrol->detailProduk($_GET['idp']); ?>
                <!--End Blog Post-->        

    			<hr>
            </div>
            <!-- End Left Sidebar -->

            <!-- Right Sidebar -->
            <div class="col-md-3 magazine-page">

                <!-- Posts -->
                <div class="posts margin-bottom-40">
                    <div class="headline headline-md"><h2>Topik Terkait</h2></div>
                    <dl class="dl-horizontal">
                        <dt><a href="#"><img src="assets/img/sliders/elastislide/6.jpg" alt="" /></a></dt>
                        <dd>
                            <p><a href="#">Responsive Bootstrap 3 Template placerat idelo alac eratamet.</a></p> 
                        </dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><a href="#"><img src="assets/img/sliders/elastislide/10.jpg" alt="" /></a></dt>
                        <dd>
                            <p><a href="#">100+ Amazing Features Layer Slider, Layer Slider, Icons, 60+ Pages etc.</a></p> 
                        </dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><a href="#"><img src="assets/img/sliders/elastislide/11.jpg" alt="" /></a></dt>
                        <dd>
                            <p><a href="#">Developer Friendly Code imperdiet condime ntumi mperdiet condim.</a></p> 
                        </dd>
                    </dl>
                </div><!--/posts-->
                <!-- End Posts -->


                <!-- Post sebelumnya -->
                <div class="posts margin-bottom-40">
                    <div class="headline headline-md"><h2>Topik Lainnya</h2></div>
                    <dl class="dl-horizontal">
                        <dt><a href="#"><img src="assets/img/sliders/elastislide/6.jpg" alt="" /></a></dt>
                        <dd>
                            <p><a href="#">Responsive Bootstrap 3 Template placerat idelo alac eratamet.</a></p> 
                        </dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><a href="#"><img src="assets/img/sliders/elastislide/10.jpg" alt="" /></a></dt>
                        <dd>
                            <p><a href="#">100+ Amazing Features Layer Slider, Layer Slider, Icons, 60+ Pages etc.</a></p> 
                        </dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><a href="#"><img src="assets/img/sliders/elastislide/11.jpg" alt="" /></a></dt>
                        <dd>
                            <p><a href="#">Developer Friendly Code imperdiet condime ntumi mperdiet condim.</a></p> 
                        </dd>
                    </dl>
                </div><!--/posts-->
                <!-- End Post sebelumnya -->

            </div>
            <!-- End Right Sidebar -->
        </div><!--/row-->        
    </div><!--/container-->		
    <!--=== End Content Part ===-->
