<?php
/**
 * Bloggers Lite functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @package Bloggers Lite
 * @since Bloggers Lite 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'bloggers_lite_setup' ) ) {

	/**
	 * Bloggers Lite setup.
	 *
	 * Sets up theme defaults and registers the various WordPress features that
	 * Bloggers Lite supports.
	 *
	 * @uses load_theme_textdomain() For translation/localization support.
	 * @uses add_editor_style() To add a Visual Editor stylesheet.
	 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
	 *  custom background, and post formats.
	 * @uses register_nav_menu() To add support for navigation menus.
	 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
	 */
	function bloggers_lite_setup() {
		/*
		 * Makes Bloggers Lite available for translation.
		 *
		 * Translations can be added to the /languages/ directory.
		 * If you're building a theme based on Bloggers Lite, use a find and replace
		 * to change 'bloggers-lite' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'bloggers-lite', get_template_directory() . '/languages' );

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		// Adds RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'title-tag' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menu( 'primary', esc_html__( 'Primary Menu', 'bloggers-lite' ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support(
			'post-formats', array(
				'image',
				'video',
				'quote',
				'link',
				'audio',
				'gallery',
				'chat',
				'aside',
			)
		);

		/*
		 * This theme supports custom background color and image,
		 * and here we also set up the default background color.
		 */
		add_theme_support( 'custom-background', array( 'default-color' => '#F2F2F2' ) );

		add_theme_support( 'custom-title-color', array( 'default-color' => '#000000' ) );

		// This theme uses a custom image size for featured images, displayed on "standard" posts.
		add_theme_support( 'post-thumbnails' );

		set_post_thumbnail_size( 1200, 9999 ); // Unlimited height, soft crop.

		/*
		 * Add custom image sizes.
		 */
		add_image_size( 'bloggers-lite-blog-post-single', 830, 370, true );
		add_image_size( 'bloggers-lite-blog-img', 100, 100, true );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support(
			'custom-header', apply_filters(
				'blogger_lite_custom_header_args', array(
					'default-image'      => get_parent_theme_file_uri( '/images/title_background_image.jpg' ),
					'default-text-color' => '',
					'width'              => 2000,
					'height'             => 1200,
					'flex-height'        => true,
					'video'              => true,
					'wp-head-callback'   => 'bloggers_lite_header_style',
				)
			)
		);

		register_default_headers(
			array(
				'default-image' => array(
					'url'           => '%s/images/title_background_image.jpg',
					'thumbnail_url' => '%s/images/title_background_image.jpg',
					'description'   => esc_html__( 'Default Header Image', 'bloggers-lite' ),
				),
			)
		);

		// Set up the content width value based on the theme's design and stylesheet.
		if ( ! isset( $content_width ) ) {
			$content_width = 625;
		}
	}
}
add_action( 'after_setup_theme', 'bloggers_lite_setup' );


if ( ! function_exists( 'bloggers_lite_admin_menu' ) ) {
	/**
	 * Add about theme page at admin side
	 */
	function bloggers_lite_admin_menu() {
		add_theme_page( esc_html__( 'About Bloggers Lite', 'bloggers-lite' ), esc_html__( 'About Bloggers Lite', 'bloggers-lite' ), 'manage_options', 'about_bloggers_lite', 'bloggers_lite_about_theme' );
		if ( ! function_exists( 'bloggers_lite_about_theme' ) ) {
			/**
			 * Add about theme page at admin side
			 */
			function bloggers_lite_about_theme() {
				get_template_part( 'inc/admin/about', 'bloggers_lite' );
			}
		}
	}
}
add_action( 'admin_menu', 'bloggers_lite_admin_menu' );


if ( ! function_exists( 'bloggers_lite_activation_admin_notice' ) ) {
	/**
	 * Display notice on theme activation
	 */
	function bloggers_lite_activation_admin_notice() {
		global $pagenow;
		if ( is_admin() && ( 'themes.php' == $pagenow ) && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', 'bloggers_lite_welcome_notice', 99 );
		}
	}
}
add_action( 'load-themes.php', 'bloggers_lite_activation_admin_notice' );


if ( ! function_exists( 'bloggers_lite_welcome_notice' ) ) {
	/**
	 * Display notice on theme activation
	 */
	function bloggers_lite_welcome_notice() {
		?>
		<div class="updated notice is-dismissible">
			<p><?php echo esc_html__( 'Welcome! Thank you for choosing Bloggers Lite! To fully take advantage of the best our theme can offer please make sure you visit our', 'bloggers-lite' ) . ' <a href="' . esc_url( 'themes.php?page=about_bloggers_lite' ) . '">' . esc_html__( 'welcome page.', 'bloggers-lite' ) . '</a>'; ?> </p>
			<p><a class="button" href="<?php echo esc_url( 'themes.php?page=about_bloggers_lite' ); ?>"><?php esc_html_e( 'Get started with Bloggers Lite', 'bloggers-lite' ); ?></a></p>
		</div>
		<?php
	}
}

if ( ! function_exists( 'bloggers_lite_header_style' ) ) :

	/**
	 * Styles the header text displayed on the site.
	 *
	 * Create your own bloggers_lite_header_style() function to override in a child theme.
	 *
	 * @since 1.0
	 *
	 * @see mine_custom_header_and_background().
	 */
	function bloggers_lite_header_style() {

		// If the header text option is untouched, let's bail.
		if ( display_header_text() ) {
			return;
		}

		// If the header text has been hidden.
		?>
		<style type="text/css" id="bloggers-header-css">
			.site-branding {
				margin: 0 auto 0 0;
			}
			 .site-title,
			.site-description {
				clip: rect(1px, 1px, 1px, 1px);
				position: absolute;
			}
		</style>
		<?php
	}

endif; // bloggers_lite_header_style.

if ( ! function_exists( 'bloggers_lite_scripts_styles' ) ) {

	/**
	 * Enqueue scripts and styles for front-end
	 *
	 * @since Bloggers Lite 1.0
	 */
	function bloggers_lite_scripts_styles() {
		/*
		 * Adds JavaScript to pages with the comment form to support
		 * sites with threaded comments (when in use).
		 */
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Adds JavaScript for handling the navigation menu hide-and-show behavior.
		wp_enqueue_script( 'bloggers-lite-navigation', get_template_directory_uri() . '/js/bloggers-lite-navigation.js', array( 'jquery' ), '20140711', true );

		// Loads our main stylesheet.
		wp_enqueue_style( 'bloggers-lite-style', get_stylesheet_uri() );

		// Load the html5 shiv.
		wp_enqueue_script( 'html5shiv-js', get_template_directory_uri() . '/js/html5shiv.js', array(), '3.7.3' );
		wp_script_add_data( 'html5shiv-js', 'conditional', 'lt IE 9' );
	}
}
add_action( 'wp_enqueue_scripts', 'bloggers_lite_scripts_styles' );

if ( ! function_exists( 'bloggers_lite_page_menu_args' ) ) {

	/**
	 *
	 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
	 *
	 * @since Bloggers Lite 1.0
	 * @param array $args Arguments for menu.
	 */
	function bloggers_lite_page_menu_args( $args ) {
		if ( ! isset( $args['show_home'] ) ) {
			$args['show_home'] = true;
		}
		return $args;
	}
}
add_filter( 'wp_page_menu_args', 'bloggers_lite_page_menu_args' );

