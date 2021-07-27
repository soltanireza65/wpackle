<?php

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}


class ProductCarouselOnSaleWidget extends Widget_Base {

    public function get_name() {
        return 'product_carousel_on_sale';
    }
    public function get_title() {
        return 'اسلایدر محصولات با تخفیف';
    }
    public function get_icon() {
        return 'eicon-carousel';
    }
    public function get_categories() {
        return ['pypracts'];
    }
    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => 'کوئری',
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'categories',
            [
                'label'    => __('دسته بندی (ها)', 'plugin-domain'),
                'type'     => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => _themename_product_cat_list(),
                'default'  => ['all']

            ]
        );
        $this->add_control(
            'image',
            [
                'label' => __('تصویر اسلایدر', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        if ($settings['categories']) {
            $args = [
                'posts_per_page' => 15,
                'post_type'      => 'product',
                'post_status'    => 'publish',
                'ignore_sticky_posts'   => 1,
                'meta_query'        => WC()->query->get_meta_query(),
                'post__in'          => array_merge(array(0), wc_get_product_ids_on_sale()),
                'tax_query'      => [
                    [
                        'taxonomy' => 'product_cat',
                        'field'    => 'slug',
                        // 'field'    => 'term_id',
                        'terms'    => $settings['categories'],
                    ],
                ],
            ];
            $q = new WP_Query($args);
?>
            <div class="container bg-white py-2 radius">
                <div class="row">
                    <div class="col-2 col-md-3 d-none d-md-block">
                        <?php
                        if ($settings['image']) { ?>
                            <div class="swiper-slide">
                                <a href="<?php echo get_permalink(wc_get_page_id('shop')) . '?onsale';  ?>" class="">
                                    <div class="app_card radius  text-center app_woo_onsale_widget_img_box">
                                        <img src="<?php echo $settings['image']['url'] ?>" class="app_woo_onsale_widget_img" style="object-fit: cover;" alt="">
                                    </div>
                                </a>
                            </div>
                        <?php }
                        ?>
                    </div>
                    <div class="col-10 col-md-9">
                        <div id="product-carousel-on-sale" class="product-carousel-on-sale overflow-hidden">
                            <div class="swiper-wrapper">
                                <?php
                                while ($q->have_posts()) : $q->the_post();
                                    global $product;
                                ?>
                                    <div class="swiper-slide">
                                        <?php wc_get_template_part('content', 'product'); ?>
                                    </div>
                                <?php
                                endwhile;
                                ?>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php

        }
        ?>
<?php

    }
}
