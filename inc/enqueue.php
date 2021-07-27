<?php
function _themename_scripts() {
    wp_enqueue_style('_themename-fontawesome', get_template_directory_uri() . '/assets/fonts/fa/css/all.min.css', [], '1.0.0', 'all');
    wp_enqueue_style('_themename-fonts', get_template_directory_uri() . '/assets/fonts/fonts.css', [], '1.0.0', 'all');
    wp_enqueue_style('_themename-owl', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', [], '1.0.0', 'all');
    wp_enqueue_style('_themename-stylesheet', get_template_directory_uri() . '/dist/css/app.css', [], '1.0.0', 'all');

    // wp_enqueue_script('_themename-swiper', '//unpkg.com/swiper/swiper-bundle.min.js', ['jquery'], '1.0.0', true);
    // wp_enqueue_script('_themename-flexslider', '//cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/jquery.flexslider-min.js', ['jquery'], '1.0.0', true);
    wp_enqueue_script('_themename-mousewheel', '//cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js', ['jquery'], '1.0.0', true);
    wp_enqueue_script('_themename-popper', '//cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js', ['jquery'], '1.0.0', true);
    wp_enqueue_script('_themename-bootstrap', '//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js', ['jquery'], '1.0.0', true);
    // wp_enqueue_script('_themename-read', '/assets/scripts/readMoreJS.js', [], '1.0.0', true);
    wp_enqueue_script('_themename-script', get_template_directory_uri() . '/dist/app.js', ['jquery'], '1.0.0', true);
    // wp_enqueue_script('_themename_rest', get_template_directory_uri() . '/js/rest.js', ['jquery'], '1.0.0', true);

    // wp_localize_script('_themename_rest', 'WPsettings', [
    //     'root' => esc_url_raw(rest_url()),
    //     'nonce' => wp_create_nonce('wp_rest'),
    //     'current_ID' => get_the_ID()
    // ]);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', '_themename_scripts');


function _themename_admin_assets() {
    wp_enqueue_style('_themename-admin-stylesheet', get_template_directory_uri() . '/dist/assets/css/admin.css', [], '1.0.0', 'all');

    wp_enqueue_script('_themename-admin-scripts', get_template_directory_uri() . '/dist/assets/js/admin.js', ['jquery'], '1.0.0', true);
}
add_action('admin_enqueue_scripts', '_themename_admin_assets');
