<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    function index()
    {
        // Exemplo de mensagens, uma apresentação do chatbot para o usuário. Ensinando como começar a utilizar o chatbot.
        // Para usar é só inserir a mensagem no campo abaixo e enviar.
        $exemploMensagens = [
            'Olá, eu sou o check bot.',
            'Para começar a conversar comigo, digite uma mensagem no campo abaixo e clique em enviar.',
        ];
        return view('chat.index', ['mensagens' => $exemploMensagens]);
    }
    function enviarMensagem(Request $request)
    {
        $mensagem = $request->input('mensagem');

        if (empty($mensagem)) {
            // Se a mensagem estiver vazia, apenas redirecione de volta ao chat
            return redirect()->route('chat');
        }

        // Recupere as mensagens da sessão, ou crie um array vazio se não existir
        $mensagens = $request->session()->get('mensagens', []);

        // Adicione a nova mensagem ao array
        $mensagemUsuario = [
            "mensagem" => $mensagem,
            "data" => date("d/m/Y H:i:s"),
            "tipo" => "usuario"
        ];
        $mensagemBot = [
            "mensagem" => $this->respostaChat($mensagem),
            "data" => date("d/m/Y H:i:s"),
            "tipo" => "bot"
        ];
        array_push($mensagens, $mensagemUsuario);
        array_push($mensagens, $mensagemBot);

        // Salve o array atualizado na sessão
        $request->session()->put('mensagens', $mensagens);

        // Carregue a visão de mensagens de chat com as mensagens atuais
        return view('chat.mensagens', ['mensagens' => $mensagens]);
    }

    function respostaChat(String $mensagem)
    {
        $url = '26.119.214.40:8002/userInput';
        $body = [
            'user_input' => $mensagem
        ];
        $resposta = Http::post($url, $body);
        $respostaJson = $resposta->json();

        return $respostaJson['message'];
    }
}
