<?php



defined('ABSPATH') || exit;
get_header('shop');
/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
// do_action('woocommerce_before_main_content');
?>

<div class="container">
    <div class="row">
        <!-- BreadCrumb -->
        <header class="col-12 woocommerce-products-header">
            <?php woocommerce_breadcrumb(); ?>
        </header>

        <!-- sidebar  d-none d-lg-block -->
        <section class="sidebar d-none d-lg-block col-3">
            <?php do_action('woocommerce_sidebar'); ?>
        </section>

        <!-- main -->
        <section class="main col-md-12 col-lg-9">
            <div class="row m-0">
                <!-- Sort -->

                <div class="col p-0 mb-3 product_sorting_panel">
                    <div class="bg-white text-right p-3 radius">
                        <h1 class="text-secondary p-2 font-weight-bold h6">
                            آرشیو محصولات
                        </h1>
                        <div class="d-flex justify-content-between flex-column flex-md-row">
                            <ul class="d-flex product_sorting_options">
                                <p class="product_sorting_title mx-2 font-weight-bold d-none d-md-block">مرتب سازس
                                    بر اساس:</p>

                                <li class="d-inline-block">
                                    <a class="px-2 d-block" href="?orderby=date">
                                        <p class="d-inline-block">جدید
                                            ترین</p>
                                    </a>
                                </li>
                                <li>
                                    <a class="px-2" href="?orderby=popularity">محبوبترین</a>
                                </li>
                                <li>
                                    <a class="px-2" href="?orderby=price">ارزان ترین</a>
                                </li>
                                <li>
                                    <a class="px-2" href="?orderby=price-desc">گران ترین</a>
                            </ul>
                            <div class="top_pagination d-flex justify-content-end">
                                <?php woocommerce_pagination(); ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <?php
            if (woocommerce_product_loop()) {
                do_action('woocommerce_before_shop_loop');

                woocommerce_product_loop_start();

                if (wc_get_loop_prop('total')) {
                    // $args = array(
                    //     'post_type'      => 'product',
                    //     'meta_query'     => array(
                    //         'relation' => 'OR',
                    //         array( // Simple products type
                    //             'key'           => '_sale_price',
                    //             'value'         => 0,
                    //             'compare'       => '>',
                    //             'type'          => 'numeric'
                    //         ),
                    //         array( // Variable products type
                    //             'key'           => '_min_variation_sale_price',
                    //             'value'         => 0,
                    //             'compare'       => '>',
                    //             'type'          => 'numeric'
                    //         )
                    //     )
                    // );

                    // query_posts($args);
                    while (have_posts()) {
                        the_post();

                        /**
                         * Hook: woocommerce_shop_loop.
                         */
                        do_action('woocommerce_shop_loop');

                        wc_get_template_part('content', 'product');
                    }
                }

                woocommerce_product_loop_end();

                /**
                 * Hook: woocommerce_after_shop_loop.
                 *
                 * @hooked woocommerce_pagination - 10
                 */
                do_action('woocommerce_after_shop_loop');
            } else {
                do_action('woocommerce_no_products_found');
                //						echo 'محصولی یافت نشد';

                //					
            ?>
                <!---->
                <!--                    <div class="d-block">-->
                <!--                        محصولی یافت نشد-->
                <!--                    </div>-->
                <!--					--><?php
                                        }
                                            ?>


        </section>
    </div>
</div>

<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');
?>
<?php get_footer('shop');
