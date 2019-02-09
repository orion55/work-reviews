<?php

class Work_Shortcode
{
    static $add_script;

    static function init()
    {
        add_shortcode('work-reviews', array(__CLASS__, 'work_func'));
        add_action('init', array(__CLASS__, 'register_script'));
        add_action('wp_footer', array(__CLASS__, 'js_variables'));
        add_action('wp_footer', array(__CLASS__, 'print_script'));
    }

    static function work_func($atts)
    {
        self::$add_script = true;

        $html = "
        <div id='work-reviews'>
        <h1>work-reviews</h1>
        </div>
        ";

        return $html;
    }

    static function register_script()
    {
        $url = plugin_dir_url(__FILE__);
        wp_register_style('work-css', plugin_dir_url(__FILE__) . 'assets/css/main.min.css', array(), time(), 'all');
        wp_register_script('work-js', plugin_dir_url(__FILE__) . 'assets/js/main.min.js', array('jquery'), time(), true);
    }

    static function print_script()
    {
        if (!self::$add_script) {
            return;
        }
        wp_enqueue_style('work-css');
        wp_print_scripts('work-js');
    }

    static function js_variables()
    {
        if (!self::$add_script) {
            return;
        }

        $variables = array(
            'plugin_dir_url' => plugin_dir_url(__FILE__),
            'url_ajax' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('myajax-nonce123')
        );
        echo('<script type="text/javascript">window.wp_data=' . json_encode($variables) . ';</script>');
    }
}