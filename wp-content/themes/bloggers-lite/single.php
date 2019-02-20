<?php
/**
 * The Template for displaying all single posts
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

$bloggers_lite_header_bg_image = get_theme_mod( 'header_background_image' );
if ( '' == $bloggers_lite_header_bg_image ) {
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
<div class="blog-details">
	<div class="container">
		<div class="row">
			<div id="primary" class="<?php echo sanitize_html_classes(  $bloggers_lite_primary_class ); ?>">
				<?php
				if ( have_posts() ) :
					// Start the Loop.
					while ( have_posts() ) :
						the_post();
						/**
						 * Include the post format-specific template for the content. If you want to
						 * use this in a child theme, then include a file called called content-___.php
						 * (where ___ is the post format) and that will be used instead.
						 */
						get_template_part( 'content', 'single' );
						?>

						<div class="about-author blog-section">
							<h3 class="sidebar-title"><?php printf( esc_html__( 'About The Author', 'bloggers-lite' ), get_the_author() ); ?></h3>
							<div class="author-description">
								<div class="author_image">
									<?php
									$userid                 = get_users();
									$author_bio_avatar_size = apply_filters( 'blogger_author_bio_avatar_size', 68 );
									echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
									?>
								</div>
								<div class="author_details">
									<h5 class="author_name">
										<?php $author_post_url = get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>
										<a href="<?php echo esc_url( $author_post_url ); ?>"><?php the_author(); ?></a>
									</h5>
									<p><?php the_author_meta( 'description' ); ?></p>
								</div>
							</div>
						</div>
						<?php
						if ( get_next_post() || get_previous_post() ) {
							?>
							<div class="post-button blog-section"> 
								<?php
								if ( get_previous_post() ) {
									?>
									<div class="prev_button">
										<div class="arrow">
											<?php previous_post_link( '%link', '<span class="pagi_text"><i class="fa fa-angle-double-left"></i> ' . esc_html__( 'Previous Post', 'bloggers-lite' ) . '</span><p class="nav_title"> %title </p>', 'bloggers-lite' ); ?>
										</div>
									</div>
									<?php
								}

								if ( get_next_post() ) {
									?>
									<div class="next_button">
										<div class="arrow">
											<?php next_post_link( '%link', '<span class="pagi_text">' . esc_html__( 'Next Post', 'bloggers-lite' ) . ' <i class="fa fa-angle-double-right"></i></span><p class="nav_title"> %title </p>', 'bloggers-lite' ); ?>
										</div>
									</div>
									<?php
								}
								?>
							</div> 
							<?php
						}

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
					endwhile;
					// Previous/next page navigation.
				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );
				endif;
				?>
			</div><!-- #content -->
			<?php
			if ( ( 'right-sidebar' == $bloggers_lite_page_layout ) || ( 'left-sidebar' == $bloggers_lite_page_layout ) ) {
				get_sidebar();
			}
			?>
		</div><!-- #primary -->
	</div><!-- .row -->
</div><!-- .container -->
<?php get_footer(); ?>
