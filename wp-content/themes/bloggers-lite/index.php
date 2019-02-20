<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bloggers Lite
 * @since Bloggers Lite 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
get_header();
if ( ! is_front_page() ) {

	$bloggers_lite_layoutmenu = get_theme_mod( 'header_mega_menu','stricky-menu-left' );
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
					<h1 class="entry-title col-xs-12"><?php echo esc_html_e( 'Blog', 'bloggers-lite' ); ?></h1>
					<?php if ( $bloggers_lite_enable_breadcrumbs ) { ?>
						<div class="col-xs-12 breadcrumb-block"><?php bloggers_lite_breadcrumb(); ?></div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
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
			?>
			<div id="primary" class="<?php echo sanitize_html_classes(  $bloggers_lite_primary_class ); ?> blog_wrapper list-layout">
				<div id="content" role="main">
					<?php
					load_template( ABSPATH . 'wp-admin/includes/plugin.php' );
					if ( is_plugin_active( 'blog-designer/blog-designer.php' ) && get_theme_mod( 'blog_page_design', 'default_design' ) == 'blog_designer_lite' ) {
						echo do_shortcode( '[wp_blog_designer]' );
					} else {
						if ( have_posts() ) :
							/* Start the Loop */
							while ( have_posts() ) :
								the_post();
								get_template_part( 'content', get_post_format() );
							endwhile;

							// Previous/next page navigation.
							?>
                                                        <div class="text-center">
                                                            <?php
                                                                the_posts_pagination();
                                                            ?>
                                                        </div>
                                                        <?php
						else :
							?>

						<?php
						endif; // end have_posts() check.
					}
					?>
				</div><!-- #content -->
			</div><!-- #primary -->
			<?php
			if ( ( 'right-sidebar' == $bloggers_lite_page_layout ) || ( 'left-sidebar' == $bloggers_lite_page_layout ) ) {
				get_sidebar();
			}
			?>
		</div><!-- .row -->
	</div><!-- .container -->
</div>
<?php get_footer(); ?>
