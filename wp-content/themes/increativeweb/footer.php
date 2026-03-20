<?php
$footer_bg_color = icw_get_option( 'footer_bg_color' ) ? icw_get_option( 'footer_bg_color' ) : '#131314';
$footer_bg_image = icw_get_option( 'footer_bg_image' ) ? icw_get_option( 'footer_bg_image' ) : '';
$footer_style = 'background-color: ' . $footer_bg_color;
$copyright = icw_get_option( 'footer_copyright_text' );


if ( !$copyright ) {
  $copyright = esc_html__( '&copy; 2022 InCreativeWeb', 'ICWTHEME' );
}

$footer_bg = ( $footer_bg_image != '' ) ? 'data-background="' . esc_url( $footer_bg_image ) . '"': '';
?>
<footer class="main-footer" <?php echo esc_attr( $footer_bg ); ?> style="<?php echo esc_attr( $footer_style ); ?>">     
    <div class="container">
        <div class="footer-hire-us">
            <span class="sub-title">Hire Us To Change Your Brand</span>
            <h2 class="mw-1060">Do you have a project, maybe you are looking for creative solutions.</h2>
            <a href="/contact-us/" class="icw-btn">Let's Work Together<span class="arrow"></span></a>
        </div>
        <div class="footer-info">
          <div class="row">
            <?php if( is_active_sidebar('footer-widget-1') || is_active_sidebar('footer-widget-2')) { ?>
            <?php if( is_active_sidebar('footer-widget-1') ) : ?>
            <div class="col-lg-5">
              <?php dynamic_sidebar( 'footer-widget-1' ); ?>
              <div class="footer-link-block">
                  <h3 class="widget-title">Follow us</h3>
                  <ul class="social-icon">
                      <li><a href="https://www.facebook.com/InCreativeWeb" target="_blank" title="Like us on FaceBook"><em class="icons icon-facebook"></em>Facebook</a></li>
                      <li><a href="https://www.instagram.com/increative_web/" target="_blank" title="Visit Instagram"><i class="lni lni-instagram" style="color: #af81ff;margin-right:5px;"></i>Instagram</a></li>
                      <li><a href="https://www.linkedin.com/company/increativeweb" target="_blank" title="Visit LinkedIn"><em class="icons icon-linkedin"></em>Linkedin</a></li>
                      <li><a href="https://www.youtube.com/@InCreativeWeb" target="_blank" title="Visit YouTube"><em class="lni lni-youtube" style="color: #d91b1b;margin-right:5px;"></em>YouTube</a></li>
                  </ul>
                  <ul class="social-icon">
                      <li><a href="https://calendly.com/increativeweb/zoom-meeting?month=2026-03" target="_blank" title="Book a Meeting"><i class="lni lni-headphone" style="color: #0693e3;margin-right:5px;"></i>Book a Meeting</a></li>
                      <!-- <li><a href="https://join.skype.com/invite/b6mT8CUWL4va" target="_blank" title="Connect me on Skype (skype:jayesh2881?chat)"><em class="icons icon-skype"></em>Skype</a></li> -->
                  </ul>
              </div>
            </div>
            <?php endif; ?>
            <div class="col-lg-2 col-6">
              <?php if(has_nav_menu('footer')):
                echo '<h3 class="widget-title">Company</h3>';
                wp_nav_menu( array( 'theme_location' => 'footer', 'container'  => false, 'menu_class' => 'footer-nav','depth' => 1 ) );
              endif; ?>
            </div>
            <div class="col-lg-2 col-6">
            <?php if(has_nav_menu('services')):
                echo '<h3 class="widget-title">Services</h3>';
                wp_nav_menu( array( 'theme_location' => 'services', 'container'  => false, 'menu_class' => 'footer-nav','depth' => 1 ) );
              endif; ?>
            </div>
            <?php if( is_active_sidebar( 'footer-widget-2' ) ) : ?>
              <div class="col-lg-3">
                <?php dynamic_sidebar( 'footer-widget-2' ); ?>
              </div>
              <?php endif; ?>
              <?php } ?>
            </div>
        </div>
        <div class="copyright">Copyright © <?php echo $year = date('Y'); ?> InCreativeWeb - Creative Thinking. All Rights Reserved.</div>
    </div>
</footer>
<?php wp_footer(); ?>
<?php if(icw_get_option('before_body')) echo icw_get_option( 'before_body');?>
</body></html>