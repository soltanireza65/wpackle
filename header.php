<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">


    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', '_themename'); ?></a>

        <?php
        // get_template_part('template-parts/header');
        $blog_info    = get_bloginfo('name');
        $description  = get_bloginfo('description', 'display');
        $show_title   = (true === get_theme_mod('display_title_and_tagline', true));
        $header_class = $show_title ? 'site-title' : 'screen-reader-text';
        ?>
        <header id="masthead" class="app_top_header site-header d-flex justify-content-around justify-content-lg-between container align-items-center">
            <div class="site-branding text-right d-flex align-items-center">
                <?php if (has_custom_logo()) : ?>
                    <div class="site-logo"><?php the_custom_logo(); ?></div>
                <?php endif; ?>
                <?php if ($blog_info) : ?>
                    <h1 class="site-title h6 mb-0 mr-2"><?php echo esc_html($blog_info); ?></h1>
                <?php endif; ?>
            </div>
            <div class="header_search_form_wraper">
                <?php
                echo do_shortcode('[fibosearch]');
                ?>
            </div>

            <div class="user_links d-flex position-relative">
                <div class="d-flex align-items-center p-0 px-1 text-secondary mr-auto">
                    <a class="ml-3" href="<?php echo get_site_url() . '/wishlist'; ?>">
                        <i class="fal fa-heart fontsize_17 icon-size-md circle_padding_white"></i>
                    </a>
                    <?php
                    if (function_exists('_themename_woocommerce_header_cart')) {
                        _themename_woocommerce_header_cart();
                    }
                    ?>
                    <div class="user_links_dropdown mr-3 ">
                        <a class="dropbtn"><i class="fal fa-user fontsize_17 circle_padding_white"></i></a>
                        <div class=" text-center overflow-hidden bg-white user_links_dropdown-content text-right border-0 radius app_auth_urls" aria-labelledby="dropdownMenuButton">

                            <?php if (is_user_logged_in()) : ?>
                                <?php
                                $myaccount_page_id = get_option('woocommerce_myaccount_page_id');
                                if ($myaccount_page_id) {
                                    $myaccount_page_url = get_permalink($myaccount_page_id);
                                }
                                ?>
                                <a class="dropdown-item" href="<?php echo $myaccount_page_url ?>">حساب کاربری</a>
                                <?php
                                $store_user = dokan()->vendor->get(get_query_var('author'));
                                // var_dump($store_user);
                                $user = wp_get_current_user();
                                if (in_array('seller', (array) $user->roles)) {
                                ?>
                                    <a class="dropdown-item seller_dash" href="<?php echo get_site_url() ?>/shop_proj/dashboard">پنل فروشندگان</a>
                                <?php
                                }
                                ?>
                                <?php wp_loginout(); ?>
                            <?php else : ?>
                                <a class="text-center dropdown-item" href="<?php echo get_site_url() ?>/shop_proj/my-account/">ورود/ ثبت نام</a>
                                <!-- <a class="dropdown-item" href="<?php echo get_site_url() ?>/shop_proj/my-account/?register">ثبت نام</a>
                                <a class="dropdown-item" href="<?php echo get_site_url() ?>/shop_proj/my-account/?register">ثبت نام</a> -->
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <header class="bg-light d-flex">
            <?php if (function_exists('max_mega_menu_is_enabled') && max_mega_menu_is_enabled('mega_menu')) : ?>
                <div class="container">
                    <?php wp_nav_menu(
                        [
                            'theme_location' => 'mega_menu',
                            'menu_class' => 'container',
                        ]
                    ); ?>
                </div>
            <?php else : ?>
                <nav id="site-navigation" class="main-navigation" role="navigation">
                    <button class="menu-toggle"><?php _e('Menu', 'kharidpack'); ?></button>
                    <?php wp_nav_menu([
                        'theme_location' => 'mega_menu',
                        'menu_class' => 'container',
                    ]);
                    ?>
                </nav>
            <?php endif; ?>
        </header>