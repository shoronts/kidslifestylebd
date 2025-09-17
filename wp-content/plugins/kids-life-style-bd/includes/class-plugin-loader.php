<?php

namespace KidsLifeStyleBD;

use Elementor\Plugin as ElementorPlugin;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

final class Plugin_Loader
{
    const MIN_ELEMENTOR_VERSION = '3.0.0';
    const MIN_PHP_VERSION       = '8.2.4';

    public static function init()
    {
        $instance = new self();

        add_action('init', [$instance, 'load_textdomain']);
        add_action('plugins_loaded', [$instance, 'on_plugins_loaded']);
    }

    public function load_textdomain()
    {
        load_plugin_textdomain('kidslifestylebd');
    }

    public function on_plugins_loaded()
    {
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'missing_elementor_notice']);
            return;
        }

        if (version_compare(ELEMENTOR_VERSION, self::MIN_ELEMENTOR_VERSION, '<')) {
            add_action('admin_notices', [$this, 'min_elementor_version_notice']);
            return;
        }

        if (version_compare(PHP_VERSION, self::MIN_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'min_php_version_notice']);
            return;
        }

        $this->register_hooks();
    }

    private function register_hooks()
    {
        add_action('elementor/elements/categories_registered', [$this, 'register_category']);
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
    }

    public function register_category($elements_manager)
    {
        $categories = [];
        $categories['kids_life_style_bd'] =
        [
            'title' => 'Kids Life Style BD',
            'icon'  => 'eicon-banner'
        ];

        $all_categories = array_merge($categories, $elements_manager->get_categories());

        $set_categories = function ($categories) use ($elements_manager) {
            $elements_manager->categories = $categories;
        };
        $set_categories->call($elements_manager, $all_categories);
    }


    public function register_widgets()
    {
        foreach (glob(KIDS_LIFE_STYLE_BD_WIDGETS_PATH . '/*.php') as $file) {
            require_once $file;
        }

        foreach (get_declared_classes() as $class) {
            if (
                is_subclass_of($class, \Elementor\Widget_Base::class) &&
                strpos($class, 'KidsLifeStyleBD\\Widgets\\') === 0
            ) {
                \Elementor\Plugin::instance()->widgets_manager->register(new $class());
            }
        }
    }


    // Admin Notices
    public function missing_elementor_notice()
    {
        $this->render_admin_notice(
            esc_html__('Kids Life Style BD Core requires Elementor to be installed and activated.', 'kidslifestylebd')
        );
    }

    public function min_elementor_version_notice()
    {
        $this->render_admin_notice(
            sprintf(
                esc_html__('Kids Life Style BD Core requires Elementor version %s or greater.', 'kidslifestylebd'),
                self::MIN_ELEMENTOR_VERSION
            )
        );
    }

    public function min_php_version_notice()
    {
        $this->render_admin_notice(
            sprintf(
                esc_html__('Kids Life Style BD Core requires PHP version %s or greater.', 'kidslifestylebd'),
                self::MIN_PHP_VERSION
            )
        );
    }

    private function render_admin_notice($message)
    {
        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }
        printf('<div class="notice notice-warning is-dismissible"><p>%s</p></div>', $message);
    }
}