if ( ! function_exists( 'bloggers_lite_widgets_init' ) ) {

	/**
	 * Registers our main widget area and the front page widget areas.
	 *
	 * @since Bloggers Lite 1.0
	 */
	function bloggers_lite_widgets_init() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Main Sidebar', 'bloggers-lite' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'bloggers-lite' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
		if ( class_exists( 'WooCommerce' ) ) {
			register_sidebar(
				array(
					'name'          => esc_html__( 'WooCommerce Sidebar', 'bloggers-lite' ),
					'id'            => 'wc-sidebar',
					'description'   => esc_html__( 'Add WooCommerce widgets here.', 'bloggers-lite' ),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget'  => '</aside>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
				)
			);
		}
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Column 1', 'bloggers-lite' ),
				'id'            => 'footer-sidebar1',
				'description'   => esc_html__( 'Appears in footer', 'bloggers-lite' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Column 2', 'bloggers-lite' ),
				'id'            => 'footer-sidebar2',
				'description'   => esc_html__( 'Appears in footer', 'bloggers-lite' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Column 3', 'bloggers-lite' ),
				'id'            => 'footer-sidebar3',
				'description'   => esc_html__( 'Appears in footer', 'bloggers-lite' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Contact Page Widget', 'bloggers-lite' ),
				'id'            => 'contact-sidebar',
				'description'   => esc_html__( 'Appears in Contact page', 'bloggers-lite' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
	}
}
add_action( 'widgets_init', 'bloggers_lite_widgets_init' );

if ( ! function_exists( 'bloggers_lite_content_nav' ) ) :

	/**
	 *
	 * Displays navigation to next/previous pages when applicable.
	 *
	 * @since Bloggers Lite 1.0
	 *
	 * @param array $html_id Arguments for navigation id.
	 */
	function bloggers_lite_content_nav( $html_id ) {
		global $wp_query;
		if ( $wp_query->max_num_pages > 1 ) :
			?>
			<nav id="<?php echo esc_attr( $html_id ); ?>" class="navigation" role="navigation">
				<h3 class="assistive-text"><?php esc_html_e( 'Post navigation', 'bloggers-lite' ); ?></h3>
				<div class="nav-previous"><?php next_posts_link( '<span class="meta-nav">&larr;</span> ' . esc_html__( 'Older posts', 'bloggers-lite' ) ); ?></div>
				<div class="nav-next"><?php previous_posts_link( esc_html__( 'Newer posts', 'bloggers-lite' ) . ' <span class="meta-nav">&rarr;</span>' ); ?></div>
			</nav><!-- #<?php echo esc_attr( $html_id ); ?> .navigation -->
			<?php
		endif;
	}

endif;

if ( ! function_exists( 'bloggers_lite_body_class' ) ) {

	/**
	 *
	 * Extend the default WordPress body classes.\
	 *
	 * @since Bloggers Lite 1.0
	 *
	 * Extends the default WordPress body class to denote:
	 * 1. Using a full-width layout, when no active widgets in the sidebar
	 *    or full-width template.
	 * 2. Front Page template: thumbnail in use and number of sidebars for
	 *    widget areas.
	 * 3. White or empty background color to change the layout and spacing.
	 * 4. Custom fonts enabled.
	 * 5. Single or multiple authors.
	 *
	 * @param array $classes Existing class values.
	 * @return array Filtered class values.
	 */
	function bloggers_lite_body_class( $classes ) {
		$background_color = get_background_color();
		$background_image = get_background_image();

		if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) ) {
			$classes[] = 'full-width';
		}

		if ( is_page_template( 'page-templates/front-page.php' ) ) {
			$classes[] = 'template-front-page';
			if ( has_post_thumbnail() ) {
				$classes[] = 'has-post-thumbnail';
			}
			if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) ) {
				$classes[] = 'two-sidebars';
			}
		}

		if ( empty( $background_image ) ) {
			if ( empty( $background_color ) ) {
				$classes[] = 'custom-background-empty';
			} elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) ) {
				$classes[] = 'custom-background-white';
			}
		}

		// Enable custom font class only if the font CSS is queued to load.
		if ( wp_style_is( 'bloggers-lite-fonts', 'queue' ) ) {
			$classes[] = 'custom-font-enabled';
		}

		if ( ! is_multi_author() ) {
			$classes[] = 'single-author';
		}

		return $classes;
	}
}
add_filter( 'body_class', 'bloggers_lite_body_class' );


if ( ! function_exists( 'bloggers_lite_content_width' ) ) {

	/**
	 *
	 * Adjust content width in certain contexts.
	 *
	 * @since Bloggers Lite 1.0
	 *
	 * Adjusts content_width value for full-width and single image attachment
	 * templates, and when there are no active widgets in the sidebar.
	 */
	function bloggers_lite_content_width() {
		if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
			global $content_width;
			$content_width = 960;
		}
	}
}
add_action( 'template_redirect', 'bloggers_lite_content_width' );

