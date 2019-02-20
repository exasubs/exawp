<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Bloggers Lite
 * @since Bloggers Lite 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
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

if ( ! is_front_page() ) {
	?>
	<div class="single_top_bar <?php echo sanitize_html_classes( $bloggers_lite_cls ); ?> entry-header" style="background-image: url(<?php echo esc_url( $bloggers_lite_header_bg_image ); ?> );">
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
	<?php
}
?>
<div class="blog-details">
	<div class="container">
		<div class="row">
			<?php
			$bloggers_lite_page_layout = get_theme_mod( 'blog_page_layout', 'right-sidebar' );

			if ( 'right-sidebar' == $bloggers_lite_page_layout ) {
				$bloggers_lite_primary_class = 'col-sm-8 col-md-8 col-xs-12';
			} elseif ( 'left-sidebar' == $bloggers_lite_page_layout ) {
				$bloggers_lite_primary_class = 'col-sm-8 col-md-8 col-xs-12 col-sm-push-4';
			} elseif ( 'full-width' == $bloggers_lite_page_layout ) {
				$bloggers_lite_primary_class = 'col-sm-12 col-md-12 col-xs-12';
			} else {
				$bloggers_lite_primary_class = 'col-sm-8 col-md-8 col-xs-12';
			}
			if ( class_exists( 'WooCommerce' ) ) {
				if ( is_account_page() ) {
					$bloggers_lite_primary_class = 'col-md-12 col-sm-12 col-xs-12';
				}
			}
			?>
			<div id="primary" class="<?php echo sanitize_html_classes(  $bloggers_lite_primary_class ); ?> site-content">
				<div id="content" role="main">
					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>
				</div><!-- #content -->
			</div><!-- #primary -->
			<?php
			if ( ( 'right-sidebar' == $bloggers_lite_page_layout ) || ( 'left-sidebar' == $bloggers_lite_page_layout ) ) {
				if ( class_exists( 'WooCommerce' ) && ( is_cart() || is_checkout() ) ) {
					if ( is_active_sidebar( 'wc-sidebar' ) ) {
						?>
						<aside id="secondary" class="sidebar widget-area col-sm-4 col-xs-12" role="complementary">
							<?php dynamic_sidebar( 'wc-sidebar' ); ?>
						</aside>
						<?php
					} else {
						get_sidebar();
					}
				} else {
					if ( class_exists( 'WooCommerce' ) ) {
						if ( ! is_account_page() ) {
							get_sidebar();
						}
					} else {
						get_sidebar();
					}
				}
			}
			?>
		</div><!-- .row -->
	</div><!-- .container -->
</div>
<?php get_footer(); ?>
