<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blind Tools AI Chatbot</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: auto; text-align: center; background: #f5f5f5; }
        #chatbox { border: 1px solid #ccc; padding: 10px; height: 400px; overflow-y: auto; margin-bottom: 10px; background: #fff; border-radius: 5px; text-align: left; }
        .message { padding: 5px; margin: 5px 0; display: flex; justify-content: space-between; align-items: center; position: relative; }
        .user { color: blue; text-align: right; }
        .bot { color: green; text-align: left; }
        .options { cursor: pointer; font-size: 20px; padding: 0 5px; background: none; border: none; }
        .menu { display: none; position: absolute; right: 0; background: white; border: 1px solid #ccc; border-radius: 5px; padding: 5px; }
        .menu button { display: block; width: 100%; background: none; border: none; padding: 5px; cursor: pointer; text-align: left; }
        input, button { width: 100%; padding: 10px; margin-top: 5px; }
        .controls { display: flex; gap: 5px; justify-content: center; }
        .controls button, .controls input { flex: 1; }
    </style>
</head>
<body>
    <h2>Blind Tools AI Chatbot</h2>
    <p>Type your message below and press "Send" or use voice input.</p>

    <div id="chatbox" aria-live="polite"></div>
    <input type="text" id="userInput" placeholder="Type your message..." aria-label="Chat input" onkeypress="handleKeyPress(event)">
    <div class="controls">
        <button onclick="startVoiceInput()">🎤 Voice Input</button>
        <button onclick="sendMessage()">Send</button>
    </div>

    <script>
        function handleKeyPress(event) {
            if (event.key === "Enter") sendMessage();
        }

        function sendMessage() {
            let userInput = document.getElementById("userInput").value.trim();
            if (!userInput) return;
            let chatbox = document.getElementById("chatbox");

            let userMessage = document.createElement("p");
            userMessage.className = "message user";
            userMessage.innerHTML = `<strong>You:</strong> ${userInput}`;
            chatbox.appendChild(userMessage);
            document.getElementById("userInput").value = "";

            fetchChatbotResponse(userInput);
        }

        function fetchChatbotResponse(userMessage) {
            let url = `chatbot.php?prompt=${encodeURIComponent(userMessage)}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    let botReply = data.msg || "No response received.";
                    displayResponseLineByLine(botReply);
                })
                .catch(error => {
                    displayResponseLineByLine("Error connecting to AI server.");
                });
        }

        function displayResponseLineByLine(reply) {
            let chatbox = document.getElementById("chatbox");
            let lines = reply.split(". ");
            let botMessage = document.createElement("div");
            botMessage.className = "message bot";
            botMessage.innerHTML = `<strong>Bot:</strong> <span></span> 
                <button class="options" onclick="toggleMenu(this)">⋮</button>
                <div class="menu">
                    <button onclick="copyText(this)">📋 Copy</button>
                    <button onclick="speakText(this)">🔊 Read Aloud</button>
                </div>`;
            
            let textContainer = botMessage.querySelector("span");
            chatbox.appendChild(botMessage);

            let index = 0;
            function showNextLine() {
                if (index < lines.length) {
                    textContainer.innerHTML += lines[index] + ".<br>";
                    index++;
                    setTimeout(showNextLine, 1000);
                }
            }
            showNextLine();
            chatbox.scrollTop = chatbox.scrollHeight;
        }

        function toggleMenu(button) {
            let menu = button.nextElementSibling;
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        }

        function copyText(button) {
            let text = button.closest(".message").querySelector("span").innerText;
            navigator.clipboard.writeText(text).then(() => alert("Copied to clipboard!"));
        }

        function speakText(button) {
            let text = button.closest(".message").querySelector("span").innerText;
            let utterance = new SpeechSynthesisUtterance(text);
            speechSynthesis.speak(utterance);
        }

        function startVoiceInput() {
            let recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
            recognition.lang = 'en-US';
            recognition.start();
            recognition.onresult = function(event) {
                let transcript = event.results[0][0].transcript;
                document.getElementById("userInput").value = transcript;
                sendMessage();
            };
        }

        document.addEventListener("click", function(event) {
            if (!event.target.matches(".options")) {
                document.querySelectorAll(".menu").forEach(menu => menu.style.display = "none");
            }
        });
    </script>
</body>
</html>
<?php include 'footer.php'; ?>

