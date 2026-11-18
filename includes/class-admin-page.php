<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class AdminPage {
    public function register(): void {
        add_action( 'admin_menu', [ $this, 'addMenuPage' ] );
    }

    public function addMenuPage(): void {
        add_menu_page(
            'AI Chat',
            'AI Chat',
            'manage_options',
            'wp-lab-ai',
            [ $this, 'renderAdminPage' ],
            'dashicons-admin-generic',
            100
        );
    }

    public function renderAdminPage(): void {
        $response = '';

        if ( isset( $_POST['message'] ) && ! empty( $_POST['message'] ) ) {
            $message = sanitize_textarea_field( $_POST['message'] );
            
            $groq = new GroqClient();
            $response = $groq->chat( $message );
        }

        echo '<div class="wrap">';
        echo '<h1>AI Chat</h1>';
        echo '<form method="post">';
        echo '<textarea name="message" rows="5" style="width:100%;"></textarea><br><br>';
        echo '<button type="submit" class="button button-primary">Send</button>';
        echo '</form>';
        echo '</div>';

        // response output
        if ( $response ) {
            echo '<h2>AI response:</h2>';
            echo '<div style="background:#fff; padding:15px; border:1px solid #ddd;">' . nl2br( esc_html( $response ) ) . '</div>';
        }

        echo '</div>';
        }
}