if ( ! function_exists( 'bloggers_lite_register_scipts_styles' ) ) {
	add_action( 'wp_enqueue_scripts', 'bloggers_lite_register_scipts_styles' );
	/**
	 *
	 * Register & Enqueue script and style required for Bloggers Lite Theme
	 *
	 * @since Bloggers Lite 1.0
	 */
	function bloggers_lite_register_scipts_styles() {
		wp_register_script( 'bootstrap', get_template_directory_uri() . '/bootstrap/js/bootstrap.js');
		wp_register_script( 'jquery-slick-js', get_template_directory_uri() . '/js/jquery-slick.js', array('jquery') );		
		wp_register_script( 'jquery-meanmenu-js', get_template_directory_uri() . '/js/jquery.meanmenu.js', array('jquery') );
                                   wp_register_script( 'bloggers-lite-script', get_template_directory_uri() . '/js/bloggers-lite-script.js' );

		wp_enqueue_script( 'bootstrap' );
                                   wp_enqueue_script( 'jquery-slick-js' );
		wp_enqueue_script( 'jquery-meanmenu-js' );		
		wp_enqueue_script( 'bloggers-lite-script' );
		$bloggers_lite_layoutmenu = get_theme_mod( 'header_mega_menu','stricky-menu-left' );
		$stickey_layoutmenu       = 'no';
		if ( 'stricky-menu-left' == $bloggers_lite_layoutmenu || 'stricky-menu-right' == $bloggers_lite_layoutmenu ) {
			$stickey_layoutmenu = 'yes';
		}
		$enable_loader = 'no';
		if ( 1 == get_theme_mod( 'enable_loader', true ) ) {
			$enable_loader = 'yes';
		}
		$attached_vars = array(
			'stickey_layoutmenu' => $stickey_layoutmenu,
			'enable_loader'      => $enable_loader,
		);
		wp_localize_script( 'bloggers-lite-script', 'attached_vars', $attached_vars );

		// style.
		wp_register_style( 'bootstrap-css', get_template_directory_uri() . '/bootstrap/css/bootstrap.css' );
		wp_register_style( 'fontawesome-css', get_template_directory_uri() . '/css/fontawesome.css' );
		wp_register_style( 'slick-css', get_template_directory_uri() . '/css/slick.css' );
		wp_register_style( 'meanmenu-css', get_template_directory_uri() . '/css/meanmenu.css' );
		wp_enqueue_style( 'bootstrap-css' );
		wp_enqueue_style( 'fontawesome-css' );
		wp_enqueue_style( 'slick-css' );
		wp_enqueue_style( 'meanmenu-css' );
		if ( class_exists( 'WooCommerce' ) ) {
			wp_register_style( 'woocommerce_general', get_template_directory_uri() . '/css/woocommerce.css' );
			wp_enqueue_style( 'woocommerce_general' );
		}

		$bloggers_lite_loader                = get_theme_mod( 'loader_image' );
		$bloggers_lite_loader_image          = ! empty( $bloggers_lite_loader ) ? esc_url($bloggers_lite_loader) : get_template_directory_uri() . '/images/loader.gif';
		$bloggers_lite_link_color            = esc_attr( get_theme_mod( 'theme_color' ) );
		$bloggers_lite_header_textcolor      = '#' . esc_attr( get_theme_mod( 'header_textcolor' ) );
		$bloggers_lite_background_color      = '#' . esc_attr( get_theme_mod( 'background_color' ) );
		$bloggers_lite_background_image      = esc_url( get_theme_mod( 'background_image' ) );
		$bloggers_lite_background_size       = esc_attr( get_theme_mod( 'background_size', 'auto' ) );
		$bloggers_lite_background_repeat     = esc_attr( get_theme_mod( 'background_repeat', 'repeat' ) );
		$bloggers_lite_background_attachment = esc_attr( get_theme_mod( 'background_attachment', 'scroll' ) );
		$bloggers_lite_background_position_x = esc_attr( get_theme_mod( 'background_position_x', 'left' ) );
		$bloggers_lite_background_position_y = esc_attr( get_theme_mod( 'background_position_y', 'top' ) );
		$bloggers_lite_custom_css            = "
		.rotating {
			background-image: url('{$bloggers_lite_loader_image}');
		}
		";

		if ( '' != $bloggers_lite_background_color && '#F2F2F2' != $bloggers_lite_background_color && $bloggers_lite_background_image = '' ) {
			$bloggers_lite_custom_css .= "
			html body,
			.blog-details,
			.footer_area .footer-top {
				background: {$bloggers_lite_background_color};
			}
			";
		}
		if($bloggers_lite_background_image != '') {
			$bloggers_lite_custom_css .= "
			.blog-details, .copyrights {
					background-image: url('{$bloggers_lite_background_image}');
					background-size: {$bloggers_lite_background_size};
					background-attachment: {$bloggers_lite_background_attachment};
					background-position: {$bloggers_lite_background_position_x} {$bloggers_lite_background_position_y};
					background-repeat: {$bloggers_lite_background_repeat};
				}
				";
		}
		
		if ( '' != $bloggers_lite_header_textcolor ) {
			$bloggers_lite_custom_css .= "
				.menui,
				.widget_calendar tbody a:hover,
				.widget_calendar tbody a:focus,
				.comment-form .submit:hover,
				input[type='submit']:hover {
					background: {$bloggers_lite_header_textcolor};
				}

				.tagline.site-description,
                                                                      .site-title a,
				.mobilenav li a,
				.stricky .mobilenav li a,
				.stricky .tagline.site-description,
				.stricky.normal .mobilenav li a,
				.stricky.normal .tagline.site-description,
				.post-header .custom-header a,
				.error404.not-found > h2,
				.copyrights-content p,
				.copyrights-content a,
				.widget-title,
				.widget.widget_rss .widget-title .rsswidget,
				.sidebar-title,
				.comments-title,
				.comment-author .fn a:hover,
				.comment-content p a:hover,
				.comment-reply-title,
				.breadcrumbs_inner,
				.breadcrumbs_inner a,
				.comment-form p a,
				.comment-metadata a,
				.post-header .custom-header,
				.footer_widget_links:hover,
				.widget_calendar tfoot a:hover,
				.widget_recent_entries .post-date,
				.widget.widget_recent_entries ul li a:hover,
				.widget ul li a:hover,
				.widget a:hover,
				.textwidget a:hover,
				.post-header .category-list a:hover,
				.woocommerce-pagination ul.page-numbers > li > .page-numbers,
				.more-detail:hover,
				.search_page article.blog-section h2.custom-header a,
				.post.no-results.not-found .custom-header,
				.entry-content a:hover,
				.product-caption .product-name > span,
				.entry-content a:hover,
				.post-entry a:hover,
				.post-meta a:hover,
				.author_name a:hover{
					color: {$bloggers_lite_header_textcolor};
				}
				.woocommerce .product-add_to_cart_wrap a.button:hover,
				.widget ul li:hover:before,
				.widget.woocommerce.widget_price_filter .price_slider_wrapper .ui-widget-content,
				.woocommerce.widget_shopping_cart .widget_shopping_cart_content .button:hover {
					background: {$bloggers_lite_header_textcolor} !important;
				}
				.stricky .main-navigation ul.nav-menu > li.current-menu-ancestor > a,
				.stricky .main-navigation ul.nav-menu > li:hover > a
				 {
					border-bottom-color: {$bloggers_lite_header_textcolor};
				}
				table.give-table tbody tr td,
				.give_error > p, .give_success > p{
					color: {$bloggers_lite_header_textcolor};
				}
				#give-recurring-form .form-row input.required[type='text'], #give-recurring-form .form-row input.required[type='tel'], #give-recurring-form .form-row input.required[type='email'], #give-recurring-form .form-row input.required[type='password'], #give-recurring-form .form-row input.required[type='url'], #give-recurring-form .form-row select.required, #give-recurring-form .form-row textarea.required, #give-recurring-form .give-tooltip:hover, form.give-form .form-row input.required[type='text'], form.give-form .form-row input.required[type='tel'], form.give-form .form-row input.required[type='email'], form.give-form .form-row input.required[type='password'], form.give-form .form-row input.required[type='url'], form.give-form .form-row select.required, form.give-form .form-row textarea.required, form.give-form .give-tooltip:hover, form[id*='give-form'] .form-row input.required[type='text'], form[id*='give-form'] .form-row input.required[type='tel'], form[id*='give-form'] .form-row input.required[type='email'], form[id*='give-form'] .form-row input.required[type='password'], form[id*='give-form'] .form-row input.required[type='url'], form[id*='give-form'] .form-row select.required, form[id*='give-form'] .form-row textarea.required, form[id*='give-form'] .give-tooltip:hover,
				#give-recurring-form .form-row input[type='text'], #give-recurring-form .form-row input[type='tel'], #give-recurring-form .form-row input[type='email'], #give-recurring-form .form-row input[type='password'], #give-recurring-form .form-row input[type='url'], #give-recurring-form .form-row select, #give-recurring-form .form-row textarea, form.give-form .form-row input[type='text'], form.give-form .form-row input[type='tel'], form.give-form .form-row input[type='email'], form.give-form .form-row input[type='password'], form.give-form .form-row input[type='url'], form.give-form .form-row select, form.give-form .form-row textarea, form[id*='give-form'] .form-row input[type='text'], form[id*='give-form'] .form-row input[type='tel'], form[id*='give-form'] .form-row input[type='email'], form[id*='give-form'] .form-row input[type='password'], form[id*='give-form'] .form-row input[type='url'], form[id*='give-form'] .form-row select, form[id*='give-form'] .form-row textarea,
				.fl-form[id*='give-form'] .fl-is-active input.fl-input, .fl-form[id*='give-form'] .fl-is-active select.fl-select, .fl-form[id*='give-form'] .fl-is-active textarea.fl-textarea,
				form[id*='give-form'] select.give-select-level{
					color: {$bloggers_lite_header_textcolor};
				}
				#content #give-recurring-form .form-row input.required,#content #give-recurring-form .form-row input, select.required, #content .give-form .form-row textarea, #content .give-form .give-tooltip:hover,
				#content #give-recurring-form .form-row select.required,#content #give-recurring-form .form-row input,#content #give-recurring-form .form-row select,#content #give-recurring-form .form-row textarea,
				#content .give-form select.give-select-level{
					color: {$bloggers_lite_header_textcolor};
				}
				.fl-form[id*='give-form'] .fl-has-focus label.fl-label {
					color: {$bloggers_lite_header_textcolor};
				}
				.nf-form-title h3,.nf-form-title h2,.nf-form-title h1 {
					color: {$bloggers_lite_header_textcolor};
				}
				.ninja-forms-form-wrap .nf-field-label label{
					color: {$bloggers_lite_header_textcolor};
				}
				";
		}
		if ( '' != $bloggers_lite_link_color && '#ff6c3a' != $bloggers_lite_link_color ) {
			$bloggers_lite_custom_css .= "
				.woocommerce .woocommerce-error,
				.woocommerce .woocommerce-info,
				.woocommerce .woocommerce-message,
				.woocommerce span.onsale::before {
					border-color : {$bloggers_lite_link_color};
				}

				#review_form_wrapper #commentform p.stars a,
				a:hover,
				.site-title a,
				.woocommerce a:hover,
				.woocommerce a:focus,
				.woocommerce .star-rating span,
				.woocommerce .woocommerce-info::before,
				ins .woocommerce-Price-amount.amount,
				.woocommerce .woocommerce-message::before,
				.woocommerce .product-name:hover span,
				.single-product.woocommerce .product .product_meta a,
				.products .added_to_cart.wc-forward {
					color: {$bloggers_lite_link_color};
				}

				.product-caption .product-rating a.button.add_to_cart_button,
				.single_add_to_cart_button.button.alt,
				.related.products > h2::before,
				.woocommerce #respond input#submit,
				.woocommerce .upsells > h2::before,
				.woocommerce > h2::before,
				.woocommerce header > h2::before,
				#customer_details h3::before,
				.woocommerce .cart-collaterals .cart_totals h2::before,
				.woocommerce a.button, .woocommerce button.button,
				.woocommerce input.button,
				.woocommerce .product-add_to_cart_wrap a,
				.woocommerce div.product .woocommerce-tabs ul.tabs li:hover,
				.woocommerce div.product .woocommerce-tabs ul.tabs li.active,
				.woocommerce span.onsale,
				.woocommerce-MyAccount-navigation-link:hover,
				.woocommerce-MyAccount-navigation-link.is-active,
				.woocommerce-pagination ul.page-numbers > li > .page-numbers:hover,
				.woocommerce-pagination ul.page-numbers > li > .page-numbers.current,
				.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
				.widget.woocommerce.widget_price_filter .ui-slider-range.ui-widget-header,
				.woocommerce-page .widget.woocommerce.widget_product_search .woocommerce-product-search input[type='submit'],
				.woocommerce.widget.widget_product_tag_cloud .tagcloud a:hover,
				.woocommerce-MyAccount-navigation-link:hover,
				.woocommerce-MyAccount-navigation-link.is-active {
					background: {$bloggers_lite_link_color};
				}

				.post-image.link span.post_format_standard.post_has_image,
				.post-image.quote span.post_format_standard.post_has_image {
					background: bloggers_lite_hex2rgba( {$bloggers_lite_link_color}, 0.57 );
				}

				a:hover,
				a:focus,
				.site_title_text,
				.menu-item.menu-item-has-children > a:hover,
				.main-navigation li.current-menu-ancestor > a,
				.main-navigation li.current-menu-item > a,
				.stricky .main-navigation ul li:hover > a,
				.menu-item a:hover,
				.prev_button .pagi_text,
				.next_button .pagi_text,
				.textwidget a,
				.widget a,
				.widget ul li a,
				.footer .blog-date a:hover,
				#secondary .blog-date a:hover,
				.post-header span a,
				.post-header .custom-header a:hover,
				.more-detail,
				.post-meta a,
				.post-entry a,
				.blog-head:hover,
				.reply a:hover,
				.comment-metadata a:hover,
				.comment-form p a:hover,
				.author_name a,
				.comment-author .fn,
				.all-comment:hover i,
				.all-comment:hover a,
				.entry-header .entry-title,
				.footer_widget_links,
				.copyrights-content a:hover,
				.widget_calendar tfoot a,
				.widget.widget_rss ul li .rsswidget,
				.author-description a,
				.comment-content a,
				.comment-author .fn a,
				.comment-content p a,
				.widget.widget_recent_entries ul li a,
				.search_page article.blog-section h2.custom-header a:hover,
				.entry-content a, .post-tags a:hover, 
				.post-entry a {
					color: {$bloggers_lite_link_color};
				}
				#searchform #searchsubmit{
					color: {$bloggers_lite_link_color} !important;
				}
				.pagination span.current,
				.featured-post {
					background: {$bloggers_lite_link_color} !important;
				}
				.widget ul li:before {
					background: {$bloggers_lite_link_color};
				}

				blockquote,
				input[type='submit'],
				.pagination > a:hover,
				.pagination  span:hover,
				.pagination > a:focus,
				.pagination  span:focus,
				.pagination > span.current,
				.widget-title:before,
				.widget ul li a:hover:before,
				.widget_calendar tbody a,
				.tagcloud a:hover,
				.blog_wrapper article.format-aside .post-entry,
				.post-image.link span.post_format_standard > span,
				.sidebar-title::before,
				.comments-title:before,
				.comment-reply-title::before,
				.reply a,
				.comment-form .submit,
				.arrow-up,
				.pagination a:hover {
					background: {$bloggers_lite_link_color};
				}

				table.give-table th{
					color: {$bloggers_lite_link_color};
				}
				.give-goal-progress .income,legend{
					color: {$bloggers_lite_link_color};
				}
				.give-form-title{
					color: {$bloggers_lite_link_color};
				}
				.give-btn{
					background-color: {$bloggers_lite_link_color};
					border-color: {$bloggers_lite_link_color};
					color: #fff;
				}
				.give-btn:hover,
				.give-btn:focus,
				.give-btn:active{
					background-color: {$bloggers_lite_header_textcolor};
					border-color: {$bloggers_lite_header_textcolor};
					color:#fff;
				}
				.give-goal-progress .income,legend{
					color: {$bloggers_lite_link_color};
				}

				form[id*='give-form'] .give-donation-amount .give-currency-symbol,
				form[id*='give-form'] #give-final-total-wrap .give-donation-total-label{
					color: {$bloggers_lite_link_color};
				}
				.ninja-forms-form-wrap input[type='button'],
				.ninja-forms-form-wrap input[type='submit'],
				.ninja-forms-form-wrap button{
					background-color: {$bloggers_lite_link_color};
					border-color: {$bloggers_lite_link_color};
					color: #fff;
				}
				.ninja-forms-form-wrap input[type='button']:hover,.ninja-forms-form-wrap input[type='button']:active,.ninja-forms-form-wrap input[type='button']:focus,
				.ninja-forms-form-wrap input[type='submit'],
				.ninja-forms-form-wrap button{
					background-color: {$bloggers_lite_header_textcolor};
					border-color: {$bloggers_lite_header_textcolor};
					color:#fff;
				}
				";
		}
		wp_add_inline_style( 'meanmenu-css', $bloggers_lite_custom_css );
	}
}

