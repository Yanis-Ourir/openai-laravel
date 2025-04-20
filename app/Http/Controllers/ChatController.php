<?php

namespace App\Http\Controllers;

use App\Services\OpenAIService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    protected OpenAIService $openAiService;
    protected array $messageHistory = [];

    public function __construct(OpenAIService $openAiService)
    {
        $this->openAiService = $openAiService;
    }

    public function chat(Request $request)
    {
        $this->messageHistory[] = $this->openAiService->chat($request->message);
        session(['response' => $this->messageHistory]);
        dd(session('response'));
    }

    public function messageHistory()
    {
        // UN TABLEAU STATIC POUR L'INSTANT
        return [
            ['role' => 'user', 'content' => 'Hello!'],
            ['role' => 'assistant', 'content' => 'Hi there! How can I assist you today?'],
        ];
    }
}
