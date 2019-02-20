<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $product, $woocommerce_loop, $post, $woocommerce;
$col = 3;
// Store loop count we're currently on.
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}
// Store column count for displaying the grid.
$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );
// Ensure visibility.
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count.
$woocommerce_loop['loop'] ++;

// Extra post classes.
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
	$classes[] = '';
}
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = '';
}
/* -----per column display products-------------- */
if ( ! empty( $woocommerce_loop['columns'] ) ) {
	$col = 12 / $woocommerce_loop['columns'];
}
if ( isset( $classes[0] ) ) {
	$flclass = $classes[0];
} else {
	$flclass = '';
}
?>
<li class="col-xs-6 col-sm-6 full_width col-md-
<?php
echo sanitize_html_classes($col);
echo ' ';
echo sanitize_html_classes($flclass);
?>
">
	<article class="product">
		<div class="idoct-product-image">
			<?php woocommerce_show_product_loop_sale_flash(); ?>
			<div class="shop-product musictune_add_to_cart">
				<a class="veriyas-figure-href" href="<?php the_permalink(); ?>">
					<?php
					/**
					 * woocommerce_before_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
					echo woocommerce_get_product_thumbnail();
					?>
				</a>

			</div>
		</div>
		<div class="product-caption">
			<div class="block-name">
				<div class="product-rating">
					<?php
					/**
					 * woocommerce_after_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_template_loop_rating - 5
					 * @hooked woocommerce_template_loop_price - 10
					 */
					do_action( 'woocommerce_after_shop_loop_item_title' );
					/**
					 * woocommerce_after_shop_loop_item hook.
					 *
					 * @hooked woocommerce_template_loop_product_link_close - 5
					 * @hooked woocommerce_template_loop_add_to_cart - 10
					 */
					?>
				</div>
				<div class="product-title">
					<a class="product-name" href="<?php the_permalink(); ?>">
						<span><?php echo get_the_title(); ?></span>
					</a>
				</div>
				<div class="product-add_to_cart_wrap">
					<?php
					do_action( 'woocommerce_after_shop_loop_item' );
					?>
				</div>
			</div>
		</div>
	</article>
</li>
