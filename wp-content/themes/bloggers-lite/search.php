<?php
/**
 * The template for displaying Search Results pages
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
?>
<div class="single_top_bar <?php echo sanitize_html_classes( $bloggers_lite_cls ); ?> entry-header" style="background-image: url(<?php echo esc_url( $bloggers_lite_header_bg_image ); ?> );">
	<div class="bredcrumbs_blocks">
		<div class="container">
			<div class="row">
				<h1 class="entry-title col-xs-12">
					<?php printf( esc_html__( 'Search Results for', 'bloggers-lite' ) . ': <span>' . get_search_query() . '</span>' ); ?>
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
			<section id="primary" class="<?php echo sanitize_html_classes(  $bloggers_lite_primary_class ); ?> search_page">
				<div id="content" role="main">

					<?php if ( have_posts() ) : ?>
						<?php /* Start the Loop */ ?>
						<?php
						while ( have_posts() ) :
							the_post();
?>
							<?php get_template_part( 'content', get_post_format() ); ?>
						<?php endwhile;  ?>
                                                <div class="text-center">
                                                    <?php
                                                        the_posts_pagination();
                                                    ?>
                                                </div>

					<?php else : ?>

						<article id="post-0" class="post no-results not-found">
							<header class="post-header">
								<h1 class="custom-header"><?php esc_html_e( 'Nothing Found', 'bloggers-lite' ); ?></h1>
							</header>
							<div class="entry-content">
								<p><?php esc_html_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'bloggers-lite' ); ?></p>
								<?php get_search_form(); ?>
							</div><!-- .entry-content -->
						</article><!-- #post-0 -->

					<?php endif; ?>

				</div><!-- #content -->
			</section><!-- #primary -->
			<?php
			if ( ( 'right-sidebar' == $bloggers_lite_page_layout ) || ( 'left-sidebar' == $bloggers_lite_page_layout ) ) {
				get_sidebar();
			}
			?>
		</div><!-- .row -->
	</div><!-- .container -->
</div>
<?php get_footer(); ?>
