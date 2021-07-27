<?php


if (!defined('ABSPATH')) {
	exit;
}

if (!$notices) {
	return;
}

?>
<ul class="container radius woocommerce-error" role="alert">
	<?php foreach ($notices as $notice) : ?>
		<li <?php echo wc_get_notice_data_attr($notice); ?>>
			<?php echo wc_kses_notice($notice['notice']); ?>
		</li>
	<?php endforeach; ?>
</ul>