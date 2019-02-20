<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @package Bloggers Lite
 * @since Bloggers Lite 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article id="post-0" class="post no-results not-found">
	<header class="post-header">
		<h2 class="custom-header"><?php esc_html_e( 'Nothing Found', 'bloggers-lite' ); ?></h2>
	</header>

	<div class="entry-content">
		<p><?php esc_html_e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'bloggers-lite' ); ?></p>
		<?php get_search_form(); ?>
	</div><!-- .entry-content -->

</article><!-- #post-0 -->
