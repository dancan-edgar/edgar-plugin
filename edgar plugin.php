<?php
/**
 * @package EdgarPlugin
 * @author Ampeire Edgar
 * @license GPL v2 or later
 * @copyright 2022 Ampeire Edgar All rights reserved
 */
/*
 * Plugin Name: Edgar Plugin
 * Plugin URI: https://github.com/dancan-edgar/edgar-plugin.git
 * Description: This plugin allows you to integrate the EgoSMS into your Wordpress site.
 * Version: 1.0.0
 * Author: Ampeire Edgar
 * Author URI: https://github.com/dancan-edgar
 * Text Domain: edgar plugin
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/*
Edgar Plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Edgar Plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Edgar Plugin. If not, see https://www.gnu.org/licenses/old-licenses/gpl-2.0.html}.
*/

defined('ABSPATH') or die('You dont have access to this file');

if( ! function_exists('add_action')){
    die("You dont have access to this file");
}

class EdgarPlugin {

    public static function register(){
        add_action('admin_enqueue_scripts',array('EdgarPlugin','enqueue'));
    }

    function add_book_post_type(){
        register_post_type("basket",array('label'=>'Basket','public'=>true));
    }

    function create_custom_post_type(){
        add_action('init',array($this,'add_book_post_type'));
    }
    
    public static function enqueue(){
        wp_enqueue_style('my_plugin_style',plugins_url('/assets/style.css',__FILE__));
        wp_enqueue_script('my_plugin_style',plugins_url('/assets/script.js',__FILE__));
    }
}

if(class_exists('EdgarPlugin')){
//    $edgarPlugin = new EdgarPlugin();
//    $edgarPlugin->create_custom_post_type();
//    $edgarPlugin->register();

    EdgarPlugin::register();
}

require_once plugin_dir_path(__FILE__) . '/inc/edgar_plugin_activate.php';
register_activation_hook(__FILE__,array('EdgarPluginActivate','activate'));


require_once plugin_dir_path(__FILE__) . '/inc/edgar_plugin_deactivate.php';
register_deactivation_hook(__FILE__,array('EdgarPluginDeactivate','deactivate'));