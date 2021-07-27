<?php
get_header();
?>

<main id="primary" class="site-main">

	<?php
	if (have_posts()) :

		if (is_home() && !is_front_page()) :
		endif;

		while (have_posts()) :
			the_post();
			get_template_part('template-parts/content', get_post_type());

		endwhile;

	else :

		get_template_part('template-parts/content', 'none');

	endif;
	?>

</main>

<?php
get_footer();
