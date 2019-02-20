<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to bloggers-lite/woocommerce/myaccount/my-account.php.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();
?>
<div class="bloggers-lite-account-wrapper">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<?php
		/**
		 * My Account navigation.
		 *
		 * @since 2.6.0
		 */
		do_action( 'woocommerce_account_navigation' );
		?>
	</div>


	<div class="col-md-8 col-sm-8 col-xs-12">
		<div class="woocommerce-MyAccount-content">
			<?php
			/**
			 * My Account content.
			 *
			 * @since 2.6.0
			 */
			do_action( 'woocommerce_account_content' );
			?>
		</div>
	</div>    
</div>
