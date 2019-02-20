<?php
/**
 * File to display about section of theme.
 *
 * @package Bloggers Lite
 * @since Bloggers Lite 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( isset( $_REQUEST['activate_plugin'] ) ) {
	$active_plugin = sanitize_key($_REQUEST['activate_plugin']);
	activate_plugin( $active_plugin );
}

if ( isset( $_REQUEST['deactivate_plugin'] ) ) {
	$active_plugin = sanitize_key($_REQUEST['deactivate_plugin']);
	deactivate_plugins( $active_plugin );
}

$active_tab = ( isset( $_GET['tab'] ) && '' != $_GET['tab'] ) ? sanitize_key($_GET['tab']) : 'getting_started';
?>

<div class="wrap about-wrap bloggers-wrap">
	<h1><?php esc_html_e( 'Welcome to Bloggers Lite Theme!', 'bloggers-lite' ); ?></h1>
	<div class="about-text"><?php esc_html_e( 'Bloggers Lite is now installed and ready to use! We want to make sure you have the best experience using Bloggers Lite and that is why we gathered here all the necessary information for you. We hope you will enjoy using Bloggers Lite, as much as we enjoy creating great products.', 'bloggers-lite' ); ?></div>
	<a href="<?php echo esc_url( 'https://www.solwininfotech.com/' ); ?>" target="_blank" class="wp-badge bloggers-welcome-logo"></a>

	<h2 class="nav-tab-wrapper wp-clearfix">
		<a href="<?php echo esc_url( admin_url( 'themes.php?page=about_bloggers_lite' ) . '&tab=getting_started' ); ?>" class="nav-tab<?php echo ( 'getting_started' == $active_tab ) ? ' nav-tab-active' : ''; ?>"><?php esc_html_e( 'Getting Started', 'bloggers-lite' ); ?></a>
		<a href="<?php echo esc_url( admin_url( 'themes.php?page=about_bloggers_lite' ) . '&tab=recommended_actions' ); ?>" class="nav-tab<?php echo ( 'recommended_actions' == $active_tab ) ? ' nav-tab-active' : ''; ?>"><?php esc_html_e( 'Recommended Actions', 'bloggers-lite' ); ?></a>
		<a href="<?php echo esc_url( admin_url( 'themes.php?page=about_bloggers_lite' ) . '&tab=recommended_plugins' ); ?>" class="nav-tab<?php echo ( 'recommended_plugins' == $active_tab ) ? ' nav-tab-active' : ''; ?>"><?php esc_html_e( 'Recommended Plugins', 'bloggers-lite' ); ?></a>
		<a href="<?php echo esc_url( admin_url( 'themes.php?page=about_bloggers_lite' ) . '&tab=support' ); ?>" class="nav-tab<?php echo ( 'support' == $active_tab ) ? ' nav-tab-active' : ''; ?>"><?php esc_html_e( 'Support', 'bloggers-lite' ); ?></a>
	</h2>

	<?php if ( 'getting_started' == $active_tab ) : ?>
		<div class="feature-section three-col">
			<div class="col">
				<h3><?php esc_html_e( 'Step 1 - Implement recommended actions', 'bloggers-lite' ); ?></h3>
				<p><?php esc_html_e( 'We have compiled a list of steps for you, to take make sure the experience you will have using one of our products is very easy to follow.', 'bloggers-lite' ); ?></p>
			</div>
			<div class="col">
				<h3><?php esc_html_e( 'Step 2 - Check our documentation', 'bloggers-lite' ); ?></h3>
				<p><?php esc_html_e( 'Even if you are a long-time WordPress user, we still believe you should give our documentation a very quick Read.', 'bloggers-lite' ); ?></p>
				<p><a href="<?php echo esc_url( 'https://solwininfotech.com/documents/wordpress/bloggers-lite/' ); ?>" target="_blank"><?php esc_html_e( 'Full documentation', 'bloggers-lite' ); ?></a></p>
			</div>
			<div class="col">
				<h3><?php esc_html_e( 'Customize everything', 'bloggers-lite' ); ?></h3>
				<p><?php esc_html_e( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'bloggers-lite' ); ?></p>
				<p><a class="button button-primary" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" target="_blank"><?php esc_html_e( 'Go to Customizer', 'bloggers-lite' ); ?></a></p>
			</div>
		</div>
	<?php endif; ?>

	<?php if ( 'recommended_actions' == $active_tab ) : ?>
		<?php
		get_template_part( 'inc/class-tgm-plugin-activation' );
		$plugins = TGM_Plugin_Activation::$instance->plugins;

		$installed_plugins = get_plugins();
		?>
		<div class="feature-section recommended-actions-section">
			<?php
			foreach ( $plugins as $plugin ) {
				if ( 'recommended_actions' == $plugin['type'] ) {
					$file_path      = $plugin['file_path'];
					$plugin_data    = bloggers_lite_call_plugin_api( $plugin['slug'] );
					$update_version = TGM_Plugin_Activation::$instance->does_plugin_have_update( $plugin['slug'] );
					$plugin_action  = bloggers_lite_plugin_link( $plugin );
					?>
					<div class="plugin_area">
						<h3> <?php echo esc_attr( $plugin_data->name ); ?> </h3>
						<div class="plugin_desc">
							<?php echo esc_html( $plugin['desc'] ); ?>
						</div>
						<div class="plugin-img-cover">
							<span class="version"><?php echo esc_html__( 'Version', 'bloggers-lite' ) . ' ' . esc_attr( $plugin_data->version ); ?></span>
							<span class="separator"> | </span>
							<span class="author" > <?php echo $plugin_data->author; ?> </span>
						</div>
						<div class="action_bar">
							<span class="btn">
								<?php
								foreach ( $plugin_action as $action ) {
									printf('%s',$action);
								}
								?>
							</span>
						</div>
						<?php if ( isset( $plugin_action['update'] ) && $plugin_action['update'] ) : ?>
							<div class="theme-update">
								<?php echo esc_html__( 'Update Available: Version', 'bloggers-lite' ) . ' ' . esc_attr( $update_version ); ?>
							</div>
						<?php endif; ?>
					</div>
					<?php
				}
			}
			?>
		</div>
	<?php endif; ?>


	<?php if ( 'recommended_plugins' == $active_tab ) : ?>
		<?php
		get_template_part( 'inc/class-tgm-plugin-activation' );
		$plugins = TGM_Plugin_Activation::$instance->plugins;

		$installed_plugins = get_plugins();
		?>
		<div class="feature-section three-col">
			<?php
			foreach ( $plugins as $plugin ) {
				if ( 'recommended_plugins' == $plugin['type'] ) {
					$file_path      = $plugin['file_path'];
					$plugin_data    = bloggers_lite_call_plugin_api( $plugin['slug'] );
					$update_version = TGM_Plugin_Activation::$instance->does_plugin_have_update( $plugin['slug'] );
					$plugin_action  = bloggers_lite_plugin_link( $plugin );
					?>
					<div class="col plugin_area">
						<img src="<?php echo esc_url( $plugin_data->icons['2x'] ); ?>" />
						<div class="plugin-img-cover">
							<span class="version"><?php echo esc_html__( 'Version', 'bloggers-lite' ) . ' ' . esc_attr( $plugin_data->version ); ?></span>
							<span class="separator"> | </span>
							<span class="author" > <?php echo $plugin_data->author; ?> </span>
						</div>
						<div class="action_bar ">
							<span class="plugin_name"><?php echo esc_attr( $plugin_data->name ); ?></span>
							<span class="btn">
								<?php
								foreach ( $plugin_action as $action ) {
									printf('%s',$action);
								}
								?>
							</span>
						</div>
						<?php if ( isset( $plugin_action['update'] ) && $plugin_action['update'] ) : ?>
							<div class="theme-update">
								<?php echo esc_html__( 'Update Available: Version', 'bloggers-lite' ) . ' ' . esc_attr( $update_version ); ?>
							</div>
						<?php endif; ?>
					</div>
					<?php
				}
			}
			?>
		</div>
	<?php endif; ?>

	<?php if ( 'support' == $active_tab ) : ?>
		<div class="feature-section three-col">
			<div class="col">
				<h3> <i class="dashicons dashicons-sos"></i> <?php esc_html_e( 'Contact Support', 'bloggers-lite' ); ?></h3>
				<p><?php esc_html_e( 'We offer excellent support through our advanced ticketing system. Make sure to register your purchase before contacting support!', 'bloggers-lite' ); ?></p>
				<p><a class="button button-primary" target="_blank" href="<?php echo esc_url( 'http://support.solwininfotech.com/' ); ?>"><?php esc_html_e( 'Contact Support', 'bloggers-lite' ); ?></a></p>
			</div>
			<div class="col">
				<h3> <i class="dashicons dashicons-book-alt"></i> <?php esc_html_e( 'Documentation', 'bloggers-lite' ); ?></h3>
				<p><?php esc_html_e( 'This is the place to go to reference different aspects of the theme. Our online documentation is an incredible resource for learning the ins and outs of using belise.', 'bloggers-lite' ); ?></p>
				<p><a href="<?php echo esc_url( 'https://solwininfotech.com/documents/wordpress/bloggers-lite/' ); ?>" target="_blank"><?php esc_html_e( 'Full documentation', 'bloggers-lite' ); ?></a></p>
			</div>
			<div class="col">
				<h3><i class="dashicons dashicons-testimonial"></i><?php esc_html_e( 'FAQs', 'bloggers-lite' ); ?></h3>
				<p><?php esc_html_e( 'We provide general FAQs according to Bloggers Lite theme. In which covered commonly question and their answer. To FAQs check out our website.', 'bloggers-lite' ); ?></p>
				<p><a href="<?php echo esc_url( 'https://solwininfotech.com/documents/wordpress/bloggers-lite/#faq' ); ?>" target="_blank"><?php esc_html_e( 'Read FAQ', 'bloggers-lite' ); ?></a></p>
			</div>
		</div>
	<?php endif; ?>
</div>