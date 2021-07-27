<article id="post-<?php the_ID(); ?>" <?php post_class(' px-0 blog-article-single'); ?>>
    <div class="image-wrapper">
        <?php _themename_post_thumbnail(); ?>
    </div>
    <div class="content-wrapper ">
        <a class="blog-article-listitem--inner" rel="bookmark" href="<?php echo esc_url(get_permalink()) ?>">
            <h1 class="entry-title text-right">
                <?php echo get_the_title() ?>
            </h1>
        </a>
        <p class="post-content excerpt text-right"><?php echo get_the_content() ?></p>
        <div class="tags">
            <span>برچسب‌ها:</span>
            <?php the_tags('', ', ', '') ?>
        </div>
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
<?php
if (comments_open() || get_comments_number()) :
    echo '<div class="post-comments post-wg">';
    comments_template();
    echo '</div>';
endif;
?>