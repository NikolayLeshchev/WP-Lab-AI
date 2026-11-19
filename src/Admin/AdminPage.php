<?php

namespace WpLab\AI\Admin;
use WpLab\AI\Api\GroqClient;

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
?>
       <div class="wrap-ai-chat">
            <h1>AI Chat</h1>
            <p>This chat is your personal assistant. You can use it to generate or check content for your website.</p>

            <div class="fast-panel">
                <h2>Fast Actions</h2>
                <p>You can use this helpful buttons. If needed, you can edit the request in the field.</p>
                <div class="fast-buttons">
                    <button class="button-suggest-title">Suggest title</button>
                    <button class="button-generate-seo-description">Generate SEO-description</button>
                    <button class="button-summuraze-post">Summuraze post</button>
                    <button class="button-improve-text">Improve text</button>
                </div>
            </div>

            <form method="post" id="form-ai-chat">
                <textarea name="message" rows="5" placeholder="Enter your request here..."></textarea>
                <button type="submit" class="button button-primary">Send</button>
            </form>

            <?php if ( $response ) : ?>
                <div class="ai-response">
                    <h2>AI response:</h2>
                    <div class="ai-response__body"><?php echo nl2br( esc_html( $response ) ); ?></div>
                </div>
            <?php endif; ?>
        </div>

       <?php
        }
}