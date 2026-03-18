<?php
ob_start();
if( has_excerpt() ) {
	$post_content = the_excerpt();
} else {
	$post_content = the_content();
}
$post_content = ob_get_clean();

$strip_content = ( icw_get_option( 'archive_strip_content' ) ) ? icw_get_option( 'archive_strip_content' ) : 'no';

if( $strip_content !== 'no' ){
	$post_content = preg_replace( '~\[[^\]]+\]~', '', $post_content );
	$post_content = strip_tags( $post_content );
	$post_content = icw_get_the_post_excerpt( $post_content, 0 );
}
?>
<div id="post-<?php the_ID(); ?>" class="blog-post sticky">
    
		<?php if( icw_get_post_thumbnail_url() ) { ?>
	<figure class="post-image">
            <img src="<?php echo esc_url( icw_get_post_thumbnail_url() ); ?>" alt="<?php the_title_attribute(); ?>">
		</figure>
		<?php } ?>
		 
        <div class="post-content">
			<div class="post-inner">
			
            	<small class="post-date"><?php icw_posted_date_with_tags(); ?></small>

            	<h3 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				<?php icw_posted_by(); ?>
				
				<?php echo wp_kses_post( $post_content ); ?>
		
				<div class="post-link">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo esc_html__( 'READ MORE',  'ICWTHEME' ); ?></a>
				</div>
			<!-- end post-link -->
			</div>
			<!-- end post-inner -->
        </div>
	<!-- end post-content -->
   
</div>
<!-- end blog-post -->