<?php

namespace App\Http\Controllers;

use App\Services\OpenAIService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    protected OpenAIService $openAiService;

    public function __construct(OpenAIService $openAiService)
    {
        $this->openAiService = $openAiService;
    }

    public function chat(Request $request)
    {
        return $this->openAiService->chat($request->message);
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
