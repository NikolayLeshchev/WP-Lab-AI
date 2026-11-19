# WP Lab AI

A WordPress plugin that adds an **AI Chat** page in the admin and sends messages to the [Groq](https://groq.com) chat completions API.

- **Version:** 1.0.2
- **Author:** Mikalai
- **Requires:** WordPress with administrator access (`manage_options`), PHP, and [Composer](https://getcomposer.org/)

Classes live in the `WpLab\AI` namespace and are loaded with PSR-4 from `src/`.

## What it does

After activation, the plugin adds an **AI Chat** item to the WordPress admin menu. An administrator types a message, or fills it with a Fast Action, and the plugin posts it to Groq. The model reply is shown under the form.

The request uses:

- Endpoint: `https://api.groq.com/openai/v1/chat/completions`
- Model: `openai/gpt-oss-20b`
- System prompt: a content editor and SEO specialist that follows the user's instructions, respects character limits for titles and meta descriptions, and stays concise
- Temperature: `0.5`
- Max tokens: `500`

Styles and scripts load only on the AI Chat screen.

## Installation

1. Copy the `wp-lab-ai` folder into `wp-content/plugins/`.
2. In the plugin directory, install dependencies so Composer can generate the autoloader:

```bash
composer install --no-dev
```

3. In **Plugins**, activate **WP Lab AI**.
4. Create a `.env` file at `src/.env` (one level above `src/Api/GroqClient.php`).

`vendor/` is gitignored. The plugin loads `vendor/autoload.php` from `wp-lab-ai.php`, so the plugin will not start until Composer has been run.

## Configuration

`GroqClient` reads the API key from `src/.env` on each request. The file is listed in `.gitignore` and must not be committed.

```env
GROQ_API_KEY=your_groq_api_key
```

Get a key from the [Groq console](https://console.groq.com). If the key is missing or the file does not exist, the chat page shows `Error: API key not found`.

## Usage

1. Sign in as an administrator.
2. Open **AI Chat** in the admin menu.
3. Type a message, or use a Fast Action to insert a prompt into the field, then add your text.
4. Click **Send**.
5. The model reply appears under **AI response:**.

Fast Actions:

| Button | Prompt inserted |
| --- | --- |
| Suggest title | Five clickable, SEO-friendly titles for the text that follows |
| Generate SEO-description | A meta description of 150–160 characters |
| Summuraze post | A 2–3 paragraph summary |
| Improve text | A clearer, better structured version with grammar and style fixes |

Only users with the `manage_options` capability can open the page.

## File structure

```
wp-lab-ai/
├── wp-lab-ai.php              # Loads Composer and runs the plugin
├── composer.json              # PSR-4 autoload for WpLab\AI\
├── composer.lock
├── src/
│   ├── Plugin.php             # Registers the admin page and assets
│   ├── Assets.php             # Enqueues CSS and JS on the AI Chat screen
│   ├── Admin/
│   │   └── AdminPage.php      # Admin menu and chat form
│   └── Api/
│       └── GroqClient.php     # Loads GROQ_API_KEY and calls Groq
├── assets/
│   ├── css/
│   │   └── style.css          # AI Chat page styles
│   └── js/
│       └── main.js            # Fast Action buttons
├── vendor/                    # Composer autoload (not committed)
├── src/.env                   # Local API key (not committed)
├── .gitignore
└── README.md
```

## Errors

| Message | Cause |
| --- | --- |
| `Error: API key not found` | `src/.env` is missing or has no `GROQ_API_KEY` |
| `Error: …` | The HTTP request to Groq failed |
| `No response` | Groq returned a body without a message |
