<?php

if (!defined('_themename_VERSION')) {
	define('_themename_VERSION', '1.0.0');
}

require_once get_theme_file_path() . '/inc/theme_options/codestar-framework.php';

require_once get_theme_file_path() . '/inc/theme_options/options/product-options.php';

// require_once __DIR__ . '/inc/admin.php';
require_once __DIR__ . '/inc/max_megamenu.php';
require_once __DIR__ . '/inc/elementor/init.php';
require __DIR__ . '/inc/widgets.php';
require __DIR__ . '/inc/query.php';
require __DIR__ . '/inc/setup-theme.php';
require __DIR__ . '/inc/enqueue.php';
require __DIR__ . '/inc/template-tags.php';
require __DIR__ . '/inc/template-functions.php';
require __DIR__ . '/inc/customizer.php';




require __DIR__ . '/inc/taxonomies.php';
require __DIR__ . '/inc/jwt-auth/jwt-auth.php';
require __DIR__ . '/inc/wp-api-menus/wp-api-menus.php';

// require __DIR__ . '/inc/rest/index.php';
require __DIR__ . '/inc/rest/auth-routes.php';


if (defined('JETPACK__VERSION')) {
	require __DIR__ . '/inc/jetpack.php';
}
if (class_exists('WooCommerce')) {
	require __DIR__ . '/inc/woocommerce.php';
	require __DIR__ . '/inc/woocommerce_functions.php';
}
// add_action('init', '_themename_prevent_wp_login');
function _themename_prevent_wp_login() {
	global $pagenow;
	$action = (isset($_GET['action'])) ? $_GET['action'] : '';
	if ($pagenow == 'wp-login.php' && (!$action || ($action && !in_array($action, array('logout', 'lostpassword', 'rp', 'resetpass'))))) {
		$page = get_bloginfo('url');
		wp_redirect($page);
		exit();
	}
}


function kharidpack_get_part($slug = null, $slug2 = null) {
	if ($slug !== null) {
		if ($slug2 !== null) {
			get_template_part('/template-parts/' . $slug, $slug2);
		} else {
			get_template_part('/template-parts/' . $slug);
		}
	}
}


// add_filter( 'manage_edit-product_columns', 'show_product_order',15 );
// function show_product_order($columns){

//    //remove column
//    unset( $columns['tags'] );

//    //add column
//    $columns['offercode'] = __( 'Offer Code'); 

//    return $columns;
// }
// add_action('manage_product_posts_custom_column', 'edit_product_columns', 10, 2);

// function edit_product_columns($column, $postid) {
// 	if ($column == 'rank_math_seo_details') {
// 		echo get_post_meta($postid, 'offercode', true);
// 	}
// }

// $columns['cb']  
// $columns['thumb']
// $columns['name'] 
// $columns['sku'] 
// $columns['is_in_stock']
// $columns['price']
// $columns['product_cat'] 
// $columns['product_tag']
// $columns['featured']
// $columns['product_type']
// $columns['date']
add_filter('manage_edit-product_columns', 'change_columns_filter', 10, 1);
function change_columns_filter($columns) {
	unset($columns['product_tag']);
	// unset($columns['rank_math_seo_details']);
	unset($columns['sku']);
	unset($columns['featured']);
	unset($columns['product_type']);
	return $columns;
}



// Update WooCommerce Flexslider options
// add_filter('woocommerce_single_product_carousel_options', 'ud_update_woo_flexslider_options');
function ud_update_woo_flexslider_options($options) {

	// $options['sync'] = '.flex-control-thumbs';

	// $options['animation'] = 'slide';
	// $options['animationLoop'] = true;

	// $options['controlNav'] = 'thumbnails';
	// // show arrows
	// $options['directionNav'] = true;
	// $options['animation'] = "slide";

	// autoplay (work with only slideshow too)
	// $options['slideshow'] = true;
	// $options['autoplay'] = true;

	// control par texte (boolean) ou bien par vignettes
	// $options['controlNav'] = true;
	// $options['controlNav'] = "thumbnails";

	// $options['mousewheel'] = true;
	// $columns = 5; // change this to 2, 3, 5, etc. Default is 4.
	// $wrapper_classes[2] = 'woocommerce-product-gallery--columns-' . absint($columns);

	// return $options;
	// show arrows
	$options['directionNav'] = true;
	// $options['animation'] = "slide";

	// infinite loop
	// $options['animationLoop'] = true;

	// autoplay (work with only slideshow too)
	// $options['slideshow'] = false;
	// $options['autoplay'] = false;

	// control par texte (boolean) ou bien par vignettes
	// $options['controlNav'] = true;
	// $options['controlNav'] = "thumbnails";

	// $options['mousewheel'] = true;

	// $options['itemWidth'] = 350;
	// $options['itemHeight'] = 350;

	$options['prevText'] = '<i class="fal fa-arrow-right"></i>';
	$options['nextText'] = '<i class="fal fa-arrow-left"></i>';

	return $options;
}

remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
remove_action('woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20);


// add_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_thumbnails', 20);
