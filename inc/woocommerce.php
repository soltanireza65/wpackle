<?php
function _themename_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support('wc-product-gallery-zoom');
	add_theme_support('wc-product-gallery-lightbox');
	add_theme_support('wc-product-gallery-slider');
}

add_action('after_setup_theme', '_themename_woocommerce_setup');

function _themename_woocommerce_scripts() {
	wp_enqueue_style('_themename-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _themename_VERSION);

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style('_themename-woocommerce-style', $inline_font);
}

// add_action('wp_enqueue_scripts', '_themename_woocommerce_scripts');

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
// add_filter('woocommerce_enqueue_styles', '__return_empty_array');

function _themename_woocommerce_active_body_class($classes) {
	$classes[] = 'woocommerce-active';

	return $classes;
}

add_filter('body_class', '_themename_woocommerce_active_body_class');

function _themename_woocommerce_related_products_args($args) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args($defaults, $args);

	return $args;
}

// add_filter('woocommerce_output_related_products_args', '_themename_woocommerce_related_products_args');

/**
 * Remove default WooCommerce wrapper.
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

if (!function_exists('_themename_woocommerce_wrapper_before')) {
	function _themename_woocommerce_wrapper_before() {
?>
		<main id="primary" class="site-main">
		<?php
	}
}
add_action('woocommerce_before_main_content', '_themename_woocommerce_wrapper_before');

if (!function_exists('_themename_woocommerce_wrapper_after')) {

	function _themename_woocommerce_wrapper_after() {
		?>
		</main><!-- #main -->
	<?php
	}
}
add_action('woocommerce_after_main_content', '_themename_woocommerce_wrapper_after');

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
 * <?php
 * if ( function_exists( '_themename_woocommerce_header_cart' ) ) {
 * _themename_woocommerce_header_cart();
 * }
 * ?>
 */

if (!function_exists('_themename_woocommerce_cart_link_fragment')) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 *
	 * @return array Fragments to refresh via AJAX.
	 */
	function _themename_woocommerce_cart_link_fragment($fragments) {
		ob_start();
		_themename_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter('woocommerce_add_to_cart_fragments', '_themename_woocommerce_cart_link_fragment');

if (!function_exists('_themename_woocommerce_cart_link')) {
	function _themename_woocommerce_cart_link() {
	?>
		<a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', '_themename'); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n('%d آیتم', '%d آیتم', WC()->cart->get_cart_contents_count(), '_themename'),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<!-- <span class="amount"><?php echo wp_kses_data(WC()->cart->get_cart_subtotal()); ?></span> -->

			<i class="fal fa-shopping-cart fontsize_17 icon-size-md circle_padding_white position-relative">
				<span class="position-absolute app_woo_cart_qty">
					<?php echo WC()->cart->get_cart_contents_count(); ?>
				</span>
			</i>

		</a>
	<?php
	}
}

if (!function_exists('_themename_woocommerce_header_cart')) {
	function _themename_woocommerce_header_cart() {
		if (is_cart()) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
	?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr($class); ?>">
				<?php _themename_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget('WC_Widget_Cart', $instance);
				?>
			</li>
		</ul>
	<?php
	}
}


// Custom


function _themename_woo_product_search() {
	?>
	<form role="search" method="get" class="form-inline woocommerce-product-search w-100" action="<?php echo esc_url(home_url('/')); ?>">
		<div class="form-group mb-0 w-100">
			<div class="input-group w-100 d-flex" style="height: 40px;">
				<div class="input-group-prepend top_search_cat_select">
					<?php
					$product_cats = get_terms(array(
						'taxonomy' => 'product_cat',
					));

					if (!empty($product_cats) && !is_wp_error($product_cats)) :
						$selected_product_cat = get_query_var('product_cat');
					?>
						<select name="product_cat" class="cate-dropdown">
							<option value="">دسته بندی ها</option>
							<?php
							foreach ($product_cats as $product_cat) {
							?>
								<option value="<?php echo esc_attr($product_cat->slug) ?>" <?php selected($product_cat->slug, $selected_product_cat) ?>><?php echo esc_html($product_cat->name); ?></option>
							<?php
							}
							?>
						</select>
					<?php endif; ?>
				</div>
				<input type="search" class="search-field header_serach_input flex-grow-1" style="height: 40px !important; padding-right: 20px;" id="woocommerce-product-search-field" placeholder="جستجو در خرید پک" value="<?php echo get_search_query(); ?>" name="s" />
				<div class="input-group-append">
					<button type="submit" value="" class="bg-danger text-white">
						<i class="fa fa-search " aria-hidden="true"></i>
					</button>
					<input type="hidden" name="post_type" value="product" />
				</div>
			</div>
		</div>
	</form>
<?php
}

remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);


// Yith Woo After Wishlist Button
function _themename_browse_wishlist_button() {
	return '<i class="fas fa-heart"></i>';
}
add_filter('yith-wcwl-browse-wishlist-label', '_themename_browse_wishlist_button');

