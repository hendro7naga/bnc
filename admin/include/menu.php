<?php
if(!isset($_SESSION))
{
    session_start();
}
require_once("../convikx/appsadmin.php");
?>
<ul id="slide-out" class="side-nav fixed leftside-navigation">
            <li class="user-details cyan darken-2">
                <div class="row">
                    <div class="col col s4 m4 l4">
                        <img src="images/<?php echo $kontrol->getFotoAdmin($_SESSION['login']); ?>" alt="" class="circle responsive-img valign profile-image">
                    </div>
                    <div class="col6 col6 s8 m8 l8">
                        <ul id="profile-dropdown" class="dropdown-content">
                            <li><a href="ubah_data"><i class="mdi-action-lock-outline"></i> Ubah Data</a>
                            </li>
                            <li><a href="ubah_foto"><i class="mdi-action-lock-outline"></i> Ubah Foto</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="?keluar"><i class="mdi-hardware-keyboard-tab"></i> Keluar</a>
                            </li>
                        </ul>
                        <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown"><?php echo $kontrol->getNamaDepan($kontrol->getNamaLengkap($_SESSION['login'])); ?><i class="mdi-navigation-arrow-drop-down right"></i></a>
                        <p class="user-roal">Administrator</p>
                    </div>
                </div>
            </li>
            <li class="bold"><a href="index.html" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Beranda</a>
            </li>
            <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    <?php echo $kontrol->menuAdmin(); ?>
                </ul>
            </li>
           
        </ul>