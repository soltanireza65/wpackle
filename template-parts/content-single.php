<div class="blog_page container">
    <div class="row blog_inner">

        <main id="primary" class="blog-main  col-9">
            <?php
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    get_template_part('template-parts/blog/article', 'single');
                }
            }
            wp_reset_postdata();
            ?>
        </main>
        <aside id="sidebar" class="sidebar col-3">
            <?php get_sidebar('blog'); ?>
        </aside>
        <div class="top-cards my-5 ">
            <?php
            $query = get_posts_by_slug('post', '6',  'category', 'top');
            if ($query->have_posts()) {
            ?>
                <div class="container">
                    <div id="topPostsCarousel" class="topPostsCarousel overflow-hidden">
                        <div class="swiper-wrapper">
                            <?php
                            while ($query->have_posts()) {
                                $query->the_post();
                                get_template_part('template-parts/blog/article', 'card');
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            wp_reset_postdata();
            ?>

        </div>
    </div>
</div>