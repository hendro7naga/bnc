<?php
require_once("./convikx/apps.php");
?>
<div class="footer-v1">
        <div class="footer">
            <div class="container">
              <a href="index.html"><img id="logo-footer" class="footer-logo" src="assets/img/bnLogosTransA.png" alt=""></a>
                <div class="row">
                    <!-- About -->
                    <div class="col-md-3 md-margin-bottom-40">
                        <div class="headline"><h2>Jam dan Hari buka</h2></div>
                        <!--<p>About Unify dolor sit amet, consectetur adipiscing elit. Maecenas eget nisl id libero tincidunt sodales.</p>
                        <p>Duis eleifend fermentum ante ut aliquam. Cras mi risus, dignissim sed adipiscing ut, placerat non arcu.</p>-->
                        <?php
                          echo $kontrol->getTimeOpened() . PHP_EOL;
                        ?>
                    </div><!--/col-md-3-->
                    <!-- End About -->

                    <!-- Latest -->
                    <div class="col-md-3 md-margin-bottom-40">
                        <div class="posts">
                            <div class="headline"><h2>Berita Terbaru</h2></div>
                            <ul class="list-unstyled latest-list">
                                <!--<li>
                                    <a href="#">Incredible content</a>
                                    <small>May 8, 2014</small>
                                </li>
                                <li>
                                    <a href="#">Best shoots</a>
                                    <small>June 23, 2014</small>
                                </li>
                                <li>
                                    <a href="#">New Terms and Conditions</a>
                                    <small>September 15, 2014</small>
                                </li>-->
                                <?php
                                  echo $kontrol->getBeritaFooter();
                                ?>
                            </ul>
                        </div>
                    </div><!--/col-md-3-->
                    <!-- End Latest -->

                    <!-- Link List -->
                    <div class="col-md-3 md-margin-bottom-40">
                        <div class="headline"><h2>Link Terkait</h2></div>
                        <ul class="list-unstyled link-list">
                            <li><a href="profile/profil.html">Profil</a><i class="fa fa-angle-right"></i></li>
                            <li><a href="profile/sejarah.html">Sejarah</a><i class="fa fa-angle-right"></i></li>
                            <li><a href="profile/visi-misi.html">Visi Misi</a><i class="fa fa-angle-right"></i></li>
                            <li><a href="kontak_kami.html">Kontak Kami</a><i class="fa fa-angle-right"></i></li>
                            <li><a href="testimoni.html">Testimoni</a><i class="fa fa-angle-right"></i></li>
                        </ul>
                    </div><!--/col-md-3-->
                    <!-- End Link List -->

                    <!-- Address -->
                    <div class="col-md-3 map-img md-margin-bottom-40">
                        <div class="headline"><h2>Lokasi BN Coffee</h2></div>
                        <?php
                          echo $kontrol->getLocation() . PHP_EOL;
                        ?>
                        <!--<address class="md-margin-bottom-40">
                            25, Lorem Lis Street, Orange <br />
                            California, US <br />
                            Phone: 800 123 3456 <br />
                            Fax: 800 123 3456 <br />
                            Email: <a href="mailto:info@anybiz.com" class="">info@anybiz.com</a>
                        </address>-->
                    </div><!--/col-md-3-->
                    <!-- End Address -->
                </div>
            </div>
        </div><!--/footer-->

        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p>
                            &copy; 2015 Bhineka Nusantara Coffee - All Rights Reserved.
                           <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
                        </p>
                    </div>

                    <!-- Social Links -->
                    <div class="col-md-6">
                        <ul class="footer-socials list-inline">
                          <?php
                          echo $kontrol->getSosMed();
                          ?>
                        </ul>
                    </div>
                    <!-- End Social Links -->
                </div>
            </div>
        </div><!--/copyright-->
    </div>
