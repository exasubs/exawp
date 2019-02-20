<?php
/**
 * The template for displaying image attachments
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
					<h1 class="entry-title col-xs-12"><?php echo get_the_title(); ?></h1>
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
			<div id="primary" class="<?php echo sanitize_html_classes(  $bloggers_lite_primary_class ); ?> site-content blog_wrapper">
				<div id="content" role="main">
					<?php
					while ( have_posts() ) :
						the_post();
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'image-attachment blog-section' ); ?>>
							<div class="post-header">
								<h2 class="custom-header"><?php echo get_the_title(); ?></h2>
								<div class="post-meta">
									<?php $metadata = wp_get_attachment_metadata(); ?>
									<span class="meta-prep meta-prep-entry-date"><?php esc_html_e( 'Published', 'bloggers-lite' ); ?> </span>
									<span class="entry-date">
										<time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date(); ?></time>
									</span> <?php esc_html_e( 'at', 'bloggers-lite' ); ?>
									<a href="<?php echo esc_url( wp_get_attachment_url() ); ?>"><?php echo esc_attr( $metadata['width'] ); ?> &times; <?php echo esc_attr( $metadata['height'] ); ?></a>
									<?php esc_html_e( 'in', 'bloggers-lite' ); ?>
									<a href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>" rel="gallery"><?php echo get_the_title( $post->post_parent ); ?></a>.
								</div>
							</div>

							<div class="entry-content">
								<div class="entry-attachment">
									<div class="attachment">
										<?php
										/**
										 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
										 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
										 */
										$attachments = array_values(
											get_children(
												array(
													'post_parent' => $post->post_parent,
													'post_status' => 'inherit',
													'post_type' => 'attachment',
													'post_mime_type' => 'image',
													'order' => 'ASC',
													'orderby' => 'menu_order ID',
												)
											)
										);
										foreach ( $attachments as $k => $attachment ) :
											if ( $attachment->ID == $post->ID ) {
												break;
											}
										endforeach;

										// If there is more than 1 attachment in a gallery.
										if ( count( $attachments ) > 1 ) :
											$k++;
											if ( isset( $attachments[ $k ] ) ) :
												// get the URL of the next image attachment.
												$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
											else :
												// or get the URL of the first image attachment.
												$next_attachment_url = get_attachment_link( $attachments[0]->ID );
											endif;
										else :
											// or, if there's only 1 image, get the URL of the image.
											$next_attachment_url = wp_get_attachment_url();
										endif;
										?>
										<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment">
											<?php
											/**
											 * Filter the image attachment size to use.
											 *
											 * @param array $size {
											 *     @type int The attachment height in pixels.
											 *     @type int The attachment width in pixels.
											 * }
											 */
											$attachment_size = apply_filters( 'blogger_attachment_size', array( 960, 960 ) );
											echo wp_get_attachment_image( $post->ID, $attachment_size );
											?>
										</a>
									</div><!-- .attachment -->
								</div><!-- .entry-attachment -->
								<?php
								if ( ! empty( $post->post_excerpt ) ) :
									?>
									<div class="entry-caption">
										<?php the_excerpt(); ?>
									</div>
									<?php
								endif;
								?>
							</div><!-- .entry-content -->

							<div class="entry-description post-entry">
								<?php the_content(); ?>
								<?php
								wp_link_pages(
									array(
										'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bloggers-lite' ),
										'after'  => '</div>',
									)
								);
								?>
							</div>

						</article><!-- #post -->

						<div class="post-button blog-section">
							<nav id="image-navigation" class="navigation" role="navigation">
								<span class="previous-image"><?php previous_image_link( false, '<i class="fa fa-angle-double-left"></i><span class="pagi_text"> ' . esc_html__( 'Previous', 'bloggers-lite' ) . '</span>' ); ?></span>
								<span class="next-image"><?php next_image_link( false, '<span class="pagi_text">' . esc_html__( 'Next', 'bloggers-lite' ) . ' <i class="fa fa-angle-double-right"></i></span>' ); ?></span>
							</nav><!-- #image-navigation -->
						</div>

						<?php
						comments_template();
					endwhile; // end of the loop.
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