// Yith Woo After Wishlist Button
function _themename_compare_label() {
	return '';
}
// add_filter('yith_woocompare_compare_added_label', '_themename_compare_label');




if (!function_exists('_themename_loop_columns')) {
	function _themename_loop_columns() {
		return 3;
	}
}
add_filter('loop_shop_columns', '_themename_loop_columns');



function _themename_related_products_by_same_title($related_posts, $product_id, $args) {
	$product       = wc_get_product($product_id);
	$title         = $product->get_name();
	$related_posts = get_posts(array(
		'post_type'      => 'product',
		'post_status'    => 'publish',
		'title'          => $title,
		'fields'         => 'ids',
		'posts_per_page' => -1,
		'exclude'        => array($product_id),
	));

	return $related_posts;
}
// add_filter('woocommerce_related_products', '_themename_related_products_by_same_title', 9999, 3);


function _themename_related_products_args($args) {
	$args['posts_per_page'] = 4; // 12 related products
	$args['columns']        = 4; // arranged in 2 columns

	return $args;
}

// add_filter('woocommerce_output_related_products_args', '_themename_related_products_args', 20);


function _themename_remove_single_product_tabs($tabs) {
	unset($tabs['more_seller_product']);

	return $tabs;
}

add_filter('woocommerce_product_tabs', '_themename_remove_single_product_tabs', 11);




// Checkout Fields
function _themename_remove_checkout_fields($fields) {
	// Billing fields
	//	unset( $fields['billing']['billing_company'] );
	//	unset( $fields['billing']['billing_email'] );
	//	unset( $fields['billing']['billing_country'] );
	// unset($fields['billing']['billing_phone']);
	// unset($fields['billing']['billing_state']);
	// unset($fields['billing']['billing_first_name']);
	// unset($fields['billing']['billing_last_name']);
	// unset($fields['billing']['billing_address_1']);
	// unset($fields['billing']['billing_address_2']);
	// unset($fields['billing']['billing_city']);
	// unset($fields['billing']['billing_postcode']);

	// Shipping fields
	//	unset( $fields['shipping']['shipping_company'] );
	// unset($fields['shipping']['shipping_phone']);
	// unset($fields['shipping']['shipping_state']);
	// unset($fields['shipping']['shipping_first_name']);
	// unset($fields['shipping']['shipping_last_name']);
	// unset($fields['shipping']['shipping_address_1']);
	// unset($fields['shipping']['shipping_address_2']);
	// unset($fields['shipping']['shipping_city']);
	// unset($fields['shipping']['shipping_postcode']);

	// Order fields
	// unset($fields['order']['order_comments']);


	// $fields['billing']['billing_company']['placeholder'] = 'Business Name';
	// $fields['billing']['billing_company']['label'] = 'Business Name';
	// $fields['billing']['billing_first_name']['placeholder'] = 'First Name';
	// $fields['shipping']['shipping_first_name']['placeholder'] = 'First Name';
	// $fields['shipping']['shipping_last_name']['placeholder'] = 'Last Name';
	// $fields['shipping']['shipping_company']['placeholder'] = 'Company Name';
	// $fields['billing']['billing_last_name']['placeholder'] = 'Last Name';
	// $fields['billing']['billing_email']['placeholder'] = 'Email Address ';
	// $fields['billing']['billing_phone']['placeholder'] = 'Phone ';

	// $order = array(
	//     "billing_first_name",
	//     "billing_last_name",
	//     "shipping_state",
	//     "billing_city",
	//     "billing_address_1",
	//     "billing_address_2",
	//     "billing_postcode",
	//     // "billing_email",
	//     "billing_phone"
	// );
	// foreach ($order as $field) {
	//     $ordered_fields[$field] = $fields["billing"][$field];
	// }

	// $fields["billing"] = $ordered_fields;

	// return $fields;
}
// add_filter('woocommerce_checkout_fields', '_themename_remove_checkout_fields');

function _themename_unrequire_wc_fields($fields) {
	//	$fields['billing_phone']['required']   = false;
	$fields['billing_country']['required'] = false;

	return $fields;
}

add_filter('woocommerce_billing_fields', '_themename_unrequire_wc_fields');


function _themename_override_checkout_fields($fields) {
	//     unset($fields['billing']['billing_address_2']);
	//     $fields['billing']['billing_company']['placeholder'] = 'Business Name';
	//     $fields['billing']['billing_company']['label'] = 'Business Name';
	//     $fields['billing']['billing_first_name']['placeholder'] = 'First Name';
	//     $fields['shipping']['shipping_first_name']['placeholder'] = 'First Name';
	//     $fields['shipping']['shipping_last_name']['placeholder'] = 'Last Name';
	//     $fields['shipping']['shipping_company']['placeholder'] = 'Company Name';
	//     $fields['billing']['billing_last_name']['placeholder'] = 'Last Name';
	//     $fields['billing']['billing_email']['placeholder'] = 'Email Address ';
	//     $fields['billing']['billing_phone']['placeholder'] = 'Phone ';
	//     return $fields;
}
// add_filter('woocommerce_checkout_fields', '_themename_override_checkout_fields');


