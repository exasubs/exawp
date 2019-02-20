<?php
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package Bloggers Lite
 * @since Bloggers Lite 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$bloggers_lite_page_layout = get_theme_mod( 'blog_page_layout', 'right-sidebar' );
if ( 'right-sidebar' == $bloggers_lite_page_layout ) {
	$bloggers_lite_primary_class = 'col-sm-4 col-md-4 col-xs-12';
} elseif ( 'left-sidebar' == $bloggers_lite_page_layout ) {
	$bloggers_lite_primary_class = 'col-sm-4 col-md-4 col-xs-12 col-sm-pull-8 col-md-pull-8';
} else {
	$bloggers_lite_primary_class = 'col-sm-4 col-md-4 col-xs-12';
}
?>
<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
	<div id="secondary" class="widget-area <?php echo sanitize_html_classes(  $bloggers_lite_primary_class ); ?>" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- #secondary -->
<?php } ?>
