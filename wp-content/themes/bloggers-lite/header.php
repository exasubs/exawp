<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Bloggers Lite
 * @since Bloggers Lite 1.0
 */

?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
	<!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="Bloger" />
		<meta name="author" content="solwin infotech" />
		<link rel="profile" href="http://gmpg.org/xfn/11" />
                                    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
                                        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
                                    <?php endif; ?>
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<?php
		if ( 1 == get_theme_mod( 'enable_loader', true ) ) {
			if ( 1 == get_theme_mod( 'only_home', true ) ) {
				if ( is_front_page() ) {
					?>
					<div class="loader"><span class="rotating"></span></div>
					<?php
				}
			} else {
				?>
				<div class="loader"><span class="rotating"></span></div>
				<?php
			}
		}
		?>
		<div id="page" class="hfeed site">
			<?php
			$bloggers_lite_class = $bloggers_lite_class_blk = $bloggers_lite_cls = $bloggers_lite_block = $bloggers_lite_logo = $bloggers_lite_menu = $bloggers_lite_no_image = '';
			if ( is_front_page() ) {
				$bloggers_lite_class = 'menu-block';
			}
			if ( is_admin_bar_showing() ) {
				$bloggers_lite_class_blk = 'no_pad';
			}
			$bloggers_lite_layoutmenu = get_theme_mod( 'header_mega_menu', 'stricky-menu-left' );
			if ( 'left-menu' == $bloggers_lite_layoutmenu ) {
				$bloggers_lite_cls   = 'nav-menu-block-left';
				$bloggers_lite_block = 'non-stricky';
				$bloggers_lite_logo  = 'right-block';
				$bloggers_lite_menu  = 'left_menu';
			} elseif ( 'right-menu' == $bloggers_lite_layoutmenu ) {
				$bloggers_lite_cls   = 'nav-menu-block-right';
				$bloggers_lite_block = 'non-stricky';
				$bloggers_lite_logo  = 'left-block';
				$bloggers_lite_menu  = 'right_menu';
			} elseif ( 'center-menu' == $bloggers_lite_layoutmenu ) {
				$bloggers_lite_cls   = 'nav-menu-block-center';
				$bloggers_lite_block = 'non-stricky';
				$bloggers_lite_logo  = 'center-block';
				$bloggers_lite_menu  = 'center_menu';
			} elseif ( 'stricky-menu-left' == $bloggers_lite_layoutmenu ) {
				$bloggers_lite_cls   = 'nav-menu-block-stricky-left';
				$bloggers_lite_block = 'stricky';
				$bloggers_lite_logo  = 'left-block';
				$bloggers_lite_menu  = 'left-menu';
			} elseif ( 'stricky-menu-right' == $bloggers_lite_layoutmenu ) {
				$bloggers_lite_cls   = 'nav-menu-block-stricky-right';
				$bloggers_lite_block = 'stricky';
				$bloggers_lite_logo  = 'right-block';
				$bloggers_lite_menu  = 'right-menu';
			} else {
				$bloggers_lite_cls   = 'nav-menu-block-left';
				$bloggers_lite_block = 'non-stricky';
				$bloggers_lite_logo  = 'right-block';
				$bloggers_lite_menu  = 'left_menu';	
			}
			$custom_header_show = false;
			// Call avartan slider on latest post page.
			if ( is_front_page() ) {
				$height = '700px';
				load_template( ABSPATH . 'wp-admin/includes/plugin.php' );
				if ( is_plugin_active( 'avartan-slider-lite/avartanslider.php' ) || is_plugin_active( 'avartanslider/avartanslider.php' ) ) {
					if ( is_front_page() && ( function_exists( 'avartanslider' ) ) ) {
						$homepage_slider = esc_attr( get_theme_mod( 'homepage_avartan_slider', 0 ) );
						$avartan_id      = trim( $homepage_slider );
						if ( 0 != $avartan_id ) {
							global $wpdb;
							$avartan_table  = $wpdb->prefix . 'avartan_sliders';
							$avartan_alias = $wpdb->get_var( "SELECT alias from $avartan_table WHERE id = " . $avartan_id );
							?>
							<div class="slider">
								<?php
								if ( function_exists( 'avartanslider' ) ) {
									avartanslider( $avartan_alias );}
?>
							</div>
							<?php
						} else {
							if ( get_header_image() ) {
								$custom_header_show = true;
							}
						}
					}
				} else {
					if ( get_header_image() ) {
						$custom_header_show = true;
					}
				}
			}
			?>
			<header id="masthead" class="site-header <?php echo ( $custom_header_show == false ) ? 'no-header' . ' ' . sanitize_html_classes($bloggers_lite_class) . ' ' . sanitize_html_classes($bloggers_lite_class_blk) . ' ' . sanitize_html_classes($bloggers_lite_block) . ' ' . sanitize_html_classes($bloggers_lite_layoutmenu) : ''; ?>" role="banner">
				<div class="<?php echo ( sanitize_html_classes($custom_header_show) ) ? 'custom-header' : ''; ?>">
					<?php
					if ( $custom_header_show ) {
						?>
						<div class="custom-header-media">
							<?php the_custom_header_markup(); ?>
						</div>
						<?php
					}
					?>
					<div class="main-header <?php echo ( $custom_header_show ) ? sanitize_html_classes($bloggers_lite_no_image) . ' ' . sanitize_html_classes($bloggers_lite_class) . ' ' . sanitize_html_classes($bloggers_lite_class_blk) . ' ' . sanitize_html_classes($bloggers_lite_block) . ' ' . sanitize_html_classes($bloggers_lite_layoutmenu) : ''; ?> ">
						<div class="container">
							<div class="row">
								<div class="header">
									<div class="menu">
										<div class="col-md-4 col-sm-4 col-xs-4 site-header-logo <?php echo sanitize_html_classes($bloggers_lite_logo); ?>">
											<?php
											$bloggers_lite_header_tagline = get_bloginfo( 'description' );
											$bloggers_lite_tagclass       = ( ! empty( $bloggers_lite_header_tagline ) ) ? 'tagline' : 'notagline';
											$bloggers_lite_header_logo    = get_theme_mod( 'header_logo' );
											$bloggers_lite_logoclass      = ( $bloggers_lite_header_logo ) ? 'logo-img' : 'logo-text';
											?>
                                                                                    <div class="site-branding-text <?php echo sanitize_html_classes($bloggers_lite_tagclass) . ' ' . sanitize_html_classes($bloggers_lite_logoclass); ?>" >
												<?php
												if ( $bloggers_lite_header_logo != '' ) {
													echo ( is_front_page() ) ? '<h1 class="site-title">' : '';
													?>
													<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="header_logo">
														<img alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" src="<?php echo esc_url($bloggers_lite_header_logo); ?>" />
													</a>
													<?php
													echo ( is_front_page() ) ? '</h1>' : '';
												} elseif ( trim( get_bloginfo( 'name' ) ) != '' ) {
													if ( is_front_page() ) :
														?>
														<h1 class="site-title"><a class="site_title_text" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_attr( get_bloginfo( 'name' ) ); ?></a></h1> 
														<?php
													else :
														?>
														<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_attr( get_bloginfo( 'name' ) ); ?></a></p> 
														<?php
														endif;
												}
												// check if tagline empty or not.
												if ( trim( get_bloginfo( 'description' ) ) != '' ) {
													?>
													<span class="tagline site-description"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></span>
													<?php
												}
												?>
											</div>
										</div>

                                                                            <nav id="site-navigation" class="col-md-8 col-sm-8 col-xs-8 main-navigation mobilenav <?php echo sanitize_html_classes($bloggers_lite_menu); ?>" role="navigation">
											<?php
											// Call primary menu of theme.
											wp_nav_menu(
												array(
													'theme_location' => 'primary',
													'menu_class'  => 'nav-menu sf-menu',
												)
											);
											?>
										</nav><!-- #site-navigation -->

										<a class="icon <?php echo sanitize_html_classes( $bloggers_lite_cls ); ?>" href="javascript:void(0)">
											<div class="hamburger">
												<div class="menui top-menu"></div>
												<div class="menui mid-menu"></div>
												<div class="menui bottom-menu"></div>
											</div>
										</a>
									</div>
								</div>
							</div><!-- .row -->
						</div><!-- .container -->
					</div>
					<?php if ( $custom_header_show ) : ?>
						<div class="menu-scroll-cover">
							<div class="container">
								<a href="javascript:void(0)" class="menu-scroll-down">
									<i class="fa fa-angle-down"></i>
									<span class="screen-reader-text"><?php esc_html_e( 'Scroll down to content', 'bloggers-lite' ); ?></span>
								</a>
							</div>
						</div>
					<?php endif; ?>
				</div> 
			</header>


			<div id="main" class="wrapper">
