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

class WpLabAi {
    public function run(): void {
        add_action( 'init', [ $this, 'testGroq' ] );
    }

    public function testGroq(): void {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        $client = new GroqClient();
        $response = $client->chat( 'Hello, how are you?' );

        // выводим в лог
        error_log( 'Groq response: ' . $response );

        // или временно выводим на экран (только для теста)
        if ( isset( $_GET['test_groq'] ) ) {
            wp_die( $response );
        }
    }
}

$wpLabAi = new WpLabAi();
$wpLabAi->run();