<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>



	<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

		<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

					$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
					$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
					$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

					?>
					<!-- widget box -->
					<div class="widget-box">

						<div class="media">

							<div class="small-product pull-left">
								<div class="small-product-wrapper">
									<a href="<?php echo get_permalink( $product_id ); ?>">
									<?php 
									if( has_post_thumbnail( $product_id ) ){
										echo get_the_post_thumbnail( $product_id, 'small_cart', array( 'class' => 'media-object img-thumbnail img-circle' ) );
									}
									else{
									?>
										<img class="img-thumbnail img-circle" src="<?php wc_placeholder_img_src(); ?>" title="" alt="" />
									<?php
									}									
									?>
										
									</a>
								</div>
							</div>

							<div class="media-body small-product">
								<h6 class="media-heading"><a href="<?php echo get_permalink( $product_id ); ?>"><?php echo $product_name; ?></a>
								</h6>
								<p><?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?></p>
							</div>
						</div>

					</div>
					<!-- .widget box -->					
					<?php
				}
			}
		?>

	<?php else : ?>

		<div class="empty"><?php _e( 'No products in the cart.', 'woocommerce' ); ?></div>
		<br />

	<?php endif; ?>



<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

	<!-- widget box -->
	<div class="widget-box">
		<div class="total sub-total ">
			<p class="text-right"><?php _e( 'Subtotal', 'woocommerce' ); ?>:
				<span><?php echo WC()->cart->get_cart_subtotal(); ?></span>
			</p>
		</div>

	</div>
	<!-- .widget box -->

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>
	<!-- widget box -->
	<div class="widget-box">
		<a href="<?php echo WC()->cart->get_cart_url(); ?>" class="button-normal white"><?php _e( 'VIEW CART', 'woocommerce' ); ?></a>
		<a href="<?php echo WC()->cart->get_checkout_url(); ?>" class="button-normal white checkout"><?php _e( 'CHECKOUT', 'woocommerce' ); ?></a>
	</div>
	<!-- .widget-box -->

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>