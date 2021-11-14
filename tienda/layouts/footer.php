<footer class="site-footer border-top" id="footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 mb-0 mb-lg-0">
            <div class="row">

              <?php
                $resredes2= $conexion ->query("select * from redes where id >= 5") or die($conexion ->error);
                while ($redes2=mysqli_fetch_array($resredes2)) {
              ?>
              <div class="mb-4 col-md-6 col-lg-3 text-center">
                <?php 
                if ($redes2['id'] == 5) {
                    echo '
                      <h3 class="footer-heading mb-4 font-weight-bold align-middle"><a href="https://www.instagram.com/fres_art_/" target="_blank" style="color:#9c1e92;">INSTAGRAM</a> <a href="https://www.instagram.com/p/CDfrBdoAzgV/" target="_blank"><img src="'.BASE_URL_TIENDA.'/images/icons/like-insta.png" alt="Instagram"></a></h3>
                    ';
                  }elseif ($redes2['id'] == 6) {
                    echo '
                      <h3 class="footer-heading mb-4 font-weight-bold"><a href="https://www.facebook.com/FresArtoficial" target="_blank" style="color:#0178f7">FACEBOOK</a> <a href="https://www.facebook.com/FresArtoficial/photos/a.1205973619804178/1205973593137514/" target="_blank"><img src="'.BASE_URL_TIENDA.'/images/icons/like-face.png" alt="Facebook"></a></h3>
                    ';
                  }else{
                    echo '
                      <h3 class="footer-heading mb-4 font-weight-bold"><a href="https://twitter.com/fresssart" target="_blank" style="color:#1d9ceb;">TWITTER</a> <a href="https://twitter.com/fresssart" target="_blank"><img src="'.BASE_URL_TIENDA.'/images/icons/twitter.png" alt="Twitter"></a></h3>
                    ';
                  }
                ?>
                <a href="<?= $redes2['link'];?>" target="_blank" title="<?= $redes2['nombre'];?>"><img src="<?= BASE_URL_TIENDA; ?>/images/redes/<?= $redes2['imagen'];?>" alt="<?= $redes2['nombre'];?>" class="img-fluid"></a>
              </div>
              <?php } ?>

              <div class="mb-4 col-md-6 col-lg-3">
                <div class="block-5 mb-1">
                  <h3 class="footer-heading mb-3 text-center text-md-left">CONTACTOS F-A</h3>
                  <ul class="list-unstyled text-center text-md-left">
                    <li class="mb-1"><i class="fas fa-map-marker-alt mr-2"></i> Venta para Mayorista</li>
                    <li class="mb-1">
                      <i class="fas fa-hashtag mr-2"></i>
                      <a href="https://www.facebook.com/FresArtoficial" target="_blank"><span class="rs rs-f"></span></a>
                      <a href="https://www.instagram.com/fres_art_/" target="_blank"><span class="rs rs-i"></span></a>
                      <a href="https://www.youtube.com/channel/UCQBfIBYI2zAgwDyeAFem0kQ" target="_blank"><span class="rs rs-y"></span></a>
                      <a href="https://api.whatsapp.com/send?phone=[51][940130484]" target="_blank"><span class="rs rs-w"></span></a>
                    </li>
                    <li class="mb-0">
                      <i class="fas fa-mobile-alt mr-2"></i>
                      <a href="tel://23923929210">51-989504797</a> /
                      <a href="tel://23923929210">51-997288425</a>
                    </li>
                    <li><i class="fas fa-envelope mr-2"></i> freddy.cuadros@fres-art.com</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          
        </div>
        <div class="row pt-1 mt-2 mb-0 text-center">
          <div class="col-md-12">
            <p>         
              Copyright &copy;
              <script>document.write(new Date().getFullYear());</script> Fres-Art        
            </p>
          </div>          
        </div>
      </div>
    </footer>
