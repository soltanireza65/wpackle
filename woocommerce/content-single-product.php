<?php


defined('ABSPATH') || exit;

global $product;


do_action('woocommerce_before_single_product');
//woocommerce_output_all_notices();
if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}

$meta = get_post_meta(get_the_ID(), '_prefix_product_options', true);

?>



<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>
    <section class="container bg-white radius my-4 app_woo_single_product">
        <div>
            <div class="row">
                <div class="col-md-4 app_woo_single_product_col_4">
                    <div class="app_woo_product_thumb_icons d-flex justify-content-start text-secondary mt-0">
                        <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
                        <div class="woocommerce product compare-button">
                            <a href="<?php echo get_site_url(); ?>?action=yith-woocompare-add-product&amp;id=<?php echo get_the_ID() ?>" class="compare button pt-0" data-product_id="<?php echo get_the_ID() ?>" rel="nofollow">
                                <i class="fas fa-random"></i>
                            </a>
                        </div>
                    </div>
                    <?php do_action('woocommerce_before_single_product_summary');  ?>
                    <?php
                    $image_links = $product->get_gallery_image_ids();
                    ?>
                    <div id="product-galley" class="product-galley">
                        <ul class="slides">
                            <li>
                                <img src="<?php echo get_the_post_thumbnail_url() ?>" id="image" class="zoom" data-magnify-src="<?php echo get_the_post_thumbnail_url() ?>">
                            </li>
                            <?php
                            foreach ($image_links as $attachment_id) { ?>
                                <li>
                                    <img src="<?php echo wp_get_attachment_url($attachment_id) ?>" id="image" class="zoom" data-magnify-src="<?php echo wp_get_attachment_url($attachment_id) ?>">
                                </li>
                            <?php  }
                            ?>
                        </ul>
                    </div>
                    <?php
                    if (count($image_links) < 2) { ?>
                        <style>
                            .product-galley .flex-direction-nav {
                                display: none;
                            }
                        </style>
                    <?php  }
                    if (count($image_links) > 1) { ?>
                        <div id="product-galley-thumbs" class="product-galley-thumbs">
                            <ul class="slides">
                                <li>
                                    <img src="<?php echo get_the_post_thumbnail_url() ?>" />
                                </li>
                                <?php
                                foreach ($image_links as $attachment_id) { ?>
                                    <li>
                                        <img src="<?php echo wp_get_attachment_url($attachment_id) ?>" />
                                    </li>
                                <?php  }
                                ?>
                            </ul>
                        </div>
                    <?php }
                    ?>


                </div>
                <div class="col-md-5 app_woo_single_product_col_4">
                    <div class="d-inline-block text-right float-right product_meta_wraper">
                        <?php
                        woocommerce_template_single_title();
                        ?>
                        <?php

                        if ($meta && $meta['opt_en_title']) { ?>
                            <div class="opt_en_title  ">
                                <h2 class="m-0 text-info"><?php echo $meta['opt_en_title']; ?></h2>
                            </div>
                        <?php }
                        ?>


                        <?php
                        if ($meta && $meta['opt_time_arival']) { ?>
                            <div class="opt_time_arival my-2 d-inline-block">
                                <h2 class="m-0"><?php echo $meta['opt_time_arival']; ?></h2>
                            </div>
                        <?php }
                        ?>


                        <?php
                        ?>
                        <div class="d-flex justify-content-start mt-2 text-secondary font-weight-bold">
                            <p class="ml-2">شناسه محصول :</p>
                            <p> <?php echo $product->get_sku(); ?></p>

                        </div>
                        <?php
                        _themename_show_tags()
                        ?>
                        <?php

                        if ($meta) {
                            _themename_show_top_features();
                        }
                        ?>

                    </div>
                </div>
                <div class="col-md-3 app_woo_single_product_col_4">
                    <div class="px-3 py-4  radius mt-2" style="background-color: #F4F4F8;">
                        <div class="d-flex justify-content-between text-secondary font-weight-bold">
                            <p class="">فروشنده:</p>
                            <a href="<?php echo site_url(); ?>/store/<?php echo get_the_author_meta('user_login'); ?>">
                                <?php the_author(); ?>

                            </a>
                        </div>
                        <hr class="m-0" />

                        <div class="d-flex justify-content-between mt-2 text-secondary font-weight-bold">
                            <p>شناسه محصول</p>
                            <?php echo $product->get_sku(); ?>
                        </div>
                        <hr class="m-0" />
                        <?php woocommerce_template_single_price(); ?>
                        <div class="d-flex justify-content-end mt-3">
                            <?php woocommerce_template_single_add_to_cart(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container bg-white  my-4 app_woo_product_short_desc">
        <div>
            <div class="row">
                <div class="text-right bg-white p-3 w-100">
                    <h6 class="text-danger">معرفی کوتاه</h6>
                    <?php woocommerce_template_single_excerpt(); ?>
                </div>
            </div>
        </div>
    </section>
    <section class="tabs container bg-white px-0 my-4">
        <div class="container">
            <div class="row">
                <?php woocommerce_output_product_data_tabs(); ?>
            </div>
        </div>
    </section>
    <section class="container bg-white radius my-4">
        <div class="container">
            <div class="row">
                <?php woocommerce_upsell_display(); ?>
            </div>
        </div>
    </section>


    <?php


    global $post;
    $related = get_posts(
        array(
            'category__in' => wp_get_post_categories($post->ID),
            'numberposts'  => 4,
            'post__not_in' => array($post->ID),
            'post_type'    => 'product'
        )
    );
    if ($related) {
    ?>
        <section class="container bg-white radius my-4">
            <div class="container">
                <div class="row related_products radius">
                    <?php woocommerce_output_related_products(); ?>
                </div>
            </div>
        </section>
    <?php
    }
    ?>


</div>

<?php do_action('woocommerce_after_single_product'); ?>