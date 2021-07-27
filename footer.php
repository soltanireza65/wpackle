<footer class="page-footer font-small bg-gray pt-4 mt-5 position-relative">
    <div class="d-none d-md-flex justify-content-around container pt-3 pb-5">
        <div class="d-flex align-items-center w-100">
            <img src="<?php echo get_theme_file_uri('/assets/images/svg/express.svg') ?>" alt="">
            <div class="pr-3 text-right d-none d-md-block">
                <p class="m-0">تحویل اکسپرس</p>
                <p class="m-0 text-muted">در کمترین زمان</p>
            </div>
        </div>
        <div class="d-flex align-items-center w-100">
            <img src="<?php echo get_theme_file_uri('/assets/images/svg/support.svg') ?>" alt="">
            <div class="pr-3 text-right d-none d-md-block">
                <p class="m-0">پشتیبانی ۲۴ ساعته</p>
                <p class="m-0 text-muted">پشتیبانی هفت روز هفته</p>
            </div>
        </div>
        <div class="d-flex align-items-center w-100">
            <img src="<?php echo get_theme_file_uri('/assets/images/svg/wallet.svg') ?>" alt="">
            <div class="pr-3 text-right d-none d-md-block">
                <p class="m-0">کیف پول الکترونیکی</p>
                <p class="m-0 text-muted">برای خرید آسانتر</p>
            </div>
        </div>
        <div class="d-flex align-items-center w-100">
            <img src="<?php echo get_theme_file_uri('/assets/images/svg/return7.svg') ?>" alt="">
            <div class="pr-3 text-right d-none d-md-block">
                <p class="m-0">۷ روز ضمانت بازگشت</p>
                <p class="m-0 text-muted">هفت روز مهلت دارید</p>
            </div>
        </div>
        <div class="d-flex align-items-center w-100 text-center">
            <img src="<?php echo get_theme_file_uri('/assets/images/svg/warranty.svg') ?>" alt="">
            <div class="pr-3 text-right d-none d-md-block">
                <p class="m-0">ضمانت اصل‌بودن کالا</p>
                <p class="m-0 text-muted">تایید اصالت کالا</p>
            </div>
        </div>
    </div>
    <div class="container text-center text-md-left ">
        <div class="row">
            <div class="col-md-4 mx-auto text-right  d-none d-md-block">
                <?php if (has_custom_logo()) : ?>
                    <div class="site-logo"><?php the_custom_logo(); ?></div>
                <?php endif; ?>
                <h6 class="font-weight-bold text-uppercase text-center text-md-right mt-3 mb-4 text-dark">
                    <?php echo bloginfo('name') ?> را در شبکه های اجتماعی دنبال کنید:
                </h6>
                <div class="d-flex justify-content-around justify-content-md-start app_footer_icons">
                    <a href="<?php echo get_theme_mod('instagram_url', 'https://www.instagram.com/') ?>"><i class="fab fa-instagram fa-2x ml-2"></i></a>
                    <a href="<?php echo get_theme_mod('telegram_url', 'https://www.telegram.com/') ?>"><i class="fab fa-telegram fa-2x ml-2"></i></a>
                    <a href="<?php echo get_theme_mod('twitter_url', 'https://www.twitter.com/') ?>"><i class="fab fa-twitter-square fa-2x"></i></a>
                </div>
            </div>
            <div class="col-md-4 mx-auto text-right  d-none d-md-block">
                <h6 class="font-weight-bold text-uppercase mt-3 mb-4">لینک های مفید</h6>
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer_1'
                ])
                ?>
            </div>

        </div>
    </div>
    <hr />
    <div class="footer-copyright text-center py-3">© 2020 <a href="http://pypracts.ir">PyPracts</a></div>
    </div>
</footer>
</div>
<?php wp_footer(); ?>
</body>

</html>