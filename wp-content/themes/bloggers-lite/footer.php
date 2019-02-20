<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package Bloggers Lite
 * @since Bloggers Lite 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
</div><!-- #main .wrapper -->
<footer id="colophon" role="contentinfo" class="footer_area">

	<div class="footer">
		<?php if ( is_active_sidebar( 'footer-sidebar1' ) || is_active_sidebar( 'footer-sidebar2' ) || is_active_sidebar( 'footer-sidebar3' ) ) { ?>
			<div class="footer-top">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-sm-4 col-xs-12 widget_1">
							<?php
							if ( is_active_sidebar( 'footer-sidebar1' ) ) :
								dynamic_sidebar( 'footer-sidebar1' );
							endif;
							?>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12 widget_1">
							<?php
							if ( is_active_sidebar( 'footer-sidebar2' ) ) :
								dynamic_sidebar( 'footer-sidebar2' );
							endif;
							?>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12 widget_1">
							<?php
							if ( is_active_sidebar( 'footer-sidebar3' ) ) :
								dynamic_sidebar( 'footer-sidebar3' );
							endif;
							?>
						</div>
					</div><!-- .row -->
				</div>
			</div>

		<?php } ?>

		<div class="copyrights"
		<?php
		$bloggers_lite_footer_background_image = get_theme_mod( 'footer_background_image' );
		if ( '' != $bloggers_lite_footer_background_image ) {
		?>
		style='background-image: url("<?php echo esc_url( $bloggers_lite_footer_background_image ); ?>")'
				<?php } ?> >
			<div class="container">
				<div class="copyrights-content text-center">
					<?php
					$bloggers_lite_footer_logo = get_theme_mod( 'footer_logo' );
					if ( '' != $bloggers_lite_footer_logo ) {
						?>
						<a href="<?php echo esc_url( site_url() ); ?>" class="footer_logo"><img alt="<?php esc_attr_e( 'Free Responsive WordPress Theme', 'bloggers-lite' ); ?>" src="<?php echo esc_url( $bloggers_lite_footer_logo ); ?>" /></a> 
						<?php
					}
					?>
					<p><?php echo esc_html__( 'Proudly powered by ', 'bloggers-lite' ) . '<a href="https://wordpress.org/">WordPress</a> and'; ?><?php esc_html_e( ' Designed by ', 'bloggers-lite' ); ?><a href="<?php echo esc_url( 'https://www.solwininfotech.com/' ); ?>" target="_blank"><?php esc_html_e( ' Solwin Infotech', 'bloggers-lite' ); ?></a></p>
				</div>
			</div>
		</div>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php if ( 1 == esc_attr( get_theme_mod( 'enable_scroll_to_top', true ) ) ) { ?>
	<a id="to_top" href="javascript:void(0);" class="arrow-up">
		<i class="fa fa-chevron-circle-up"></i>
	</a>
<?php } ?>

<?php wp_footer(); ?>
</body>
</html>
