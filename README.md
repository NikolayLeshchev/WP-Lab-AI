# WP Lab AI

A WordPress plugin that adds an **AI Chat** page in the admin and sends messages to the [Groq](https://groq.com) chat completions API.

## What it does

After activation, the plugin adds an **AI Chat** item to the WordPress admin menu. An administrator types a message, submits the form, and the plugin posts it to Groq. The model reply is shown under the form.

The request uses:

- Endpoint: `https://api.groq.com/openai/v1/chat/completions`
- Model: `openai/gpt-oss-20b`
- Temperature: `0.7`
- Max tokens: `500`

## Installation

1. Copy the `wp-lab-ai` folder into `wp-content/plugins/`.
2. In **Plugins**, activate **WP Lab AI**.
3. Create a `.env` file in the plugin root (next to `wp-lab-ai.php`).

## Configuration

The API key is read from `.env` on each request. The file is listed in `.gitignore` and must not be committed.

```env
GROQ_API_KEY=your_groq_api_key
```

Get a key from the [Groq console](https://console.groq.com). If the key is missing or the file does not exist, the chat page shows `Error: API key not found`.

## Usage

1. Sign in as an administrator.
2. Open **AI Chat** in the admin menu.
3. Type a message and click **Send**.
4. The model reply appears under **AI response:**.

## File structure

```
wp-lab-ai/
├── wp-lab-ai.php                 # Plugin bootstrap
├── includes/
│   ├── class-admin-page.php      # Admin menu and chat form
│   └── class-groq-client.php     # Loads GROQ_API_KEY and calls Groq
├── .env                          # Local API key (not committed)
└── .gitignore
```

## Errors

| Message | Cause |
| --- | --- |
| `Error: API key not found` | `.env` is missing or has no `GROQ_API_KEY` |
| `Error: …` | The HTTP request to Groq failed |
| `No response` | Groq returned a body without a message |
