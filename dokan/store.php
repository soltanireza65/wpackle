<?php

/**
 * The Template for displaying all single posts.
 *
 * @package dokan
 * @package dokan - 2014 1.0
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

$store_user   = dokan()->vendor->get(get_query_var('author'));
$store_info   = $store_user->get_shop_info();
$map_location = $store_user->get_location();
$social_fields = dokan_get_social_profile_fields();
get_header('shop');
?>
<?php do_action('woocommerce_before_main_content'); ?>
<div class="row container mx-auto">

    <div id="dokan-secondary" class="col-lg-3" role="complementary">
        <div class="dokan-widget-area widget-collapse">
            <?php do_action('dokan_sidebar_store_before', $store_user->data, $store_info); ?>
            <aside class="widget ns-store-avatar">
                <header class="store-avatar-header">
                    <div class="profile-img">
                        <?php echo get_avatar($store_user->get_id(), 150, '', $store_user->get_shop_name()); ?>
                    </div>
                </header>
                <footer class="store-avatar-footer">
                    <?php if (!empty($store_user->get_shop_name())) { ?>
                        <h1 class="store-name"><?php echo esc_html($store_user->get_shop_name()); ?></h1>
                    <?php } ?>
                    <time class="reg-date"><?php echo __('عضویت از ', 'negarshop') . human_time_diff(strtotime($store_user->get_register_date()), current_time('timestamp')) . __(' پیش', 'negarshop'); ?></time>
                    <p class="store-rating">
                        <?php
                        $rate = dokan_get_seller_rating($store_user->get_id());
                        $rate_percent = (is_numeric($rate['rating']) and $rate['rating'] > 0) ? ($rate['rating'] / 5) * 100 : 0;
                        echo '<span>' . $rate_percent . ' ' . __('٪ رضایت خرید', 'negarshop') . '</span>';
                        echo '| ' . $rate['count'] . __(' رای', 'negarshop');
                        ?>
                    </p>
                    <?php if ($social_fields) { ?>
                        <div class="store-social-wrapper">
                            <ul class="store-social">
                                <?php foreach ($social_fields as $key => $field) { ?>
                                    <?php if (!empty($social_info[$key])) { ?>
                                        <li>
                                            <a href="<?php echo esc_url($social_info[$key]); ?>" target="_blank"><i class="fa fa-<?php echo $field['icon']; ?>"></i></a>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>
                </footer>
            </aside>
            <?php
            $args = array(
                'before_widget' => '<aside class="widget">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            );

            if (class_exists('Dokan_Store_Location')) {
                the_widget('Dokan_Store_Category_Menu', array('title' => __('Store Category', 'dokan-lite')), $args);

                if (dokan_get_option('store_map', 'dokan_general', 'on') == 'on'  && !empty($map_location)) {
                    the_widget('Dokan_Store_Location', array('title' => __('Store Location', 'dokan-lite')), $args);
                }

                if (dokan_get_option('contact_seller', 'dokan_general', 'on') == 'on') {
                    the_widget('Dokan_Store_Contact_Form', array('title' => __('Contact Vendor', 'dokan-lite')), $args);
                }
            }

            ?>

            <?php do_action('dokan_sidebar_store_after', $store_user->data, $store_info); ?>
        </div>
    </div><!-- #secondary .widget-area -->

    <div id="dokan-primary" class="dokan-single-store col-lg">
        <div id="dokan-content" class="store-page-wrap woocommerce" role="main">

            <?php dokan_get_template_part('store-header'); ?>

            <?php do_action('dokan_store_profile_frame_after', $store_user->data, $store_info); ?>

            <?php if (have_posts()) { ?>

                <div class="seller-items">

                    <?php woocommerce_product_loop_start(); ?>

                    <?php while (have_posts()) : the_post(); ?>

                        <?php wc_get_template_part('content', 'product'); ?>

                    <?php endwhile; // end of the loop. 
                    ?>

                    <?php woocommerce_product_loop_end(); ?>

                </div>

                <?php dokan_content_nav('nav-below'); ?>

            <?php } else { ?>

                <p class="dokan-info"><?php _e('No products were found of this vendor!', 'dokan-lite'); ?></p>

            <?php } ?>
        </div>

    </div><!-- .dokan-single-store -->
</div>

<?php do_action('woocommerce_after_main_content'); ?>

<?php get_footer('shop'); ?>