if ( ! function_exists( 'bloggers_lite_add_body_class' ) ) {

	/**
	 *
	 * Use filter to Add "sticky-header" class to body for sticky menu.
	 *
	 * @since Bloggers Lite 1.0
	 * @param array $classes array of body class.
	 */
	function bloggers_lite_add_body_class( $classes ) {
		$classes[] = 'sticky-header';
		return $classes;
	}
}
add_filter( 'body_class', 'bloggers_lite_add_body_class' );

if ( ! function_exists( 'bloggers_lite_my_search_form' ) ) {

	/**
	 *
	 * Add filter to modify search form.
	 *
	 * @since Bloggers Lite 1.0
	 * @param string $form to get all the form content with HTML.
	 * @return string $form with modified HTML.
	 */
	function bloggers_lite_my_search_form( $form ) {
		$form = '<form role="search" method="get" id="searchform" class="searchform" action="' . esc_url( home_url( '/' ) ) . '" >
    <div><label class="screen-reader-text" for="s">' . esc_html__( 'Search for:', 'bloggers-lite' ) . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr__( 'Search', 'bloggers-lite' ) . '" />
    <button id="searchsubmit" class="search-icon" type="submit">
    <i class="fa fa-search"></i>
    </button>
    </div>
    </form>';
		return $form;
	}
}
add_filter( 'get_search_form', 'bloggers_lite_my_search_form' );

get_template_part( 'inc/register', 'plugins' );


if ( ! function_exists( 'bloggers_lite_sanitize_checkbox' ) ) {

	/**
	 *
	 * Sanitize a checkbox setting.
	 *
	 * @since Bloggers Lite 1.0
	 *
	 * @param integer $value checkbox value.
	 */
	function bloggers_lite_sanitize_checkbox( $value ) {
		if ( 1 == $value ) {
			return 1;
		} else {
			return '';
		}
	}
}

if ( ! function_exists( 'bloggers_lite_sanitize_number' ) ) {

	/**
	 *
	 * Sanitize a Integer setting.
	 *
	 * @since Bloggers Lite 1.0
	 *
	 * @param integer $value integer field value.
	 */
	function bloggers_lite_sanitize_number( $value ) {
		return absint($value);
	}
}

if ( ! function_exists( 'bloggers_lite_kses_html' ) ) {

	/**
	 *
	 * Allow HTML for textarea
	 *
	 * @since Bloggers Lite 1.0
	 * @param html $value snitize html.
	 */
	function bloggers_lite_kses_html( $value ) {
		return wp_kses( $value, wp_kses_allowed_html( 'entities' ) );
	}
}

if ( ! function_exists( 'bloggers_lite_new_excerpt_more' ) ) {

	/**
	 *
	 * Changes excerpt length
	 *
	 * @since Bloggers Lite 1.0
	 * @param string $more read more text to filter.
	 */
	function bloggers_lite_new_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}
		return ' &hellip;';
	}
}
add_filter( 'excerpt_more', 'bloggers_lite_new_excerpt_more' );

/**
 *
 * Includes Custom php files like custom posts, breadcrumb etc.
 *
 * @since Bloggers Lite 1.0
 */

get_template_part( 'inc/breadcrumb' );

if ( ! function_exists( 'bloggers_lite_get_subcat_ids' ) ) {

	/**
	 *
	 * Get sub category array
	 *
	 * @since Bloggers Lite 1.0
	 * @param integer $parent_cat parent category.
	 */
	function bloggers_lite_get_subcat_ids( $parent_cat ) {
		$bloggers_lite_cat_display_array   = array();
		$bloggers_lite_cat_display_array[] = $parent_cat;
		$bloggers_lite_categories          = get_categories( array( 'child_of' => $parent_cat ) );
		if ( is_array( $bloggers_lite_categories ) && ! empty( $bloggers_lite_categories ) ) {
			foreach ( $bloggers_lite_categories as $bloggers_lite_category ) {
				$bloggers_lite_cat_display_array[] = $bloggers_lite_category->term_id;
			}
		}
		return $bloggers_lite_cat_display_array;
	}
}

add_filter( 'blogges_lite_video_embed_media', 'bloggers_lite_get_video_embed_media', 10, 1 );

