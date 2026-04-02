<?php
$footer_bg_color = icw_get_option( 'footer_bg_color' ) ? icw_get_option( 'footer_bg_color' ) : '#fbfbfb';
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
		<div class="footer-wrapper">
			<div class="footer-hire-us">
				<div class="section-title">
					<span class="tagline">Hire Us To Change Your Brand</span>
					<h2>Do you have a project, maybe you are looking for creative solutions.</h2>
					<a href="/contact-us/" class="icw-btn">Let's Work Together<span class="arrow"></span></a>
				</div>
				<div class="animation-svg">
					<div class="icon">
						<svg width="45" height="44" viewBox="0 0 45 44" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0 44C0 44 0.0894274 23.3832 0.0894274 22H0.0655831C0.0655833 17.6486 1.35601 13.3948 3.77367 9.7768C6.19132 6.15883 9.62761 3.33905 13.6479 1.6741C17.6683 0.00914752 22.092 -0.426192 26.3598 0.423168C30.6275 1.27253 34.5476 3.36843 37.6241 6.44578C40.7006 9.5231 42.7954 13.4437 43.6436 17.7117C43.774 18.3677 43.874 19.0273 43.9439 19.6887L21.1726 19.788L21.1924 24.3191L43.9534 24.2198C43.7382 26.3413 43.2146 28.4318 42.3893 30.4232C40.7232 34.443 37.9025 37.8786 34.2838 40.2952C30.6652 42.7119 26.4111 44.0012 22.0596 44H0ZM44.0506 22.8144C44.073 22.2082 44.0704 21.6008 44.0426 20.9936L44.0506 22.8144Z" fill="#0693E3"/></svg>	
					</div>				
				</div>
			</div>
			<div class="footer-info">
				<div class="row">
					<?php if( is_active_sidebar('footer-widget-1') || is_active_sidebar('footer-widget-2')) { ?>
					<?php if( is_active_sidebar('footer-widget-1') ) : ?>
					<div class="col-lg-5">
					<?php dynamic_sidebar( 'footer-widget-1' ); ?>
					</div>
					<?php endif; ?>
					<div class="col-lg-7">
					<div class="footer-menus-block">
						<div class="footer-menu-block">
						<?php if(has_nav_menu('footer')):
							echo '<h3 class="widget-title">Company</h3>';
							wp_nav_menu( array( 'theme_location' => 'footer', 'container'  => false, 'menu_class' => 'footer-nav','depth' => 1 ) );
						endif; ?>
						</div>
						<div class="footer-menu-block">
						<?php if(has_nav_menu('services')):
							echo '<h3 class="widget-title">Services</h3>';
							wp_nav_menu( array( 'theme_location' => 'services', 'container'  => false, 'menu_class' => 'footer-nav','depth' => 1 ) );
						endif; ?>
						</div>
						<?php if( is_active_sidebar( 'footer-widget-2' ) ) : ?>
						<div class="footer-menu-block">
						<?php dynamic_sidebar( 'footer-widget-2' ); ?>	
						</div>
						<?php endif; ?>
					</div>
					<?php } ?>
					</div>
					</div>
				
				<div class="copyright-block">
					<div class="copyright-text">Copyright © <?php echo $year = date('Y'); ?> InCreativeWeb - Creative Thinking. All Rights Reserved.</div>
					<div class="social-lists">
						<ul class="social-icon">
							<li><a href="https://www.facebook.com/InCreativeWeb" target="_blank" data-toggle="tooltip" title="Like us on FaceBook"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg></a></li>
							<li><a href="https://www.instagram.com/increative_web/" target="_blank" data-toggle="tooltip" title="Visit Instagram"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line></svg></a></li>
							<li><a href="https://www.linkedin.com/company/increativeweb" target="_blank" data-toggle="tooltip" title="Visit LinkedIn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect width="4" height="12" x="2" y="9"></rect><circle cx="4" cy="4" r="2"></circle></svg></a></li>
							<li><a href="https://www.youtube.com/@InCreativeWeb" target="_blank" data-toggle="tooltip" title="Visit YouTube"><svg width="27" height="19" viewBox="0 0 27 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M24.0616 2.5271C23.78 2.28422 23.4386 2.14545 23.1884 2.05997C22.9089 1.96452 22.5894 1.88602 22.2535 1.81936C21.5798 1.68563 20.7377 1.57982 19.8039 1.4972C17.9305 1.33141 15.5827 1.25 13.25 1.25C10.9174 1.25 8.56946 1.33141 6.69606 1.49719C5.76242 1.57982 4.92026 1.68563 4.24653 1.81935C3.91066 1.88601 3.59123 1.96452 3.3117 2.05997C3.06139 2.14545 2.71995 2.28422 2.43847 2.5271C2.17164 2.75732 2.02069 3.0413 1.93608 3.22824C1.8418 3.43654 1.76981 3.66231 1.71252 3.88105C1.59763 4.31982 1.51129 4.85027 1.44565 5.41569C1.31349 6.55395 1.25 7.9707 1.25 9.3785C1.25 10.7873 1.31358 12.2244 1.44496 13.4047C1.51041 13.9926 1.59548 14.5429 1.70583 15.005C1.8012 15.4046 1.96018 15.9489 2.28208 16.3456C2.58058 16.7137 3.00495 16.8805 3.2147 16.9561C3.48698 17.0542 3.8018 17.1313 4.12676 17.195C4.78209 17.3235 5.62261 17.4242 6.56185 17.5027C8.44889 17.6603 10.8573 17.7378 13.25 17.7378C15.6427 17.7378 18.0512 17.6603 19.9381 17.5027C20.8774 17.4242 21.7179 17.3235 22.3733 17.195C22.6982 17.1313 23.0131 17.0542 23.2853 16.9561C23.4951 16.8805 23.9194 16.7137 24.218 16.3456C24.5399 15.9489 24.6988 15.4046 24.7942 15.005C24.9045 14.5429 24.9896 13.9926 25.0551 13.4047C25.1865 12.2244 25.25 10.7873 25.25 9.3785C25.25 7.9707 25.1866 6.55395 25.0544 5.41569C24.9887 4.85028 24.9024 4.31982 24.7876 3.88105C24.7303 3.66231 24.6582 3.43655 24.564 3.22824C24.4794 3.04129 24.3285 2.75732 24.0616 2.5271Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M16.4696 9.49384L10.8354 13.1184V5.86914L16.4696 9.49384Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></a></li>
							<li><a href="https://calendly.com/increativeweb/zoom-meeting?month=2026-03" target="_blank" data-toggle="tooltip" title="Book a Meeting"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21.8199 10.397C21.7625 9.89593 21.5344 9.45758 21.2064 9.16606C21.1337 4.09937 17.0322 0 12.0001 0C6.96787 0 2.86625 4.09937 2.79356 9.16606C2.46575 9.45745 2.23778 9.89539 2.18023 10.3961C1.25627 10.6201 0.567932 11.4539 0.567932 12.4458V14.6187C0.567932 15.6105 1.25627 16.4443 2.18023 16.6683C2.28408 17.5731 2.94542 18.2731 3.74362 18.2731H4.55055C5.4207 18.2731 6.12848 17.4416 6.12848 16.4194V10.645C6.12848 10.0737 5.90726 9.56206 5.56029 9.22177C5.60332 5.66577 8.47542 2.78617 12.0001 2.78617C15.5247 2.78617 18.3966 5.6657 18.4399 9.22164C18.0926 9.56192 17.8713 10.0736 17.8713 10.645V16.4194C17.8713 17.3988 18.5215 18.2028 19.3415 18.2683V19.8929C19.3415 21.002 18.4393 21.9042 17.3302 21.9042H15.6751C15.4619 21.2809 14.8706 20.8313 14.1761 20.8313H13.0729C12.1992 20.8313 11.4886 21.542 11.4886 22.4157C11.4886 23.2893 12.1993 24 13.0729 24H14.1761C14.8707 24 15.4619 23.5505 15.6751 22.9271H17.3302C19.0032 22.9271 20.3644 21.566 20.3644 19.8929V18.2683C21.1137 18.2085 21.7211 17.5315 21.8199 16.6675C22.7437 16.4434 23.4322 15.6103 23.4322 14.6186V12.4457C23.4321 11.454 22.7437 10.621 21.8199 10.397ZM2.16556 15.5745C1.82419 15.3914 1.59083 15.0325 1.59083 14.6187V12.4458C1.59083 12.032 1.82419 11.6729 2.16556 11.4899V15.5745ZM14.1761 22.9771H13.0729C12.7633 22.9771 12.5115 22.7253 12.5115 22.4157C12.5115 22.1061 12.7633 21.8542 13.0729 21.8542H14.1761C14.4856 21.8542 14.7375 22.1061 14.7375 22.4157C14.7375 22.7253 14.4856 22.9771 14.1761 22.9771ZM5.10558 16.4194C5.10558 16.8619 4.84624 17.2502 4.55055 17.2502H3.74356C3.44787 17.2502 3.18839 16.862 3.18839 16.4194V10.645C3.18839 10.2025 3.44787 9.81417 3.74356 9.81417H4.55055C4.84624 9.81417 5.10558 10.2024 5.10558 10.645V16.4194ZM12.0001 1.76327C8.0548 1.76327 4.81549 4.87179 4.55431 8.79147C4.55294 8.79147 4.55178 8.79134 4.55055 8.79134H3.83098C4.09305 4.46311 7.65642 1.0229 12.0001 1.0229C16.3435 1.0229 19.9069 4.46318 20.169 8.79134H19.4495C19.4484 8.79134 19.4474 8.79147 19.4463 8.79147C19.1851 4.87179 15.9454 1.76327 12.0001 1.76327ZM20.8115 16.4194C20.8115 16.8619 20.5522 17.2502 20.2563 17.2502H19.4495C19.1537 17.2502 18.8942 16.862 18.8942 16.4194V10.645C18.8942 10.2025 19.1537 9.81417 19.4495 9.81417H20.2563C20.5522 9.81417 20.8115 10.2024 20.8115 10.645V16.4194ZM22.4092 14.6187C22.4092 15.0325 22.1759 15.3916 21.8343 15.5746V11.4902C22.1759 11.6732 22.4092 12.0319 22.4092 12.4458V14.6187Z" fill="currentColor"/></svg></a></li>
							<!-- <li><a href="https://join.skype.com/invite/b6mT8CUWL4va" target="_blank" title="Connect me on Skype (skype:jayesh2881?chat)"><em class="icons icon-skype"></em>Skype</a></li> -->
						</ul>
					</div>
				</div>
			</div>
		</div>
    </div>
</footer>
<?php wp_footer(); ?>
<?php if(icw_get_option('before_body')) echo icw_get_option( 'before_body');?>
</body></html>