<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<!--		--><?php //the_title( '<h1 class="entry-title">', '</h1>' ); 
						?>
	</header>

	<?php _themename_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__('Pages:', '_themename'),
				'after'  => '</div>',
			)
		);
		?>
	</div>
</article>