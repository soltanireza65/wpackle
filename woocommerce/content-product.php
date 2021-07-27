<?php
defined('ABSPATH') || exit;
global $product;
if (empty($product) || false === wc_get_loop_product_visibility($product->get_id()) || !$product->is_visible()) {
	return;
}
?>

<li <?php wc_product_class('', $product); ?>>
	<div class="card app_card position-relative">
		<a href="<?php the_permalink(); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link app_woo_product_img_wrapper">
			<img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" class="img-responsive" alt="">
		</a>
		<?php
		?>
		<h6 class="card-title text-center font-weight-bold mt-2" style="">
			<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
		</h6>
		<div class="product_icons_wraper align-middle position-absolute">
			<div class="product_icons radius text-center d-flex align-items-center">
				<?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
				<div class="woocommerce product compare-button">
					<a href="<?php echo get_site_url(); ?>?action=yith-woocompare-add-product&amp;id=<?php echo get_the_ID() ?>" class="compare button" data-product_id="<?php echo get_the_ID() ?>" rel="nofollow">
						<i class="fas fa-random"></i>
					</a>
				</div>
			</div>
		</div>
		<div class="d-flex align-items-center">
			<div class="app_woo_add_to_cart_wraper">
				<?php woocommerce_template_loop_add_to_cart(); ?>
			</div>
			<div class="mr-auto product_price_wraper">
				<?php echo $product->get_price_html(); ?>
			</div>
		</div>
	</div>
</li>