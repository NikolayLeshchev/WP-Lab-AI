const AIChatRequest = document.getElementById('form-ai-chat');

document.querySelector('.button-suggest-title').addEventListener('click', () => {
    AIChatRequest.querySelector('textarea').value = 'Suggest 5 good, clickable and SEO-friendly titles for the following text:';
});
document.querySelector('.button-generate-seo-description').addEventListener('click', () => {
    AIChatRequest.querySelector('textarea').value = 'Write a compelling meta description (150-160 characters) for the following text. Include the main keyword naturally:';
});
document.querySelector('.button-summuraze-post').addEventListener('click', () => {
    AIChatRequest.querySelector('textarea').value = 'Summarize the following text in 2-3 short and clear paragraphs. Keep the main ideas:';
});
document.querySelector('.button-improve-text').addEventListener('click', () => {
    AIChatRequest.querySelector('textarea').value = 'Improve the following text. Make it clearer, more engaging and better structured. Fix grammar and style:';
});