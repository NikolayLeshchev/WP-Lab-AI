<?php
/*
Plugin Name: WP Lab AI
Description: A simple AI plugin for WordPress
Version: 1.0.0
Author: Mikalai
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

require_once __DIR__ . '/includes/class-groq-client.php';
require_once __DIR__ . '/includes/class-admin-page.php';
require_once __DIR__ . '/includes/Assets.php';

class WpLabAi {
    public function run(): void {

        $adminPage = new AdminPage();
        $adminPage->register();
        $assets = new Assets();
        $assets->register();
    }
}

$wpLabAi = new WpLabAi();
$wpLabAi->run();