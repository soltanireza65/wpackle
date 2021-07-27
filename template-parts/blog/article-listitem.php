<article id="post-<?php the_ID(); ?>" <?php post_class(' px-0 blog-article-listitem'); ?>>
    <div class="image-wrapper">
        <?php
        _themename_post_thumbnail();
        ?>
    </div>
    <div class="content-wrapper d-flex flex-column justify-content-between">
        <div class="title">
            <a class="blog-article-listitem--inner" rel="bookmark" href="<?php echo esc_url(get_permalink()) ?>">
                <h2 class="entry-title text-right">
                    <?php echo get_the_title() ?>
                </h2>
            </a>
        </div>
        <p class="excerpt text-right">
            <?php echo wp_trim_words(get_the_content(), 36) ?>
        </p>

        <div class="info">
            <?php
            ?>
            <ul class="d-flex align-items-center">
                <?php _themename_posted_by(); ?>
                <?php _themename_posted_on(); ?>
                <?php _themename_post_categories(); ?>
            </ul>
        </div>

    </div>
</article>