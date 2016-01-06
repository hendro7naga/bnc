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

function gantiImageUcapan($strImgName) {
	$q = "UPDATE t_ucapan_bnc SET gambarUtama='$strImgName' WHERE uid=1";
	return $kontrol->db->insertData($q);
}

if (isset($_FILES) && is_uploaded_file($_FILES['imgupload']['tmp_name'])) {
    //$direktori  = 'http://localhost/latihan/direktori/uploads';
    $direktori    = '../img/';
    //$folder     = 'Gambar\tempPhp';
    //$pathMoved  = handleDirektori($direktori, $folder, basename($_FILES['berkas']['name']));
    $pathMoved    = $direktori .  basename($_FILES['imgupload']['name']);
    sleep(2);
    if (move_uploaded_file($_FILES['imgupload']['tmp_name'], $pathMoved)) {
        //$img = '<img src="'. $pathMoved.'" />';
        $fname = basename($_FILES['imgupload']['name']);
        $detil = $_POST['details'];
        if ($detil == "ucapan") :
        	$q = "UPDATE t_ucapan_bnc SET gambarUtama='$fname' WHERE uid=1";
        	$res = $kontrol->db->insertData($q);
        	if ($res !== 1) {
        		echo 1;
        	} else {
        		echo 0;
        	}
        elseif ($detil == "berita") :
            # code...
            if (isset($_POST['datakey'])) {
                #code...
            }
            else {
                echo 1;
            }
        endif;
        //echo 'File is valid and was succesfully uploaded \n <br />' . $img;
    } else {
        echo 'Possible file attacked ';
    }
    
    //echo is_dir(handleDirektori($direktori, $folder));
    //var_dump($_FILES);
    //echo "<br /> " . is_array($_FILES['berkas']) . '<br />' . $_FILES['berkas'];
} else {
	echo "Tidak terdefenisi";
}

?>
