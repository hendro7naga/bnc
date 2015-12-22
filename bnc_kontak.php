<?php
require_once("convikx/apps.php");
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title>Kontak Kami</title>
    <base href="<?php echo $kontrol->geturlBnc(); ?>" />
    <?php include("include/headpage.php"); ?>
     <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="assets/plugins/animate.css">
    <link rel="stylesheet" href="assets/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
    <!--[if lt IE 9]><link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms-ie8.css"><![endif]-->

    <!-- CSS Page Style -->    
    <link rel="stylesheet" href="assets/css/pages/page_contact.css">
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

     <!--=== Content Part ===-->
    <div class="container content">
        <div class="row margin-bottom-30">
            <div class="col-md-9 mb-margin-bottom-30">
                <div class="headline"><h2>Kontak Kami</h2></div>
                <p>Silahkan isi form kontak dibawah ini untuk memberi masukan, saran dan hal lainnya.</p>
                <form action="assets/php/sky-forms-pro/demo-contacts-process.php" method="post" id="sky-form3" class="sky-form sky-changes-3">
                    <fieldset>                  
                        <div class="row">
                            <section class="col col-6">
                                <label class="label">Nama</label>
                                <label class="input">
                                    <i class="icon-append fa fa-user"></i>
                                    <input type="text" name="name" id="name">
                                </label>
                            </section>
                            <section class="col col-6">
                                <label class="label">E-mail</label>
                                <label class="input">
                                    <i class="icon-append fa fa-envelope-o"></i>
                                    <input type="email" name="email" id="email">
                                </label>
                            </section>
                        </div>
                        
                        <section>
                            <label class="label">Subjek</label>
                            <label class="input">
                                <i class="icon-append fa fa-tag"></i>
                                <input type="text" name="subject" id="subject">
                            </label>
                        </section>
                        
                        <section>
                            <label class="label">Pesan Anda</label>
                            <label class="textarea">
                                <i class="icon-append fa fa-comment"></i>
                                <textarea rows="4" name="message" id="message"></textarea>
                            </label>
                        </section>
                        
                        <section>
                            <label class="label">Enter characters below:</label>
                            <label class="input input-captcha">
                                <img src="assets/plugins/sky-forms-pro/skyforms/captcha/image.php?<?php echo time(); ?>" width="100" height="32" alt="Captcha image" />
                                <input type="text" maxlength="6" name="captcha" id="captcha">
                            </label>
                        </section>
                        
                    </fieldset>
                    
                    <footer>
                        <button type="submit" class="btn-u">Kirim Pesan</button>
                    </footer>
                    
                    <div class="message">
                        <i class="rounded-x fa fa-check"></i>
                        <p>Terima kasih. Pesan sudah kami diterima.<br/>Pesan Anda akan kami tanggapi secepatnya!</p>
                    </div>
                </form>
            </div><!--/col-md-9-->
            
            <div class="col-md-3">
                <!-- Contacts -->
                <div class="headline"><h2>Alamat Kami</h2></div>
                <?php
                  echo $kontrol->getLocation() . PHP_EOL;
                ?>

                <!-- Business Hours -->
                <div class="headline"><h2>Jam Buka</h2></div>
                <?php
                  echo $kontrol->getTimeOpened() . PHP_EOL;
                ?>

            </div><!--/col-md-3-->
        </div><!--/row-->
    </div><!--/container-->     
    <!--=== End Content Part ===-->
    

    <!--=== Footer Version 1 ===-->
     <?php include("include/footer.php"); ?> 
    <!--=== End Footer Version 1 ===-->
</div><!--/wrapper-->

<!-- JS Global Compulsory -->			
<?php include("include/jsbawah.php"); ?>

</body>
</html>	
