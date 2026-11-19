<?php
/**
 * Plugin Name: WP Lab AI
 * Description: A simple AI plugin for WordPress
 * Version: 1.0.2
 * Author: Mikalai
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

$plugin = new \WpLab\AI\Plugin(
    new \WpLab\AI\Admin\AdminPage(),
    new \WpLab\AI\Assets()
);

$plugin->run();