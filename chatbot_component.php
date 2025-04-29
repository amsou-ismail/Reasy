<!-- chatbot_component.php -->
<!-- Bulle du chatbot -->
<link rel="stylesheet" href="chatbot.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div id="chatbot-toggle" onclick="toggleChat()">
  <i class="bi bi-chat-right-text" style="font-size: 2rem; color: #ff0000;"></i>
</div>

<!-- Fenêtre de chat -->
<div id="chatbot-box">
  <div id="chatbot-header">Assistant réservation</div>
  <div id="chatbot-messages"></div>
  <div id="chatbot-input">
    <input type="text" id="user-input" placeholder="Posez votre question..." onkeydown="if(event.key === 'Enter') sendMessage()">
    <button onclick="sendMessage()">Envoyer</button>
  </div>
</div>

<script src="chatbot.js"></script>
