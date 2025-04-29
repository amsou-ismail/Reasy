let context = {
  ville_depart: null,
  ville_arrive: null
};

function toggleChat() {
  const box = document.getElementById('chatbot-box');
  box.style.display = box.style.display === 'none' ? 'flex' : 'none';
}

function sendMessage() {
  const input = document.getElementById('user-input');
  const messages = document.getElementById('chatbot-messages');
  const userText = input.value.trim();

  if (!userText) return;

  // Affiche message utilisateur
  messages.innerHTML += `<div class="bubble user"><strong>Vous:</strong> ${userText}</div>`;
  input.value = '';

  // Animation "..."
  messages.innerHTML += `<div class="bubble bot typing">...</div>`;

  // Envoie message + contexte
  fetch('chatbot.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: 'message=' + encodeURIComponent(userText) + '&context=' + encodeURIComponent(JSON.stringify(context))
  })
  .then(response => response.json())
  .then(data => {
    document.querySelector('.typing').remove();

    // Affiche la réponse du bot
    messages.innerHTML += `<div class="bubble bot"><strong>Bot:</strong> ${data.response}</div>`;

    // Met à jour le contexte avec les nouvelles valeurs
    if (data.context) {
      context = { ...context, ...data.context };
    }
  });
}
