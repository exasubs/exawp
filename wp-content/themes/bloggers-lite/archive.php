<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
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
	<div class="bredcrumbs_blocks archive-bredcrum">
		<div class="container">
			<div class="row">
				<h1 class="entry-title col-xs-12">
					<?php
					if ( is_day() ) :
						printf( esc_html__( 'Date Archives', 'bloggers-lite' ) . ': <span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :
						printf( esc_html__( 'Monthly Archives', 'bloggers-lite' ) . ': <span>' . get_the_date( 'F Y' ) . '</span>' );
					elseif ( is_year() ) :
						printf( esc_html__( 'Yearly Archives', 'bloggers-lite' ) . ': <span>' . get_the_date( 'Y' ) . '</span>' );
					else :
						the_archive_title();
					endif;
					?>
				</h1>
				<?php
				if ( $bloggers_lite_enable_breadcrumbs ) {
					?>
					<div class="col-xs-12 breadcrumb-block"><?php bloggers_lite_breadcrumb(); ?></div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

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
			<div id="primary" class="<?php echo sanitize_html_classes(  $bloggers_lite_primary_class ); ?> blog_wrapper archive_page list-layout">
				<div id="content" role="main">
					<?php
					if ( have_posts() ) {
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							get_template_part( 'content', get_post_format() );

						endwhile;
                                                ?>
                                                <div class="text-center">
                                                    <?php
                                                        the_posts_pagination();
                                                    ?>
                                                </div>
                                                <?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
                                        } else {
						get_template_part( 'content', 'none' );
                                        } // end have_posts() check.
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
