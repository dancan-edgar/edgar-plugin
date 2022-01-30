<?php

/**
 * @package EdgarPlugin
 */

class EdgarPluginDeactivate {

    public static function deactivate() {
        // Flush the rewrite rules
        flush_rewrite_rules();
    }
}
