<?php

    /**
     * Trigger this file on Plugin uninstall
     * @package EdgarPlugin
     */

    if( !defined('WP_UNINSTALL_PLUGIN')){
        die;
    }


    global $wpdb;

    $wpdb->query('DELETE FROM wp_posts WHERE post_type="book"');
