<!-- Collect the nav links, forms, and other content for toggling -->
<?php
require_once("./convikx/apps.php");
?>
                <div class="collapse navbar-collapse navbar-responsive-collapse">
                    <div class="menu-container">
                        <ul class="nav navbar-nav">
                            <!-- Home -->
                            <?php
                              echo $kontrol->fillMenuHeader() . PHP_EOL;
                            ?>
                            <!-- hapus sampai disini -->
                        </ul>
                    </div>
                </div><!--/navbar-collapse-->
