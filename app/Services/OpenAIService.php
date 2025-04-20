<?php

namespace App\Services;

use OpenAI;

class OpenAIService
{
    public function chat(string $prompt): string
    {
        // return a response from OpenAI API using the provided prompt
        $openAiApiKey = env('OPENAI_API_KEY');
        $client = OpenAI::client($openAiApiKey);

        $result = $client->chat()->create([
            'model' => 'gpt-3.5-turbo-0125',
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
            'instructions' => [
                'role' => 'developer',
                'content' => 'You are a helpful assistant.',
            ],
        ]);

        return $result->choices[0]->message->content;
    }
}