if ( ! function_exists( 'bloggers_lite_get_video_embed_media' ) ) {

	/**
	 *
	 * Display video embeded code in page
	 *
	 * @since Bloggers Lite 1.0
	 * @param integer $post_id post id.
	 */
	function bloggers_lite_get_video_embed_media( $post_id ) {
		$bloggers_lite_post_format = get_post_format( $post_id );
		$bloggers_lite_post        = get_post( $post_id );
		$bloggers_lite_content     = do_shortcode( apply_filters( 'the_content', $bloggers_lite_post->post_content ) );
		$embeds                    = get_media_embedded_in_content( $bloggers_lite_content );
		if ( 'gallery' == $bloggers_lite_post_format ) {
			$gallery_images = get_post_gallery_images( $post_id );
			if ( $gallery_images ) {
				ob_start();
				?>
				<div class="slick_slider">
					<ul class="slides">
						<?php
						foreach ( $gallery_images as $single_gallery_image ) {
							?>
							<li>
								<img src="<?php echo esc_url( $single_gallery_image ); ?>" alt="<?php esc_attr_e( 'gallery image', 'bloggers-lite' ); ?>" />
							</li>
							<?php
						}
						?>
					</ul>
				</div>
				<?php
				$gallery_img = ob_get_clean();
				return $gallery_img;
			} else {
				return false;
			}
		} elseif ( ! empty( $embeds ) ) {
			if ( 'video' == $bloggers_lite_post_format ) {
				if ( strpos( $embeds[0], 'video' ) || strpos( $embeds[0], 'youtube' ) || strpos( $embeds[0], 'vimeo' ) ) {
					return $embeds[0];
				}
			} elseif ( 'audio' == $bloggers_lite_post_format ) {
				if ( strpos( $embeds[0], 'audio' ) ) {
					return $embeds[0];
				}
			}
		} elseif ( 'link' == $bloggers_lite_post_format ) {
			if ( preg_match( '~<a .*?href=[\'"]+(.*?)[\'"]+.*?>(.*?)</a>~ims', $bloggers_lite_post->post_content, $result ) ) {
				if ( isset( $result[0] ) ) {
					return $result[0];
				}
			}
			return false;
		} elseif ( 'quote' == $bloggers_lite_post_format ) {
			if ( preg_match( '~<blockquote>([\s\S]+?)</blockquote>~', $bloggers_lite_content, $matches ) ) {
				if ( isset( $matches[0] ) ) {
					return $matches[0];
				}
			}
			return false;
		} else {
			return false;
		}
	}
}

if ( ! function_exists( 'bloggers_lite_hex2rgba' ) ) {

	/**
	 *
	 * Convert hexadecimal to rgba
	 *
	 * @since Bloggers Lite 1.0
	 * @param string $bloggers_lite_color color to convert rgba.
	 * @param string $bloggers_lite_opacity opacity to convert rgba.
	 */
	function bloggers_lite_hex2rgba( $bloggers_lite_color, $bloggers_lite_opacity = false ) {

		$bloggers_lite_default = 'rgb(0,0,0)';

		// Return default if no color provided.
		if ( empty( $bloggers_lite_color ) ) {
			return $bloggers_lite_default;
		}

		// Sanitize $color if "#" is provided.
		if ( '#' == $bloggers_lite_color[0] ) {
			$bloggers_lite_color = substr( $bloggers_lite_color, 1 );
		}

		// Check if color has 6 or 3 characters and get values.
		if ( strlen( $bloggers_lite_color ) == 6 ) {
			$bloggers_lite_hex = array( $bloggers_lite_color[0] . $bloggers_lite_color[1], $bloggers_lite_color[2] . $bloggers_lite_color[3], $bloggers_lite_color[4] . $bloggers_lite_color[5] );
		} elseif ( strlen( $bloggers_lite_color ) == 3 ) {
			$bloggers_lite_hex = array( $bloggers_lite_color[0] . $bloggers_lite_color[0], $bloggers_lite_color[1] . $bloggers_lite_color[1], $bloggers_lite_color[2] . $bloggers_lite_color[2] );
		} else {
			return $bloggers_lite_default;
		}

		// Convert hexadec to rgb.
		$bloggers_lite_rgb = array_map( 'hexdec', $bloggers_lite_hex );

		// Check if opacity is set(rgba or rgb).
		if ( $bloggers_lite_opacity ) {
			if ( abs( $bloggers_lite_opacity ) > 1 ) {
				$bloggers_lite_opacity = 1.0;
			}
			$bloggers_lite_rgba = 'rgba(' . implode( ',', $bloggers_lite_rgb ) . ',' . $bloggers_lite_opacity . ')';
		} else {
			$bloggers_lite_rgba = 'rgb(' . implode( ',', $bloggers_lite_rgb ) . ')';
		}

		// Return rgb(a) color string.
		return $bloggers_lite_rgba;
	}
}

if ( ! function_exists( 'bloggers_lite_customize_preview_js' ) ) {

	/**
	 *
	 * Enqueue Javascript postMessage handlers for the Customizer.
	 *
	 * @since Bloggers Lite 1.0
	 *
	 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
	 */
	function bloggers_lite_customize_preview_js() {
		wp_enqueue_script( 'bloggers-lite-customizer', get_template_directory_uri() . '/js/bloggers-lite-theme-customizer.js', array( 'customize-preview' ), '20130301', true );
	}
}
add_action( 'customize_preview_init', 'bloggers_lite_customize_preview_js' );

if ( ! function_exists( 'bloggers_lite_enable_loader' ) ) {
	/**
	 *
	 * Check if loader is enabled
	 *
	 * @since Bloggers Lite 1.0
	 */
	function bloggers_lite_enable_loader() {
		$enable_loader = get_theme_mod( 'enable_loader', true );
		if ( $enable_loader ) {
			return true;
		} else {
			return false;
		}
	}
}

