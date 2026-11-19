<?php

class Assets {
    public function register(): void {
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue' ] );
    }

    public function enqueue( string $hook ): void {
        if ( $hook !== 'toplevel_page_wp-lab-ai' ) {
            return;
        }

        wp_enqueue_style( 'wp-lab-ai', plugin_dir_url( __FILE__ ) . '../assets/css/style.css', [], '1.0.0' );
        wp_enqueue_script( 'wp-lab-ai', plugin_dir_url( __FILE__ ) . '../assets/js/main.js', [], '1.0.0', true );
    }
}