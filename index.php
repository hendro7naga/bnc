<?php
require_once("convikx/apps.php");
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <title><?php echo $kontrol->getTilte("title"); ?></title>

   <?php include("include/head.php"); ?>
</head>

<body class="header-fixed">

<div class="wrapper">
    <!--=== Header v6 ===-->
    <div class="header-v6 header-dark-transparent header-sticky">
        <!-- Navbar -->
        <div class="navbar mega-menu" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="menu-container">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Navbar Brand -->
                    <?php include("include/logo.php"); ?>
                    <!-- ENd Navbar Brand -->

                    <!-- Header Inner Right -->
                    <?php include("include/pencarian.php"); ?>
                    <!-- End Header Inner Right -->
                </div>

                <?php include("include/menu.php"); ?>
            </div>
        </div>
        <!-- End Navbar -->
    </div>
    <!--=== End Header v6 ===-->

    <?php include("include/slider.php"); ?>

    <!--=== Service Block ===-->
    <div class="container">
        <div class="headline-center-v2 headline-center-v2-dark margin-bottom-60">
            <h2>Bhineka Nusantara Coffee</h2>
            <span class="bordered-icon"><i class="fa fa-th-large"></i></span>
            <!--<p>Unify is an incredibly beautiful responsive Bootstrap Template for <a href="#">corporate</a> and creative professionals. It works on all major web browsers, tablets and phone.</p>-->
            <?php
              echo $kontrol->getGreetings();
            ?>
        </div><!--/Headline Center V2-->

        <div class="row margin-bottom-60">
            <div class="col-sm-4">
                <div class="service-block-v1 md-margin-bottom-50">
                    <i class="rounded-x icon-eye"></i>
                    <?php
                      echo $kontrol->loadPreviewContent("111") . PHP_EOL;
                    ?>
                    <!--<h3 class="title-v3-bg text-uppercase">Retina ready</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse non tincidunt neque.</p>
                    <a class="text-uppercase" href="#">Read More</a>-->
                </div>
            </div>
            <div class="col-sm-4">
                <div class="service-block-v1 md-margin-bottom-50">
                    <i class="rounded-x icon-pointer"></i>
                    <?php
                      echo $kontrol->loadPreviewContent("112");
                    ?>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="service-block-v1 md-margin-bottom-50">
                    <i class="rounded-x icon-cloud-upload"></i>
                    <?php
                      echo $kontrol->loadPreviewContent("113");
                    ?>
                </div>
            </div>
        </div><!--/row-->
    </div><!--/container-->
    <!--=== End Service Block ===-->

    <!--=== Parallax Backgound ===-->
     <div class="parallax-quote parallaxBg">
            <div class="container">
                <div class="parallax-quote-in">
                    <!--<p>Paralax nya pilih yang mana ? <span class="color-green">yang ini kah</span> ?.</p>
                    <small>- HtmlStream -</small>-->
                    <h3 class="color-green">Kami Mengucapkan</h3>
                    <?php
                      echo $kontrol->getUcapan();
                    ?>
                </div>
            </div>
        </div>
    <!--=== End Parallax Backgound ===-->

    <!--=== Recent Posts ===-->
    <div class="container content-sm">
        <div class="headline-center-v2 headline-center-v2-dark margin-bottom-60">
            <h2>Berita Terbaru</h2>
            <span class="bordered-icon"><i class="fa fa-th-large"></i></span>
            <p class="color-green">Informasi atau Berita terbaru dari Bhineka Nusantara Coffee (BN Coffee)</p>
        </div><!--/Headline Center V2-->

        <div class="row">
            <?php
              echo $kontrol->getBeritaTerbaru();
            ?>
        </div>
    </div><!--/container-->
    <!--=== End Recent Posts ===-->

    <!--=== Testimonials Section ===-->
    <div class="testimonials-bs bg-image-v2 parallaxBg1 margin-bottom-60">
        <div class="container">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php
                      /*for testimoni*/
                      //print_r($kontrol->getTestimonial());
                      echo $kontrol->getTestimonial();
                    ?>
                </div>

                <div class="carousel-arrow">
                    <a class="right carousel-control-v2" href="#carousel-example-generic" data-slide="next">
                        <i class="rounded-x fa fa-angle-left"></i>
                    </a>
                    <a class="left carousel-control-v2" href="#carousel-example-generic" data-slide="prev">
                        <i class="rounded-x fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--=== End Section ===-->

    <!--=== Footer Version 1 ===-->
    <?php include("include/footer.php"); ?>
    <!--=== End Footer Version 1 ===-->
</div><!--/wrapper-->

<?php include("include/jsbawah.php"); ?>

</body>
</html>
