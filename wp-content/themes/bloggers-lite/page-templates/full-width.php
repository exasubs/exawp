<?php
/**
 * Template Name: Full width Page Template
 *
 * @package Bloggers Lite
 * @since Bloggers Lite 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
get_header();

$bloggers_lite_layoutmenu = get_theme_mod( 'header_mega_menu', 'stricky-menu-left' );
if ( 'stricky-menu-left' !== $bloggers_lite_layoutmenu || 'stricky-menu-right' !== $bloggers_lite_layoutmenu ) {
	$bloggers_lite_cls = 'non-stricky';
}

$bloggers_lite_header_bg_img = get_theme_mod( 'header_background_image' );

if ( '' == $bloggers_lite_header_bg_img ) {
	$bloggers_lite_header_bg_img = get_template_directory_uri() . '/images/footer-bg.jpg';
}
?>
<div class="single_top_bar <?php echo sanitize_html_classes( $bloggers_lite_cls ); ?> entry-header" style="background-image: url(<?php echo esc_url( $bloggers_lite_header_bg_img ); ?> );">
	<div class="bredcrumbs_blocks">
		<div class="container">
			<div class="row">
				<h1 class="entry-title col-xs-12"><?php echo get_the_title(); ?></h1>
				<?php if ( get_theme_mod( 'enable_breadcrumbs', 1 ) ) { ?>
					<div class="col-xs-12 breadcrumb-block"><?php bloggers_lite_breadcrumb(); ?></div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<div class="blog-details">
	<div class="container">
		<div class="row">
			<div id="primary" class="site-content col-md-12 col-xs-12">
				<div id="content" role="main">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'content', 'page' );
						comments_template( '', true );
					endwhile; // end of the loop.
					?>
				</div><!-- #content -->
			</div><!-- #primary -->
		</div><!-- .row -->
	</div><!-- .container -->
</div>
<?php
get_footer();
