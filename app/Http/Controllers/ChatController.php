<?php

namespace App\Http\Controllers;

use App\Services\OpenAIService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    private OpenAIService $openAiService;

    public function __construct(OpenAIService $openAiService)
    {
        $this->openAiService = $openAiService;
    }

    public function chat(Request $request)
    {
        return $this->openAiService->chat($request->input('prompt'));
    }
}
