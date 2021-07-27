<div class="blog_page container">
    <div class="row blog_inner">

        <main id="primary" class="blog-main  col-9">
            <header class="page-header">
                <i class="fal fa-folder"></i>
                <h1 class="page-title">
                    <span>دسته:</span>
                    <span><?php the_archive_title() ?></span>
                </h1>
            </header>
            <?php
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    get_template_part('template-parts/blog/article', 'listitem');
                }
                the_posts_navigation();
            }
            wp_reset_postdata();
            ?>
        </main>
        <aside id="sidebar" class="sidebar col-3">
            <?php get_sidebar('blog'); ?>
        </aside>
    </div>
</div>