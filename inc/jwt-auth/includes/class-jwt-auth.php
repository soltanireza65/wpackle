<?php

class Jwt_Auth {
    
    protected $loader;
    protected $plugin_name;
    protected $version;

    public function __construct() {
        $this->plugin_name = 'jwt-auth';
        $this->version = '1.1.0';
        $this->load_dependencies();
        $this->set_locale();
        $this->define_public_hooks();
    }

    private function load_dependencies() {
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/vendor/autoload.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-jwt-auth-loader.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-jwt-auth-i18n.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-jwt-auth-public.php';
        $this->loader = new Jwt_Auth_Loader();
    }

    private function set_locale() {
        $plugin_i18n = new Jwt_Auth_i18n();
        $plugin_i18n->set_domain($this->get_plugin_name());
        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }
    private function define_public_hooks() {
        $plugin_public = new Jwt_Auth_Public($this->get_plugin_name(), $this->get_version());
        $this->loader->add_action('rest_api_init', $plugin_public, 'add_api_routes');
        $this->loader->add_filter('rest_api_init', $plugin_public, 'add_cors_support');
        $this->loader->add_filter('rest_pre_dispatch', $plugin_public, 'rest_pre_dispatch', 10, 2);
        $this->loader->add_filter('determine_current_user', $plugin_public, 'determine_current_user', 10);
    }

    public function run() {
        $this->loader->run();
    }

    public function get_plugin_name() {
        return $this->plugin_name;
    }

    public function get_loader() {
        return $this->loader;
    }

    public function get_version() {
        return $this->version;
    }
}
