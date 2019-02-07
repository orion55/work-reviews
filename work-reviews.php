<?php

/*
Plugin Name: Work Reviews
Plugin URI: http://portfolio.infoblog72.ru/
Description: Плагин "Отзывы о работе".
Version: 1.0
Author: Grebenev Oleg
Author URI: http://portfolio.infoblog72.ru/
License: GPL2
*/

defined('ABSPATH') or die('Nope, not accessing this');

require plugin_dir_path(__FILE__) . 'inc/post-type.php';
require plugin_dir_path(__FILE__) . 'shortcode/class-work-shortcode.php';

$shortcode = new Work_Shortcode();
$shortcode->init();