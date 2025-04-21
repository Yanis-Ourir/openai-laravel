<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CustomAI - Laravel</title>


        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="bg-gray-900 text-gray-100 flex items-center justify-center min-h-screen p-4 md:p-6">
        <div class="w-full max-w-2xl flex flex-col gap-6">
      
            <div class="text-center mb-2">
                <h1 class="text-2xl font-bold text-indigo-400">AI Assistant</h1>
                <p class="text-gray-400">Posez-moi n'importe quelle question</p>
            </div>
            
      
            <div id="chat-messages" class="w-full bg-gray-800 rounded-xl p-4 overflow-y-auto max-h-96 shadow-lg">
                @if ($messageHistory)
                    @foreach ($messageHistory as $message)
                        <div class="flex {{ $message['role'] === 'user' ? 'justify-end' : '' }} mb-4">
                            <div class="{{ $message['role'] === 'user' ? 'bg-indigo-600' : 'bg-gray-700' }} text-white py-2 px-4 rounded-xl max-w-[80%] shadow">
                                <p>{{ $message['content'] }}</p>
                            </div>
                        </div>
                    @endforeach
                {{-- @if (session('response'))
                  
                    <div class="flex justify-end mb-4">
                        <div class="bg-indigo-600 text-white py-2 px-4 rounded-xl max-w-[80%] shadow">
                            <p>{{ session('user_message') }}</p>
                        </div>
                    </div>
                    
             
                    <div class="flex mb-4">
                        <div class="bg-gray-700 py-2 px-4 rounded-xl max-w-[80%] shadow">
                            <p class="text-gray-100">{{ session('response') }}</p>
                        </div>
                    </div> --}}
                @else
                    <div class="text-center py-8 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-3 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                        <p>Commencez la conversation...</p>
                    </div>
                @endif
            </div>
            
        
            <form id="chat-form" class="w-full" action="{{ route('chat.prompt') }}" method="POST">
                @csrf
                <div class="flex flex-col gap-3">
                    <div class="relative">
                        <textarea 
                            id="prompt" 
                            name="prompt" 
                            rows="3" 
                            class="w-full p-4 pr-16 bg-gray-800 border border-gray-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-gray-100 placeholder-gray-500 resize-none"
                            placeholder="Écrivez votre message ici..."
                            required
                        ></textarea>
                        <button 
                            type="submit" 
                            class="absolute right-3 bottom-3 bg-indigo-600 text-white p-2 rounded-lg hover:bg-indigo-700 transition-colors duration-200 flex items-center justify-center"
                            aria-label="Envoyer"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                            </svg>
                        </button>
                    </div>
                    
                    <div class="text-xs text-gray-500 text-center">
                        Appuyez sur Entrée pour envoyer ou Shift+Entrée pour un saut de ligne
                    </div>
                </div>
            </form>
            
  
            @if ($errors->any())
                <div class="w-full bg-red-900/50 text-red-300 p-3 rounded-lg shadow-md border border-red-800">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </body>

     <script>
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.getElementById('message');
            
            textarea.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    document.getElementById('chat-form').submit();
                }
            });
        });
    </script>
</html>
