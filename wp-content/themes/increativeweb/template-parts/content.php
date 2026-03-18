<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package icw
 */

?>
<div class="post-content">
    <?php
    the_content( sprintf('%s %s',
        esc_html__('Continue reading', 'ICWTHEME'),
        '<span class="screen-reader-text"> ' . get_the_title() . '</span>'
    ) );

    wp_link_pages( array(
        'before'      => '<div class="page-links"><h6>' . esc_html__( 'Pages:',  'ICWTHEME' ) . '</h6>',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
    ) );
    ?>
    <br>


    <div class="author-bio">
        <div class="author-img">
            <img src="<?php echo wp_make_link_relative(get_template_directory_uri().'/images/jayesh-patel-profile.jpg');?>" alt="Jayesh Patel"/>
        </div>
        <div class="user-block">
            <div class="author-title">Author</div>
            <div class="author-name">Jayesh Patel</div>
            <div class="sort-info">
                <p><strong>Jayesh Patel is a Professional Web Developer & Designer and the Founder of InCreativeWeb.</strong></p>
                <p>As a highly Creative Web/Graphic/UI Designer - Front End / PHP / WordPress / Shopify Developer, with 14+ years of experience, he also provide complete solution from SEO to Digital Marketing. The passion he has for his work, his dedication, and ability to make quick, decisive decisions set him apart from the rest.</p>
                <p>His first priority is to create a website with Complete SEO + Speed Up + WordPress Security Code of standards.</p>
            </div>
            <div class="social-link-block">
                <h3 class="widget-title">Follow us</h3> 
                <ul class="social-icon"> 
                    <li><a href="https://www.facebook.com/jayesh.designer" target="_blank" title="Like us on FaceBook"><em class="icons icon-facebook"></em>Facebook</a></li> 
                    <li><a href="https://www.linkedin.com/in/jayeshhpatel" target="_blank" title="Visit LinkedIn"><em class="icons icon-linkedin"></em>Linkedin</a></li> 
                    <li><a href="skype:jayesh2881?chat" target="_blank" title="Connect me on Skype"><em class="icons icon-skype"></em>Skype</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="post-entry-footer">
        <?php icw_entry_footer(); ?>
    </div>
    <br>
</div>