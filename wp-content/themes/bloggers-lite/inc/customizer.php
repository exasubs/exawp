<?php

function bloggers_lite_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_logo' )->transport     = 'postMessage';
	$wp_customize->get_setting( 'footer_logo' )->transport     = 'postMessage';

	$wp_customize->selective_refresh->add_partial(
		'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'bloggers_lite_customize_partial_blogname',
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'bloggers_lite_customize_partial_blogdescription',
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'header_logo', array(
			'selector'        => '.site-branding-text a.header_logo',
			'render_callback' => 'bloggers_lite_customize_partial_header_image',
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'footer_logo', array(
			'selector'        => 'footer a.footer_logo',
			'render_callback' => 'bloggers_lite_customize_partial_footer_logo',
		)
	);
}

add_action( 'customize_register', 'bloggers_lite_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Bloggers Lite 1.0
 * @see bloggers_lite_customize_register()
 *
 * @return void
 */
function bloggers_lite_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Bloggers Lite 1.0
 * @see bloggers_lite_customize_register()
 *
 * @return void
 */
function bloggers_lite_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Render the site header logo for the selective refresh partial.
 *
 * @since Bloggers Lite 1.0
 * @see bloggers_lite_customize_register()
 *
 * @return void
 */
function bloggers_lite_customize_partial_header_image() {
	$bloggers_lite_header_logo = get_theme_mod( 'header_logo' );
	if ( $bloggers_lite_header_logo != '' ) {
		?> <img alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" src="<?php echo esc_url($bloggers_lite_header_logo); ?>" /> 
		<?php
	} elseif ( bloginfo( 'name' ) ) {
		bloginfo( 'name' );
	}
}

/**
 * Render the site footer logo for the selective refresh partial.
 *
 * @since Bloggers Lite 1.0
 * @see bloggers_lite_customize_register()
 *
 * @return void
 */
function bloggers_lite_customize_partial_footer_logo() {
	$bloggers_lite_footer_logo = get_theme_mod( 'footer_logo', '' );
	if( $bloggers_lite_footer_logo != '' ) {
	?>
	<img alt="<?php esc_attr_e( 'Free Responsive WordPress Theme', 'bloggers-lite' ); ?>" src="<?php echo esc_url($bloggers_lite_footer_logo) ; ?>" />
	<?php
	}
}
