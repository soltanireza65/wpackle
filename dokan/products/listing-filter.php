<?php
/**
 * Dokan Dashboard Product Listing
 * filter template
 *
 * @since 2.4
 *
 * @package dokan
 */

$get_data  = wp_unslash( $_GET );
$post_data = wp_unslash( $_POST );

do_action( 'dokan_product_listing_filter_before_form' );
?>

    <form class="dokan-form-inline dokan-w6 dokan-product-date-filter" method="get" >

        <div class="dokan-form-group">
            <?php dokan_product_listing_filter_months_dropdown( dokan_get_current_user_id() ); ?>
        </div>

        <div class="dokan-form-group">
            <?php
                wp_dropdown_categories( array(
                    'show_option_none' => __( '- Select a category -', 'dokan-lite' ),
                    'hierarchical'     => 1,
                    'hide_empty'       => 0,
                    'name'             => 'product_cat',
                    'id'               => 'product_cat',
                    'taxonomy'         => 'product_cat',
                    'title_li'         => '',
                    'class'            => 'product_cat form-control chosen',
                    'exclude'          => '',
                    'selected'         => isset( $get_data['product_cat'] ) ? $get_data['product_cat'] : '-1',
                ) );
            ?>
        </div>

        <?php
        if ( isset( $get_data['product_search_name'] ) ) { ?>
            <input type="hidden" name="product_search_name" value="<?php echo esc_attr( $get_data['product_search_name'] ); ?>">
        <?php }
        ?>

        <button type="submit" name="product_listing_filter" value="ok" class="btn btn-primary"><?php esc_html_e( 'Filter', 'dokan-lite'); ?></button>

    </form>

    <?php do_action( 'dokan_product_listing_filter_before_search_form' ); ?>

    <form method="get" class="dokan-form-inline dokan-w6 dokan-product-search-form">

        <?php wp_nonce_field( 'dokan_product_search', 'dokan_product_search_nonce' ); ?>

        <div class="input-group">
            <input type="text" class="form-control" name="product_search_name" placeholder="<?php esc_html_e( 'Search Products', 'dokan-lite' ) ?>" value="<?php echo isset( $get_data['product_search_name'] ) ? esc_attr( $get_data['product_search_name'] ) : '' ?>">
            <div class="input-group-append">
                <button type="submit" name="product_listing_search" value="ok" class="btn btn-primary"><?php esc_html_e( 'Search', 'dokan-lite' ); ?></button>
            </div>
        </div>


        <?php
        if ( isset( $get_data['product_cat'] ) ) { ?>
            <input type="hidden" name="product_cat" value="<?php echo esc_attr( $get_data['product_cat'] ); ?>">
        <?php }

        if ( isset( $get_data['date'] ) ) { ?>
            <input type="hidden" name="date" value="<?php echo esc_attr( $get_data['date'] ); ?>">
        <?php }
        ?>
    </form>

    <?php do_action( 'dokan_product_listing_filter_after_form' ); ?>
