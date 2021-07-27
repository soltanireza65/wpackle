<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

$active_tab = "login";
if (isset($_GET['register'])) {
	$active_tab = "register";
}
?>
<div class="text-center">
	<div class="my-3">
		<?php the_custom_logo(); ?>
	</div>

	<div class="_themename-userlogin mx-auto" id="customer_login">
		<?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>
			<ul class="nav nav-pills mb-3" id="myaccount-tab" role="tablist">
				<li class="nav-item login">
					<a class="d-flex justify-content-center align-items-center login nav-link<?php echo $active_tab == "login" ? " active" : "" ?>" id="login-tab" data-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true">
						<i class="fal fa-sign-in"></i>
						<!-- <span class="d-flex flex-column">
							<h5 class="title"><?php _e('ورود', '_themename'); ?></h5>
							<span class="sub-title"><?php _e('به', '_themename'); ?> <?php bloginfo('name'); ?></span>
						</span> -->
					</a>
				</li>
				<li class="nav-item reister">
					<a class="d-flex justify-content-center align-items-center reister nav-link<?php echo $active_tab == "register" ? " active" : "" ?>" id="register-tab" data-toggle="pill" href="#pills-register" role="tab" aria-controls="pills-register" aria-selected="false">
						<i class="fal fa-user-plus"></i>
						<!-- <span class="d-flex flex-column">
							<h5 class="title"><?php _e('ثبت نام', '_themename'); ?></h5>
							<span class="sub-title"><?php _e('در', '_themename'); ?> <?php bloginfo('name'); ?></span>
						</span> -->
					</a>
				</li>
			</ul>
			<div class="tab-content" id="myaccount-tabContent">
				<div class="_themename-card">
					<?php do_action('woocommerce_before_customer_login_form');  ?>
				</div>
				<div class="tab-pane fade<?php echo $active_tab == "login" ? " show active" : "" ?>" id="pills-login" role="tabpanel" aria-labelledby="login-tab">
					<div class="_themename-login-tab">
						<div class="_themename-card">

							<form class="woocommerce-form woocommerce-form-login login" method="post">

								<?php do_action('woocommerce_login_form_start'); ?>

								<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
									<label for="username"><?php esc_html_e('Username or email address', 'woocommerce'); ?></label>
									<input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="username" id="username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine 
																																																																								?>
								</p>
								<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-1">
									<label for="password"><?php esc_html_e('Password', 'woocommerce'); ?></label>
									<input class="woocommerce-Input woocommerce-Input--text input-text form-control" type="password" name="password" id="password" autocomplete="current-password" />
								</p>
								<p class="woocommerce-LostPassword lost_password">
									<a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Lost your password?', 'woocommerce'); ?></a>
								</p>

								<?php do_action('woocommerce_login_form'); ?>
								<p class="ns-checkbox">
									<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
									<label class="woocommerce-form__label woocommerce-form__label-for-checkbox" for="rememberme"><?php esc_html_e('Remember me', 'woocommerce'); ?></label>
								</p>

								<p class="form-row">
									<?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
									<button type="submit" class="woocommerce-Button button btn btn-primary w-100 btn-lg" name="login" value="<?php esc_attr_e('Log in', 'woocommerce'); ?>"><?php _e('ورود به', '_themename'); ?> <?php bloginfo('name'); ?></button>
								</p>

								<?php do_action('woocommerce_login_form_end'); ?>

							</form>
						</div>
					</div>
				</div>
				<div class="tab-pane fade<?php echo $active_tab == "register" ? " show active" : "" ?>" id="pills-register" role="tabpanel" aria-labelledby="pills-register">
					<div class="_themename-register-tab">
						<div class="_themename-card">
							<form method="post" class="woocommerce-form woocommerce-form-register register">

								<?php do_action('woocommerce_register_form_start'); ?>

								<?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>

									<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
										<label for="reg_username"><?php esc_html_e('Username', 'woocommerce'); ?></label>
										<input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="username" id="reg_username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine 
																																																																										?>
									</p>

								<?php endif; ?>

								<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
									<label for="reg_email"><?php esc_html_e('Email address', 'woocommerce'); ?></label>
									<input type="email" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="email" id="reg_email" autocomplete="email" value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine 
																																																																					?>
								</p>

								<?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>

									<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
										<label for="reg_password"><?php esc_html_e('Password', 'woocommerce'); ?></label>
										<input type="password" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="password" id="reg_password" autocomplete="new-password" />
									</p>

								<?php endif; ?>

								<?php do_action('woocommerce_register_form'); ?>

								<p class="woocommerce-FormRow form-row">
									<?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
									<button type="submit" class="woocommerce-Button button btn btn-primary w-100 btn-lg" name="register" value="<?php esc_attr_e('Register', 'woocommerce'); ?>"><?php _e('ثبت نام در', '_themename'); ?> <?php bloginfo('name'); ?></button>
								</p>

								<?php do_action('woocommerce_register_form_end'); ?>

							</form>
						</div>
					</div>
				</div>
				<div class="_themename-card">
					<?php do_action('woocommerce_after_customer_login_form'); ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>