// Reorder Checkout Fields

function _themename_reorder_wc_fields($fields) {
	$order = array(
		"billing_first_name",
		"billing_last_name",
		"billing_address_1",
		"billing_address_2",
		"billing_postcode",
		// "billing_email",
		"billing_phone"
	);
	foreach ($order as $field) {
		$ordered_fields[$field] = $fields["billing"][$field];
	}

	$fields["billing"] = $ordered_fields;

	return $fields;
}

// add_filter("woocommerce_checkout_fields", "_themename_reorder_wc_fields");







function _themename_show_tags() {

	$tags = json_decode(json_encode(get_the_terms(get_the_ID(), 'product_tag')), true);
	if ($tags && !is_wp_error($tags)) {

		$index = 0;
		echo '<div class="product_tags d-flex flex-wrap align-items-baseline">';
		echo '<p class="mt-3 ml-2">برچسب ها: </p>';
		foreach ($tags as $tag_key => $tag) {
			$index++;
			$term_id = $tag['term_id'];
			$name = $tag['name'];
			$slug = $tag['slug'];
			$count = $tag['count'];
			$tag_link  = get_tag_link($term_id);

			echo '<div class="mx-1 tag-item"><a class="" href="' . $tag_link . '">' . $name . '</a></div>';
			// echo 
			// if ($index < count($tags)) {
			// 	echo ',';
			// }
		}

		echo '</div>';
	}
}


function _themename_show_top_features() {
	if (get_post_meta(get_the_ID(), '_prefix_product_options', true)) {
		$meta = get_post_meta(get_the_ID(), '_prefix_product_options', true);
		if ($meta['opt-repeater']  && is_array($meta['opt-repeater']) || is_object($meta['opt-repeater'])) {
			echo '<h6 class="my-3">ویژگی های محصول</h6>';
			echo '<div class="descriptionsList ">';
			foreach ($meta['opt-repeater'] as $key => $value) {
				foreach ($value as $k => $val) {
					echo '<div class="d-flex align-items-center mr-2 my-1 top_feature_item">';
					echo 	'<p class="ml-1 my-0"> ' . $val["opt-text-key"] . ' :</p>';
					echo 	'<p class="my-0"> ' . $val["opt-text-val"] . ' :</p>';
					echo '</div>';
				}
			}
			echo "</div>";
			if (count($meta['opt-repeater']) > 3) {
				echo '<p class="readMoreLink ">دیدن همه</p>';
				// echo '<span class="readMoreLink mt-0 mr-4">';
				// echo 	'<i class="fas fa-plus"></i>';
				// echo 	'<i class="d-none fas fa-minus"></i>';
				// echo '</span>';
			}
		}
	}
}
//remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );







function remove_last_woocommerce_structured_data_breadcrumblist($markup) {
	if (is_singular()) {
		array_pop($markup['itemListElement']);
	}
	return $markup;
}
add_filter('woocommerce_structured_data_breadcrumblist', 'remove_last_woocommerce_structured_data_breadcrumblist', 10, 1);


// add_action( 'woocommerce_product_options_general_product_data', '_themename_add_related_checkbox_products' );

function _themename_add_related_checkbox_products() {
	woocommerce_wp_checkbox(
		array(
			'id' => 'hide_related',
			'class' => '',
			'label' => 'Hide Related Products'
		)
	);
}

// -----------------------------------------
// 2. Save checkbox into custom field

// add_action('save_post_product', '_themename_save_related_checkbox_products');

function _themename_save_related_checkbox_products($product_id) {
	global $pagenow, $typenow;
	if ('post.php' !== $pagenow || 'product' !== $typenow) return;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
	if (isset($_POST['hide_related'])) {
		update_post_meta($product_id, 'hide_related', $_POST['hide_related']);
	} else delete_post_meta($product_id, 'hide_related');
}

// -----------------------------------------
// 3. Hide related products @ single product page

// add_action('woocommerce_after_single_product_summary', '_themename_hide_related_checkbox_products', 1);

function _themename_hide_related_checkbox_products() {
	global $product;
	if (!empty(get_post_meta($product->get_id(), 'hide_related', true))) {
		remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
	}
}















// add_action('wp', '_themename_remove_zoom_lightbox_theme_support', 99);

function _themename_remove_zoom_lightbox_theme_support() {
	// remove_theme_support('wc-product-gallery-zoom');
	// remove_theme_support('wc-product-gallery-lightbox');
	// remove_theme_support('wc-product-gallery-slider');
}







// add_filter('avatar_defaults', '_themename_new_gravatar');
function _themename_new_gravatar($avatar_defaults) {
	$myavatar = get_theme_file_uri('/dist/assets/images/default-profile.png');
	$avatar_defaults[$myavatar] = "Default Gravatar";
	return $avatar_defaults;
}
