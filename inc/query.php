<?php
function get_posts_by_slug($post_type = 'post', $posts_per_page = '6', $taxonomy = 'category', $slug = 'top') {
    $args = array(
        'post_type' => $post_type,
        'posts_per_page' => $posts_per_page,
        'tax_query' => [
            [
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $slug
            ]
        ]
    );
    return new WP_Query($args);
}
