<?php

/**
 * @package EdgarPlugin
 */

class EdgarPluginActivate {

    public static function activate() {
        // Flush the rewrite rules
        flush_rewrite_rules();
    }
}

