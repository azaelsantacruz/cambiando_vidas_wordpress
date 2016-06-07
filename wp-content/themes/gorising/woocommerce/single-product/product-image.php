<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

$attachment_ids = $product->get_gallery_attachment_ids();

if ( $attachment_ids ) {

	$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
	$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
	$image       = get_the_post_thumbnail( $post->ID, 'shop_single', array(
		'title' => $image_title
		) );

	$attachment_count = count( $product->get_gallery_attachment_ids() );

	if ( $attachment_count > 0 ) {
		$gallery = '[product-gallery]';
	} else {
		$gallery = '';
	}
	
	$image_ids = $product->get_gallery_attachment_ids();
	$images_html = '';
	$navigation = '';
	
	for( $i=0; $i<sizeof( $image_ids ); $i++ ){
		$image_id = $image_ids[$i];
		$image_data = gorising_get_attachment( $image_id, 'shop_single' );
		$images_html .= '
			<div class="item '.( $i == 0 ? 'active' : '' ).'">
				<img src="'.$image_data['src'].'" alt="" title="'.$image_data['title'].'" />
			</div>
		';
		
		$navigation .= '<li data-target="#singleCarousel" data-slide-to="'.$i.'" class="'.( $i == 0 ? 'active' : '' ).'"></li>';
	}
	?>
		<div id="singleCarousel" class="carousel slide single-page normal" data-ride="carousel" data-interval="false">


			<!-- Indicators -->
			<ol class="carousel-indicators shop">
				<?php echo $navigation; ?>
			</ol>


			<!-- Wrapper for slides -->
			<div class="carousel-inner">
				<?php echo $images_html; ?>
			</div>
			<!-- .carousel-inner -->

		</div>
		<!-- carousel -->	
	<?php

} else {

	echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $post->ID );

}

?>
<?php do_action( 'woocommerce_product_thumbnails' ); ?>

