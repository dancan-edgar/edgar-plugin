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

    public $plugin;

    public function __construct()
    {
        $this->plugin = plugin_basename(__FILE__);
    }

    public function register(){
        add_action('admin_enqueue_scripts',array($this,'enqueue'));

        add_action('admin_menu',array($this,'add_admin_pages'));

        add_filter("plugin_action_links_$this->plugin",array($this,'settings_link'));
    }

    public function settings_link($links)
    {
        $settings_link = '<a href="admin.php?page=edgar_plugin">Settings</a>';

        array_push($links,$settings_link);

        return $links;

    }

    public function add_admin_pages()
    {
        add_menu_page('Edgar Plugin','Edgar','manage_options','edgar_plugin',array($this,'admin_index'),'dashicons-superhero-alt',110);
    }

    public function admin_index()
    {
        // Require Template
        require_once plugin_dir_path(__FILE__) . '/templates/admin.php';
    }

    function activate(){
        // Flush the rewrite rules
        flush_rewrite_rules();
    }

    function deactivate(){
        // Flush the rewrite rules
        flush_rewrite_rules();
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
    $edgarPlugin = new EdgarPlugin();
    $edgarPlugin->create_custom_post_type();
    $edgarPlugin->register();

}

//require_once plugin_dir_path(__FILE__) . '/inc/edgar_plugin_activate.php';
register_activation_hook(__FILE__,array($edgarPlugin,'activate'));


//require_once plugin_dir_path(__FILE__) . '/inc/edgar_plugin_deactivate.php';
register_deactivation_hook(__FILE__,array($edgarPlugin,'deactivate'));