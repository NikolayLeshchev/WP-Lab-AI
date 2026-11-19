<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class GroqClient {
    private string $apiKey = '';
    private string $model = 'openai/gpt-oss-20b';

    public function __construct() {
        $this->loadApiKey();
    }

    private function loadApiKey(): void {
        $envPath = __DIR__ . '/../.env';

        if ( ! file_exists( $envPath ) ) {
            return;
        }

        $lines = file( $envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );

        foreach ( $lines as $line ) {
            $line = trim( $line );
            if ( str_starts_with( $line, '#' ) || ! str_contains( $line, '=' ) ) {
                continue;
            }

            [ $key, $value ] = explode( '=', $line, 2 );
            $key   = trim( $key );
            $value = trim( $value, " \t\"'" );

            if ( $key === 'GROQ_API_KEY' ) {
                $this->apiKey = $value;
                break;
            }
        }
    }

    public function chat( string $message ): string {
        if ( empty( $this->apiKey ) ) {
            return 'Error: API key not found';
        }

        $response = wp_remote_post( 'https://api.groq.com/openai/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type'  => 'application/json',
            ],
            'body' => wp_json_encode( [
                'model'    => $this->model,
                'messages' => [
                    [
                        'role'    => 'system',
                        'content' => 'You are an experienced content editor and SEO specialist. You help content managers write clear, engaging, and SEO-friendly texts. Always follow the user\'s instructions precisely. When generating titles or meta descriptions, respect character limits. Be concise and practical.',
                    ],
                    [
                        'role'    => 'user',
                        'content' => $message,
                    ],
                ],
                'temperature' => 0.5,
                'max_tokens'  => 500,
            ] ),
            'timeout' => 30,
        ] );

        if ( is_wp_error( $response ) ) {
            return 'Error: ' . $response->get_error_message();
        }

        $body = json_decode( wp_remote_retrieve_body( $response ), true );

        return $body['choices'][0]['message']['content'] ?? 'No response';
    }
}