
const API_KEY = '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';
const API_URL = 'https://api.openai.com/v1/chat/completions';

const form = document.getElementById('chat-form');
const userInput = document.getElementById('user-input');
const chatContainer = document.getElementById('chat-container');

form.addEventListener('submit', async (e) => {
  e.preventDefault();
  const userMessage = userInput.value.trim();

  if (userMessage) {
    try {
      const response = await fetch(API_URL, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${API_KEY}`
        },
        body: JSON.stringify({
          messages: [
            { role: 'system', content: 'You are a helpful assistant.' },
            { role: 'user', content: userMessage }
          ]
        })
      });

      if (response.ok) {
        const data = await response.json();
        const chatResponse = data.choices[0].message.content;
        displayChat(userMessage, chatResponse);
      } else {
        displayChat(userMessage, 'Error: Unable to process your request.');
      }
    } catch (error) {
      console.error(error);
      displayChat(userMessage, 'Error: Unable to process your request.');
    }

    userInput.value = '';
  }
});

function displayChat(userMessage, chatResponse) {
  const userMessageElement = document.createElement('p');
  userMessageElement.textContent = `User: ${userMessage}`;

  const chatResponseElement = document.createElement('p');
  chatResponseElement.textContent = `ChatGPT: ${chatResponse}`;

  chatContainer.appendChild(userMessageElement);
  chatContainer.appendChild(chatResponseElement);
  chatContainer.scrollTop = chatContainer.scrollHeight;
}