add_action( 'customize_register', 'bloggers_lite_add_theme_color_option' );
if ( ! function_exists( 'bloggers_lite_add_theme_color_option' ) ) {
	/**
	 *
	 * Add action "customize_register" to add theme color option at admin side.
	 *
	 * @since Bloggers Lite 1.0
	 * @param object $wp_customize global object for customize.
	 */
	function bloggers_lite_add_theme_color_option( $wp_customize ) {

		// add color picker setting.
		$wp_customize->add_setting(
			'theme_color', array(
				'default'           => '#ff6c3a',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		// add color picker control to colors setting.
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize, 'theme_color', array(
					'label'    => esc_html__( 'Theme Color', 'bloggers-lite' ),
					'section'  => 'colors',
					'settings' => 'theme_color',
				)
			)
		);

		// Theme Option Panel.
		$wp_customize->add_panel(
			'panel_id', array(
				'priority'       => 1,
				'capability'     => 'edit_theme_options',
				'theme_supports' => '',
				'title'          => esc_html__( 'Theme Options', 'bloggers-lite' ),
				'description'    => esc_html__( 'Use the options below to customize your theme!', 'bloggers-lite' ),
			)
		);

		// Theme Option General Settings.
		$wp_customize->add_section(
			'general_setting_section', array(
				'capability'     => 'edit_theme_options',
				'theme_supports' => '',
				'title'          => esc_html__( 'General Settings', 'bloggers-lite' ),
				'description'    => esc_html__( 'Manage general settings', 'bloggers-lite' ),
				'panel'          => 'panel_id',
			)
		);

		// Pre-Loader Settings.
		$wp_customize->add_setting(
			'enable_loader', array(
				'default'           => 0,
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'bloggers_lite_sanitize_checkbox',
			)
		);

		// enable Pre-Loader.
		$wp_customize->add_control(
			'enable_loader', array(
				'settings' => 'enable_loader',
				'label'    => esc_html__( 'Show Pre Loader', 'bloggers-lite' ),
				'section'  => 'general_setting_section',
				'type'     => 'checkbox',
				'priority' => 2,
			)
		);

		// Pre-Loader only on home.
		$wp_customize->add_setting(
			'only_home', array(
				'default'           => 1,
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'bloggers_lite_sanitize_checkbox',
			)
		);

		// Pre-Loader only on home.
		$wp_customize->add_control(
			'only_home', array(
				'settings'        => 'only_home',
				'label'           => esc_html__( 'Show Pre Loader Only Home Page', 'bloggers-lite' ),
				'section'         => 'general_setting_section',
				'type'            => 'checkbox',
				'priority'        => 3,
				'active_callback' => 'bloggers_lite_enable_loader',
			)
		);

		// Pre-Loader image.
		$wp_customize->add_setting(
			'loader_image', array(
				'sanitize_callback' => 'esc_url_raw',
				'default'           => get_template_directory_uri() . '/images/loader.gif',
			)
		);

		// Pre-Loader image.
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize, 'loader_image', array(
					'label'           => esc_html__( 'Pre Loader Image', 'bloggers-lite' ),
					'section'         => 'general_setting_section',
					'settings'        => 'loader_image',
					'active_callback' => 'bloggers_lite_enable_loader',
				)
			)
		);
		$bloggers_lite_layout_array = array();
		$latest_blog_page_layout_id = 'right-sidebar';
		// get all blog template layout array to display dropdown option.
		$bloggers_lite_layout_array['left-sidebar']  = esc_html__( 'Left Sidebar', 'bloggers-lite' );
		$bloggers_lite_layout_array['right-sidebar'] = esc_html__( 'Right Sidebar', 'bloggers-lite' );
		$bloggers_lite_layout_array['full-width']    = esc_html__( 'Full Width - No Sidebar', 'bloggers-lite' );

		// Blog Page Layout.
		$wp_customize->add_setting(
			'blog_page_layout', array(
				'default'           => $latest_blog_page_layout_id,
				'sanitize_callback' => 'bloggers_sanitize_select',
			)
		);
		$wp_customize->add_control(
			'blog_page_layout', array(
				'label'       => esc_html__( 'Page Layout', 'bloggers-lite' ),
				'section'     => 'general_setting_section',
				'settings'    => 'blog_page_layout',
				'type'        => 'select',
				'choices'     => $bloggers_lite_layout_array,
				'description' => esc_html__( 'Select page layout.', 'bloggers-lite' ),
			)
		);

		// Home Settings.
		$wp_customize->add_section(
			'home_setting_section', array(
				'capability'     => 'edit_theme_options',
				'theme_supports' => '',
				'title'          => esc_html__( 'Header Settings', 'bloggers-lite' ),
				'description'    => esc_html__( 'Manage header settings', 'bloggers-lite' ),
				'panel'          => 'panel_id',
			)
		);

		$wp_customize->add_setting(
			'enable_breadcrumbs', array(
				'default'           => 1,
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'bloggers_lite_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'enable_breadcrumbs', array(
				'settings' => 'enable_breadcrumbs',
				'label'    => esc_html__( 'Show Breadcrumbs', 'bloggers-lite' ),
				'section'  => 'home_setting_section',
				'type'     => 'checkbox',
				'priority' => 2,
			)
		);

		// Home Page Slider Select control.
		// Get all Avartan slider to create option for sliders.
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        if (is_plugin_active('avartan-slider-lite/avartanslider.php') || is_plugin_active('avartanslider/avartanslider.php')) {
            global $wpdb;
            $avartanTable = $wpdb->prefix . 'avartan_sliders';
            if ($wpdb->get_var("SHOW TABLES LIKE '$avartanTable'") == $avartanTable) {
                $avartanSliders = $wpdb->get_results("SELECT * FROM $avartanTable");
                $sliderArray = array();
                $latest_slider_id = 0;
                if (!empty($avartanSliders)) {
                    $sliderArray[0] = __('Select Slider', 'bloggers-lite');
                    // get all slider array to display dropdown option
                    foreach ($avartanSliders as $key => $avartanSlider) {
                        $sliderArray[$avartanSlider->id] = $avartanSlider->name;
                    }
                    if ($sliderArray) {
                        $wp_customize->add_setting('homepage_avartan_slider', array(
                            'default' => $latest_slider_id,
                            'sanitize_callback' => 'esc_attr'
                        ));
                        $wp_customize->add_control('slider_control_setting', array(
                            'label' => __('Home Page Slider', 'bloggers-lite'),
                            'section' => 'general_setting_section',
                            'settings' => 'homepage_avartan_slider',
                            'type' => 'select',
                            'choices' => $sliderArray,
                            'description' => __('Select Home Page Slider', 'bloggers-lite')
                        ));
                    }
                }
            }
        }
 
        $menuArray = array();
        $latest_menu_id           = 'stricky-menu-left';
        // get all slider array to display dropdown option.
		
        $menuArray['left-menu'] = __("Left Menu", "bloggers-lite");
        $menuArray['center-menu'] = __("Center Menu", "bloggers-lite");
        $menuArray['right-menu'] = __("Right Menu", "bloggers-lite");
        $menuArray['stricky-menu-left'] = __("Sticky Left Menu", "bloggers-lite");
        $menuArray['stricky-menu-right'] = __("Sticky Right Menu", "bloggers-lite");

		/* Header Menu */
        $wp_customize->add_setting('header_mega_menu', array(
            'default' => $latest_menu_id,
            'sanitize_callback' => 'esc_attr'
        ));
        $wp_customize->add_control('home_setting_section', array(
            'label' => __('Header Menu', 'bloggers-lite'),
            'section' => 'home_setting_section',
            'settings' => 'header_mega_menu',
            'type' => 'select',
            'choices' => $menuArray,
            'description' => __('Select header menu type', "bloggers-lite"),
        ));
		 
		$wp_customize->add_setting(
			'header_logo', array(
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize, 'header_logo', array(
					'label'    => esc_html__( 'Header Logo', 'bloggers-lite' ),
					'section'  => 'title_tagline',
					'settings' => 'header_logo',
				)
			)
		);

		/* blog Page */
		$wp_customize->add_section(
			'blog_setting_section', array(
				'capability'     => 'edit_theme_options',
				'theme_supports' => '',
				'title'          => esc_html__( 'Blog Page Settings', 'bloggers-lite' ),
				'description'    => esc_html__( 'Manage Blog page settings', 'bloggers-lite' ),
				'panel'          => 'panel_id',
			)
		);

		/* Blog Page design selection */
		$blog_page_design      = array( 'default_design' => esc_html__( 'Default Theme Design', 'bloggers-lite' ) );
		$blog_page_design_desc = esc_html__( 'Select blog page Design.', 'bloggers-lite' ) . '<br/><b style="color:green;">' . esc_html__( 'Note: ', 'bloggers-lite' ) . '</b>' . esc_html__( 'If you want more blog layouts with theme then', 'bloggers-lite' ) . '<a target="_blank" href="' . site_url() . '/wp-admin/plugin-install.php?s=blog+designer&tab=search&type=term">' . esc_html__( ' Install & Active', 'bloggers-lite' ) . '</a>' . esc_html__( ' Blog Design Plugin.', 'bloggers-lite' );
		load_template( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( is_plugin_active( 'blog-designer/blog-designer.php' ) ) {
			$blog_page_design      = array(
				'default_design'     => esc_html__( 'Default Theme Design', 'bloggers-lite' ),
				'blog_designer_lite' => esc_html__( 'Blog Designer Plugin, Blog Design', 'bloggers-lite' ),
			);
			$blog_page_design_desc = esc_html__( 'Select blog page Design.', 'bloggers-lite' );
		}
		$wp_customize->add_setting(
			'blog_page_design', array(
				'default'           => 'default_design',
				'sanitize_callback' => 'bloggers_sanitize_select',
			)
		);
		$wp_customize->add_control(
			'blog_page_design', array(
				'label'       => esc_html__( 'Blog Page Design', 'bloggers-lite' ),
				'section'     => 'blog_setting_section',
				'settings'    => 'blog_page_design',
				'type'        => 'select',
				'choices'     => $blog_page_design,
				'description' => $blog_page_design_desc,
			)
		);

		$bloggers_lite_content_array = array();
		$blog_page_content           = 'from_content';
		// get all blog template layout array to display dropdown option.
		$bloggers_lite_content_array['from_content'] = esc_html__( 'Post Content', 'bloggers-lite' );
		$bloggers_lite_content_array['from_excerpt'] = esc_html__( 'Post Excerpt', 'bloggers-lite' );

		$wp_customize->add_setting(
			'blog_page_content_from', array(
				'default'           => $blog_page_content,
				'sanitize_callback' => 'bloggers_sanitize_select',
			)
		);
		$wp_customize->add_control(
			'blog_page_content_from', array(
				'label'       => esc_html__( 'Blog Page Content From', 'bloggers-lite' ),
				'section'     => 'blog_setting_section',
				'settings'    => 'blog_page_content_from',
				'type'        => 'select',
				'choices'     => $bloggers_lite_content_array,
				'description' => esc_html__( 'Select blog page content display from.', 'bloggers-lite' ),
			)
		);

		// Blog Content.
		$wp_customize->add_setting(
			'blog_content_length', array(
				'default'           => '50',
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'bloggers_lite_sanitize_number',
			)
		);
		$wp_customize->add_control(
			'blog_content_length', array(
				'label'       => esc_html__( 'Blog Content Length', 'bloggers-lite' ),
				'section'     => 'blog_setting_section',
				'settings'    => 'blog_content_length',
				'type'        => 'text',
				'description' => esc_html__( 'Enter Blog Content Length (length in words)', 'bloggers-lite' ),
			)
		);

		// Blog Content Read More Text.
		$wp_customize->add_setting(
			'blog_content_read_more_text', array(
				'default'           => esc_html__( 'Continue Reading', 'bloggers-lite' ),
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'blog_content_read_more_text', array(
				'label'       => esc_html__( 'Blog Content Read More Text', 'bloggers-lite' ),
				'section'     => 'blog_setting_section',
				'settings'    => 'blog_content_read_more_text',
				'type'        => 'text',
				'description' => esc_html__( 'Enter Blog Content Read More Text', 'bloggers-lite' ),
			)
		);

		$wp_customize->add_setting(
			'enable_categories_blog', array(
				'default'           => 1,
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'bloggers_lite_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'enable_categories_blog', array(
				'settings' => 'enable_categories_blog',
				'label'    => esc_html__( 'Show Categories', 'bloggers-lite' ),
				'section'  => 'blog_setting_section',
				'type'     => 'checkbox',
			)
		);
		$wp_customize->add_setting(
			'enable_date_blog', array(
				'default'           => 1,
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'bloggers_lite_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'enable_date_blog', array(
				'settings' => 'enable_date_blog',
				'label'    => esc_html__( 'Show Date', 'bloggers-lite' ),
				'section'  => 'blog_setting_section',
				'type'     => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'enable_tags_blog', array(
				'default'           => 1,
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'bloggers_lite_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'enable_tags_blog', array(
				'settings' => 'enable_tags_blog',
				'label'    => esc_html__( 'Show Tags', 'bloggers-lite' ),
				'section'  => 'blog_setting_section',
				'type'     => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'enable_comments_blog', array(
				'default'           => 1,
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'bloggers_lite_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'enable_comments_blog', array(
				'settings' => 'enable_comments_blog',
				'label'    => esc_html__( 'Show Comment Count', 'bloggers-lite' ),
				'section'  => 'blog_setting_section',
				'type'     => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'enable_author_blog', array(
				'default'           => 1,
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'bloggers_lite_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'enable_author_blog', array(
				'settings' => 'enable_author_blog',
				'label'    => esc_html__( 'Show Author', 'bloggers-lite' ),
				'section'  => 'blog_setting_section',
				'type'     => 'checkbox',
			)
		);

		// single page blog.
		$wp_customize->add_section(
			'single_blog_setting_section', array(
				'capability'     => 'edit_theme_options',
				'theme_supports' => '',
				'title'          => esc_html__( 'Single Blog Page Settings', 'bloggers-lite' ),
				'description'    => esc_html__( 'Manage Single Blog page settings', 'bloggers-lite' ),
				'panel'          => 'panel_id',
			)
		);
		$wp_customize->add_setting(
			'enable_categories', array(
				'default'           => 1,
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'bloggers_lite_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'enable_categories', array(
				'settings' => 'enable_categories',
				'label'    => esc_html__( 'Show Categories', 'bloggers-lite' ),
				'section'  => 'single_blog_setting_section',
				'type'     => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'enable_tags', array(
				'default'           => 1,
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'bloggers_lite_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'enable_tags', array(
				'settings' => 'enable_tags',
				'label'    => esc_html__( 'Show Tags', 'bloggers-lite' ),
				'section'  => 'single_blog_setting_section',
				'type'     => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'enable_comments', array(
				'default'           => 1,
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'bloggers_lite_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'enable_comments', array(
				'settings' => 'enable_comments',
				'label'    => esc_html__( 'Show Comment Count', 'bloggers-lite' ),
				'section'  => 'single_blog_setting_section',
				'type'     => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'enable_date', array(
				'default'           => 1,
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'bloggers_lite_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'enable_date', array(
				'settings' => 'enable_date',
				'label'    => esc_html__( 'Show Date', 'bloggers-lite' ),
				'section'  => 'single_blog_setting_section',
				'type'     => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'enable_author', array(
				'default'           => 1,
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'bloggers_lite_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'enable_author', array(
				'settings' => 'enable_author',
				'label'    => esc_html__( 'Show Author', 'bloggers-lite' ),
				'section'  => 'single_blog_setting_section',
				'type'     => 'checkbox',
			)
		);

		// Footer Settings.
		$wp_customize->add_section(
			'footer_setting_section', array(
				'capability'     => 'edit_theme_options',
				'theme_supports' => '',
				'title'          => esc_html__( 'Footer Settings', 'bloggers-lite' ),
				'description'    => esc_html__( 'Manage your website\'s footer areas.', 'bloggers-lite' ),
				'panel'          => 'panel_id',
			)
		);

		$wp_customize->add_setting(
			'footer_logo', array(
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize, 'footer_logo', array(
					'label'    => esc_html__( 'Footer Logo (logo site: 148 × 52 px)', 'bloggers-lite' ),
					'section'  => 'footer_setting_section',
					'settings' => 'footer_logo',
				)
			)
		);

		$wp_customize->add_setting(
			'footer_background_image', array(
				'sanitize_callback' => 'esc_url_raw',
				'default'           => get_template_directory_uri() . '/images/footer-bg.jpg',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize, 'footer_background_image', array(
					'label'    => esc_html__( 'Footer Background Image', 'bloggers-lite' ),
					'section'  => 'footer_setting_section',
					'settings' => 'footer_background_image',
				)
			)
		);

		$wp_customize->add_setting(
			'enable_scroll_to_top', array(
				'default'           => 1,
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'bloggers_lite_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			'footer_setting_section', array(
				'label'    => esc_html__( 'Show Scroll To Top?', 'bloggers-lite' ),
				'section'  => 'footer_setting_section',
				'settings' => 'enable_scroll_to_top',
				'type'     => 'checkbox',
			)
		);
	}
}


if ( ! function_exists( 'bloggers_sanitize_select' ) ) :

	/**
	 * Sanitize select.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed                $input The value to sanitize.
	 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
	 * @return mixed Sanitized value.
	 */
	function bloggers_sanitize_select( $input, $setting ) {

		$input = sanitize_text_field( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

endif;


if ( ! function_exists( 'bloggers_lite_blog_read_more' ) ) {

	/**
	 *
	 * For get read more content
	 *
	 * @since Bloggers Lite 1.0
	 */
	function bloggers_lite_blog_read_more() {
		$excerpt_length           = 100;
		$bloggers_lite_ex_length = absint(get_theme_mod( 'blog_content_length', '50' ));
		if ( ( ! empty( $bloggers_lite_ex_length ) ) && ( is_int( $bloggers_lite_ex_length ) ) ) {
			$excerpt_length = $bloggers_lite_ex_length;
		}
		$excerpt = get_the_content();
		$text    = strip_shortcodes( $excerpt );
		$text    = apply_filters( 'the_content', $text );
		if ( 'chat' == get_post_format() ) {
			$text = strip_tags( $text, '<p>' );
			if ( strpos( _x( 'words', 'Word count type. Do not translate!', 'bloggers-lite' ), 'characters' ) === 0 && preg_match( '/^utf\-?8$/i', get_option( 'blog_charset' ) ) ) {
				$text = trim( preg_replace( "/[\n\r\t ]+/", ' ', $text ), ' ' );
				preg_match_all( '/./u', $text, $words_array );
				$words_array = array_slice( $words_array[0], 0, $num_words + 1 );
				$sep         = '';
			} else {
				$words_array = preg_split( "/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY );
				$sep         = ' ';
			}
			if ( count( $words_array ) > $excerpt_length ) {
				array_pop( $words_array );
				$text         = implode( $sep, $words_array );
				$excerpt_data = $text;
			} else {
				$excerpt_data = implode( $sep, $words_array );
			}
			if ( '' != $excerpt_data ) {
				echo '<div class = "post_format_chat">';
				printf('%s',$excerpt_data);
				echo '</div>';
			}
		} else {
			$text         = str_replace( ']]>', ']]&gt;', $text );
			$excerpt_data = wp_trim_words( $text, $excerpt_length, '' );
			if ( '' != $excerpt_data ) {
				echo '<div class = "post-entry">';
				printf('%s',$excerpt_data);
				echo '</div>';
			}
		}
	}
}

/**
 *
 * Add WooCommerce support
 *
 * @since Bloggers Lite 1.0
 */
if ( class_exists( 'WooCommerce' ) ) {
	if ( ! function_exists( 'bloggers_lite_dequeue_styles' ) ) {
		/**
		 *
		 * Dequeue woocommerce styles.
		 *
		 * @since Bloggers Lite 1.0
		 * @param array $enqueue_styles woocommerce styles.
		 */
		function bloggers_lite_dequeue_styles( $enqueue_styles ) {
			unset( $enqueue_styles['woocommerce-general'] );
			return $enqueue_styles;
		}
	}
	add_filter( 'woocommerce_enqueue_styles', 'bloggers_lite_dequeue_styles' );

	add_action( 'after_setup_theme', 'bloggers_lite_woocommerce_support' );

	if ( ! function_exists( 'bloggers_lite_woocommerce_support' ) ) {
		/**
		 *
		 * Add woocommerce support
		 *
		 * @since Bloggers Lite 1.0
		 */
		function bloggers_lite_woocommerce_support() {
			global $woocommerce;
			add_theme_support( 'woocommerce' );
			if ( version_compare( $woocommerce->version, '3.0', '>=' ) ) {
				add_theme_support( 'wc-product-gallery-zoom' );
				add_theme_support( 'wc-product-gallery-lightbox' );
				add_theme_support( 'wc-product-gallery-slider' );
			}
		}
	}

	add_filter( 'woocommerce_show_page_title', 'bloggers_lite_hide_page_title' );

	if ( ! function_exists( 'bloggers_lite_hide_page_title' ) ) {
		/**
		 *
		 * Removes the "shop" title on the main shop page
		 *
		 * @since Bloggers Lite 1.0
		 */
		function bloggers_lite_hide_page_title() {
			return false;
		}
	}
}

add_action( 'admin_enqueue_scripts', 'bloggers_lite_admin_enqueue_scripts' );
if ( ! function_exists( 'bloggers_lite_admin_enqueue_scripts' ) ) {
	/**
	 *
	 * Added Admin js for customizer
	 *
	 * @since Bloggers Lite 1.0
	 */
	function bloggers_lite_admin_enqueue_scripts() {
		wp_enqueue_script( 'bloggers_lite_admin_js', get_template_directory_uri() . '/js/bloggers-lite-admin.js', array( 'jquery' ), false, true );
		wp_enqueue_style( 'bloggers_lite_admin_css', get_template_directory_uri() . '/css/bloggers-lite-admin.css' );
	}
}

require get_parent_theme_file_path( '/inc/customizer.php' );

if ( ! function_exists( 'bloggers_lite_wc_search_form' ) ) {
	/**
	 *
	 * Customizer additions
	 *
	 * @since Bloggers Lite 1.0
	 * @param html $form search form html.
	 */
	function bloggers_lite_wc_search_form( $form ) {
		$form = '<form role="search" method="get" id="searchform" class="searchform" action="' . esc_url( home_url( '/' ) ) . '" >
                <div><label class="screen-reader-text" for="s">' . esc_html__( 'Search for:', 'bloggers-lite' ) . '</label>
                <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr__( 'Search', 'bloggers-lite' ) . '" />
                <button id="searchsubmit" class="search-icon" type="submit">
                <input type="hidden" name="post_type" value="product" />
                <i class="fa fa-search"></i>
                </button>
                </div>
                </form>';
		return $form;
	}
}
add_filter( 'get_product_search_form', 'bloggers_lite_wc_search_form' );

if ( ! function_exists( 'bloggers_lite_call_plugin_api' ) ) {
	/**
	 *
	 * Add plugin data in transient
	 *
	 * @since Bloggers Lite 1.0
	 * @param string $slug slug of plugin.
	 */
	function bloggers_lite_call_plugin_api( $slug ) {
		load_template( ABSPATH . 'wp-admin/includes/plugin-install.php' );

		$call_api = get_transient( 'ti_about_page_plugin_information_transient_' . $slug );
		if ( false === $call_api ) {
			$call_api = plugins_api(
				'plugin_information', array(
					'slug'   => $slug,
					'fields' => array(
						'downloaded'        => false,
						'rating'            => false,
						'description'       => false,
						'short_description' => true,
						'donate_link'       => false,
						'tags'              => false,
						'sections'          => true,
						'homepage'          => true,
						'added'             => false,
						'last_updated'      => false,
						'compatibility'     => false,
						'tested'            => false,
						'requires'          => false,
						'downloadlink'      => false,
						'icons'             => true,
					),
				)
			);
			set_transient( 'ti_about_page_plugin_information_transient_' . $slug, $call_api, 30 * MINUTE_IN_SECONDS );
		}

		return $call_api;
	}
}

if ( ! function_exists( 'bloggers_lite_plugin_link' ) ) {
	/**
	 *
	 * Display plugins status
	 *
	 * @since Bloggers Lite 1.0
	 * @param array $item array of plugins.
	 */
	function bloggers_lite_plugin_link( $item ) {
		$installed_plugins        = get_plugins();
		$item['sanitized_plugin'] = $item['name'];
		$actions                  = array();
		// We have a repo plugin.
		if ( ! $item['version'] ) {
			$item['version'] = TGM_Plugin_Activation::$instance->does_plugin_have_update( $item['slug'] );
		}
		/** We need to display the 'Install' hover link */
		if ( ! isset( $installed_plugins[ $item['file_path'] ] ) ) {
			$actions = array(
				'install' => sprintf(
					'<a href="%1$s" class="button button-primary" title="Install %2$s">Install</a>', esc_url(
						wp_nonce_url(
							add_query_arg(
								array(
									'page'          => urlencode( TGM_Plugin_Activation::$instance->menu ),
									'plugin'        => urlencode( $item['slug'] ),
									'plugin_name'   => urlencode( $item['sanitized_plugin'] ),
									'plugin_source' => urlencode( $item['source'] ),
									'tgmpa-install' => 'install-plugin',
									'return_url'    => 'fusion_plugins',
								), TGM_Plugin_Activation::$instance->get_tgmpa_url()
							), 'tgmpa-install', 'tgmpa-nonce'
						)
					), $item['sanitized_plugin']
				),
			);
		} /** We need to display the 'Activate' hover link */ elseif ( is_plugin_inactive( $item['file_path'] ) ) {
			$tab = '';
			if ( isset( $_GET['tab'] ) ) {
				$tab = sanitize_key( $_GET['tab'] );
			}
			$actions = array(
				'activate' => sprintf(
					'<a href="%1$s" class="button button-primary" title="Activate %2$s">Activate</a>', esc_url(
						add_query_arg(
							array(
								'activate_plugin'         => $item['file_path'],
								'bloggers-activate-nonce' => wp_create_nonce( 'bloggers-activate' ),
							), admin_url( 'themes.php?page=about_bloggers_lite&tab=' . $tab )
						)
					), $item['sanitized_plugin']
				),
			);
		} elseif ( is_plugin_active( $item['file_path'] ) ) {
			$tab = '';
			if ( isset( $_GET['tab'] ) ) {
				$tab = sanitize_key( $_GET['tab'] );
			}
			$actions = array(
				'deactivate' => sprintf(
					'<a href="%1$s" class="button button-primary" title="Deactivate %2$s">Deactivate</a>', esc_url(
						add_query_arg(
							array(
								'deactivate_plugin' => $item['file_path'],
								'bloggers-deactivate-nonce' => wp_create_nonce( 'bloggers-deactivate' ),
							), admin_url( 'themes.php?page=about_bloggers_lite&tab=' . $tab )
						)
					), $item['sanitized_plugin']
				),
			);
		}

		return $actions;
	}
}

if ( ! function_exists( 'sanitize_html_classes' ) && function_exists( 'sanitize_html_class' ) ) {
  /**
	 * sanitize_html_class works just fine for a single class
	 * Some times le wild <span class="navbar-collapse collapse"> appears, which is when you need this function,
	 * to validate both navbar-collapse and collapse,
	 * Because sanitize_html_class doesn't allow spaces.
	 *
	 * @uses   sanitize_html_class
	 * @param  (mixed: string/array) $class   'navbar-collapse collapse' or array(  'navbar-collapse', 'collapse'  )
	 * @param  (mixed) $fallback Anything you want returned in case of a failure
	 * @return (mixed: string / $fallback )
	 */
	function sanitize_html_classes( $class, $fallback = null ) {
		// Explode it, if it's a string
		if ( is_string( $class ) ) {
			$class = explode( " ", $class );
		} 
		if ( is_array( $class ) && count( $class ) > 0 ) {
			$class = array_map( "sanitize_html_class", $class );
			return implode( " ", $class );
		}
		else { 
			return sanitize_html_class( $class, $fallback );
		}
	}
}