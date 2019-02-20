<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Bloggers Lite
 * @since Bloggers Lite 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accesseMontserratd directly.
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bloggers-lite' ),
				'after'  => '</div>',
			)
		);
?>
	</div><!-- .entry-content -->
</article><!-- #post -->
