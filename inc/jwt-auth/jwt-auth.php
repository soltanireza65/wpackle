<?php
if (!defined('WPINC')) {
    die;
}

require plugin_dir_path(__FILE__) . 'includes/class-jwt-auth.php';

function run_jwt_auth() {
    $plugin = new Jwt_Auth();
    $plugin->run();
}
run_jwt_auth();
