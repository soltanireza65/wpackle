<?php
/**
 * Dokan Seller Single product tab Template
 *
 * @since 2.4
 *
 * @package dokan
 */
 
 
 if($author === false || $author->ID === null){
     return;
 }
?>

<h2><?php esc_html_e( 'Vendor Information', 'dokan-lite' ); ?></h2>
<div class="product-seller">
    <?php do_action( 'dokan_product_seller_tab_start', $author, $store_info ); ?>
    <div class="store-avatar">
        <?php
        echo get_avatar( $author->ID, 150, '', $author->display_name ); ?>
        <?php echo wp_kses_post( dokan_get_readable_seller_rating( $author->ID ) ); ?>
    </div>
<ul class="list-unstyled">
    <?php if ( !empty( $store_info['store_name'] ) ) { ?>
        <li class="store-name">
            <span><b><?php esc_html_e( 'Store Name:', 'dokan-lite' ); ?></b></span>
            <span class="details">
                <?php echo esc_html( $store_info['store_name'] ); ?>
            </span>
        </li>
    <?php } ?>

    <li class="seller-name">
        <span>
            <b><?php esc_html_e( 'Vendor:', 'dokan-lite' ); ?></b>
        </span>

        <span class="details">
            <?php printf( '<a href="%s">%s</a>', esc_url( dokan_get_store_url( $author->ID ) ), esc_attr( $author->display_name ) ); ?>
        </span>
    </li>
    <?php if ( !empty( $store_info['address'] ) ) { ?>
        <li class="store-address">
            <span><b><?php esc_html_e( 'Address:', 'dokan-lite' ); ?></b></span>
            <span class="details">
                <?php echo str_replace('<br />','، ', wp_kses_post( dokan_get_seller_address( $author->ID ) )); ?>
            </span>
        </li>
    <?php } ?>

    <li class="clearfix">
    </li>

</ul>

    <?php do_action( 'dokan_product_seller_tab_end', $author, $store_info ); ?>
</div>