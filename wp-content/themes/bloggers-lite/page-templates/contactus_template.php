<?php
/**
 * Template Name: Contact us Page Template
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
$bloggers_lite_enable_breadcrumbs = get_theme_mod( 'enable_breadcrumbs', 1 );
?>
<div class="single_top_bar <?php echo sanitize_html_classes( $bloggers_lite_cls ); ?> entry-header" style="background-image: url(<?php echo esc_url( $bloggers_lite_header_bg_img ); ?> );">
	<div class="bredcrumbs_blocks">
		<div class="container">
			<div class="row">
				<h1 class="entry-title col-xs-12"><?php echo get_the_title(); ?></h1>
				<?php if ( $bloggers_lite_enable_breadcrumbs ) { ?>
					<div class="col-xs-12 breadcrumb-block"><?php bloggers_lite_breadcrumb(); ?></div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<div class="blog-details">
	<div class="container">
		<div class="row">
			<div id="content" class="site-content" role="main">
				<div class="container">
					<div class="row">
						<div id="primary" class="col-md-12 col-sm-12 col-xs-12 padding_0 contact-template content-area">
							<div class="col-sm-8 col-md-8 col-sm-12 contact-form contact-template-address">
								<?php
								while ( have_posts() ) :
									the_post();
									get_template_part( 'content', 'page' );
								endwhile;
								?>
							</div>
							<?php
							if ( is_active_sidebar( 'contact-sidebar' ) ) {
								?>
								<div id="secondary" class="col-xs-12 contact_us_form col-md-4 col-sm-4">
									<?php
									dynamic_sidebar( 'contact-sidebar' );
									?>
								</div>
							<?php } elseif ( is_active_sidebar( 'sidebar-1' ) ) { ?>
								<div id="secondary" class="col-xs-12 contact_us_form col-md-4 col-sm-4">
									<?php dynamic_sidebar( 'sidebar-1' ); ?>
								</div>
							<?php } ?>
						</div>
					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- #content -->
		</div><!-- .row -->
	</div><!-- .container -->
</div>
<?php
get_footer();
