<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <title>CheckBox</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
            font-family: Arial, sans-serif;
        }

        .chat-container {
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .chat-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .chat-header img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .chat-header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: normal;
        }

        .chat-messages {
            width: 100%;
            height: calc(100vh - 200px);
            overflow-y: scroll;
            padding: 20px;
            box-sizing: border-box;
        }

        .usuario {
            align-items: flex-end;
        }

        .bot {
            align-items: flex-start;
        }

        .chat-message {
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
        }

        .chat-message .message-text {
            background-color: #fff;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 70%;
            word-wrap: break-word;
        }

        .chat-message .message-time {
            font-size: 12px;
            color: #999;
            margin-top: 5px;
        }

        .chat-input {
            display: flex;
            align-items: center;
            margin-top: 20px;
            width: 97%;
        }

        .chat-input input[type="text"] {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-right: 10px;
            font-size: 16px;
        }

        .chat-input button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-size: 16px;
            cursor: pointer;
        }

        .chat-input button:hover {
            background-color: #3e8e41;
        }
    </style>
</head>

<body>
    <div class="chat-container">
        <div class="chat-header">
            <!-- <img src="https://via.placeholder.com/50" alt="Chatbot"> -->
            <h2>Check Bot</h2>
        </div>
        <div class="chat-messages">
            @foreach ($mensagens as $mensagem)
            @if ($mensagem['tipo'] == 'usuario')
            <div class="chat-message usuario">
                @else
                <div class="chat-message bot">
                    @endif
                    <div class="message-text">{{ $mensagem['mensagem'] }}</div>
                    <div class="message-time">{{ $mensagem['data'] }}</div>
                </div>
                @endforeach
            </div>
            <form action="enviarMensagem" method="POST">
                @csrf
                <div class="chat-input">
                    <input type="text" id="mensagem" name="mensagem" placeholder="Digite sua mensagem...">
                    <button type="submit">Enviar</button>
                </div>
            </form>
        </div>
</body>

</html>