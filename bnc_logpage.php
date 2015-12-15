<?php
ini_set('session.use_trans_sid', '0');

// Create a random string, leaving out 'o' to avoid confusion with '0'
$char = strtoupper(substr(str_shuffle('abcdefghjkmnpqrstuvwxyz'), 0, 4));

// Concatenate the random string onto the random numbers
// The font 'Anorexia' doesn't have a character for '8', so the numbers will only go up to 7
// '0' is left out to avoid confusion with 'O'
$str = rand(1, 7) . rand(1, 7) . $char;

// Begin the session
session_start();

// Set the session contents
$_SESSION['captcha_id'] = $str;
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Web Fonts -->
    <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="assets/plugins/animate.css">
    <link rel="stylesheet" href="assets/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">

    <!-- CSS Page Style -->    
    <link rel="stylesheet" href="assets/css/pages/page_log_reg_v2.css">    

    <!-- CSS Customization -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link href="css/notif.css" rel="stylesheet" type="text/css" />
</head> 

<body>

<!--=== Content Part ===-->    
<div class="container">
    <!--Reg Block-->
    <div class="reg-block">
        <div class="reg-block-header">
            <h2>Sign In</h2>
            <center>LOGO</center>         
        </div>
        <form id="bnc" method="post" action="ajadasfdfsa.bnc">
        <div class="input-group margin-bottom-20">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="text" name="username" id="username" class="form-control" placeholder="Username">
        </div>
        <div class="input-group margin-bottom-20">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
        </div>
        <div class="input-group margin-bottom-20">
            <img src="assets/plugins/sky-forms-pro/skyforms/captcha/image.php?<?php echo time(); ?>" alt="Gambar Kode" height="32" width="100">
        </div>
        <div class="input-group margin-bottom-20">
        	<input maxlength="6" name="kode" id="kode" type="text" placeholder="Ketik Kode Diatas" class="form-control">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
        </div>
        <hr>
              
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <button type="submit" class="btn-u btn-block">Log In</button>
            </div>
        </div>
        <div id="tunggu" style="display:none;"><img src="img/loading01.gif" alt="loading..." width="100px" height="100px" /> Loading...</div>
        <div id="hasil"></div>
        </form>
    </div>
    <!--End Reg Block-->
</div><!--/container-->
<!--=== End Content Part ===-->

<!-- JS Global Compulsory -->           
<script type="text/javascript" src="assets/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="assets/plugins/jquery/jquery-migrate.min.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
<!-- JS Implementing Plugins -->           
<script type="text/javascript" src="assets/plugins/back-to-top.js"></script>
<script type="text/javascript" src="assets/plugins/backstretch/jquery.backstretch.min.js"></script>
<!-- JS Customization -->
<script type="text/javascript" src="assets/js/custom.js"></script>
<!-- JS Page Level -->           
<script type="text/javascript" src="assets/js/app.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();
        });
</script>
<script type="text/javascript">
    $.backstretch([
      "assets/img/bg/19.jpg",
      "assets/img/bg/18.jpg",
      ], {
        fade: 1000,
        duration: 7000
    });
</script>
<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->
<script type="text/javascript">
$(document).ready(function() {

	$(document).ajaxStart(function() {
  		$('#tunggu').show();
  		$('#hasil').hide();
  	}).ajaxStop(function() {
  		$('#tunggu').hide();
  		$('#hasil').fadeIn('slow');
  	});

	$("#bnc").submit(function(e){
		e.preventDefault();
		dataString = $("#bnc").serialize();

		$.ajax({
		type: "POST",
		url:  $("#bnc").attr('action'),
		data: $("#bnc").serialize(),
		//dataType: "json",
		success: function(data) {
		  $('#hasil').html(data);

		}

		});
	});
});
</script>
</body>
</html> 