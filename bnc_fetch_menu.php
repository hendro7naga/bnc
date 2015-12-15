<?php
require_once("convikx/apps.php");
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title></title>

    <?php include("include/headpage.php"); ?>
</head>	

<body class="header-fixed header-fixed-space">    

<div class="wrapper">
    <!--=== Header v6 ===-->
    <div class="header-v6 header-classic-white header-sticky">
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

                <!-- Collect the nav links, forms, and other content for toggling -->
                	<?php include("include/menu.php"); ?>
                <!--/navbar-collapse-->
            </div>    
        </div>            
        <!-- End Navbar -->
    </div>
    <!--=== End Header v6 ===-->

    <?php
    	if(!isset($_GET['x']) && isset($_GET['q']))
    	{
    		if($_GET['q'] == "produk.html")
    			include("include/isiproduk.php");
    	}
    	elseif(isset($_GET['x']) && $_GET['x'] == "detailp.html")
    	{
    		include("include/detailsubp.php");
    	}
    	elseif(isset($_GET['x']) && $_GET['x'] == "detail.html")
    	{
    		if(isset($_GET['q']))
    		{
    			if(($_GET['q'] == "info") OR ($_GET['q'] == "infomember") OR ($_GET['q'] == "fasilitas") OR ($_GET['q'] == "konten"))
    				include("include/detailsub.php");
    		}
    	}
    	else
    		include("include/isi.php");
    ?>

    <!--=== Footer Version 1 ===-->
     <?php include("include/footer.php"); ?> 
    <!--=== End Footer Version 1 ===-->
</div><!--/wrapper-->

<!-- JS Global Compulsory -->			
<?php include("include/jsbawah.php"); ?>

</body>
</html>	
