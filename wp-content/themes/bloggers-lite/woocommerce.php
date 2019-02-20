<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Bloggers Lite
 * @since Bloggerss 1.0
 */

get_header();
$bloggers_lite_layoutmenu = get_theme_mod( 'header_mega_menu' );
if ( 'stricky-menu-left' !== $bloggers_lite_layoutmenu || 'stricky-menu-right' !== $bloggers_lite_layoutmenu ) {
	$bloggers_lite_cls = 'non-stricky';
}
$bloggers_lite_header_bg_image = get_theme_mod( 'header_background_image' );
if ( ! isset( $bloggers_lite_header_bg_image ) || '' == $bloggers_lite_header_bg_image ) {
	$bloggers_lite_header_bg_image = get_template_directory_uri() . '/images/footer-bg.jpg';
}
$bloggers_lite_enable_breadcrumbs = get_theme_mod( 'enable_breadcrumbs', 1 );
?>
<div class="single_top_bar <?php echo sanitize_html_classes( $bloggers_lite_cls ); ?> entry-header" style="background-image: url(<?php echo esc_url( $bloggers_lite_header_bg_image ); ?> );">
	<div class="bredcrumbs_blocks">
		<div class="container">
			<div class="row">
				<h1 class="entry-title col-xs-12">
					<?php
					if ( is_shop() ) {
						$esc_html_e( 'Shop', 'bloggers-lite' );
					} else {
						the_title();
					}
					?>
				</h1>
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
			<div id="primary" class="content-area col-md-8 col-sm-8 col-xs-12 single_blog_wrapper">
				<main id="main" class="site-main" role="main">
					<?php woocommerce_content(); ?>
				</main><!-- #main -->
			</div><!-- #primary -->
			<?php
			if ( is_active_sidebar( 'wc-sidebar' ) ) {
				?>
				<aside id="secondary" class="sidebar woocommerce-sidebar widget-area col-sm-4 col-xs-12" role="complementary">
					<?php dynamic_sidebar( 'wc-sidebar' ); ?>
				</aside>
				<?php
			} else {
				?>
				<aside id="secondary" class="sidebar woocommerce-sidebar widget-area col-sm-4 col-xs-12" role="complementary">
					<?php
					dynamic_sidebar( 'sidebar-1' );
					?>
				</aside>
				<?php
			}
			?>
		</div>
	</div>
</div>
<?php
get_footer();
