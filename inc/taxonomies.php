<?php
add_action( 'init', 'wc_rest_custom_taxonomy', 0 );
function wc_rest_custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'برند ها', 'Taxonomy General Name', 'wc_rest' ),
		'singular_name'              => _x( 'برند', 'Taxonomy Singular Name', 'wc_rest' ),
		'menu_name'                  => __( 'برند', 'wc_rest' ),
		'all_items'                  => __( 'همه برند ها', 'wc_rest' ),
		'parent_item'                => __( 'Parent Brand', 'wc_rest' ),
		'parent_item_colon'          => __( 'Parent Brand:', 'wc_rest' ),
		'new_item_name'              => __( 'نام برند جدید', 'wc_rest' ),
		'add_new_item'               => __( 'افزودن برند جدید', 'wc_rest' ),
		'edit_item'                  => __( 'ویرایش برند', 'wc_rest' ),
		'update_item'                => __( 'بروزرسانی برند', 'wc_rest' ),
		'view_item'                  => __( 'مشاهده برند', 'wc_rest' ),
		'separate_items_with_commas' => __( 'برندها را با کاما جدا نمایید', 'wc_rest' ),
		'add_or_remove_items'        => __( 'Add or remove Brands', 'wc_rest' ),
		'choose_from_most_used'      => __( 'محبوبترین برند', 'wc_rest' ),
		'popular_items'              => __( 'محبوبترین برند ها', 'wc_rest' ),
		'search_items'               => __( 'جستجوی برند ها', 'wc_rest' ),
		'not_found'                  => __( 'یافت نشد', 'wc_rest' ),
		'no_terms'                   => __( 'No Brands', 'wc_rest' ),
		'items_list'                 => __( 'لیست برندها', 'wc_rest' ),
		'items_list_navigation'      => __( 'Brands list navigation', 'wc_rest' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		// 'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'show_in_rest'               => true,
	);
	register_taxonomy( 'brand', array( 'product' ), $args );

}
