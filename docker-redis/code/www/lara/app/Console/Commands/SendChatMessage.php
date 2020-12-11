<?php

namespace App\Console\Commands;

use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Console\Command;

class SendChatMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chat:message {message}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send chat message.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::first();
        $message = ChatMessage::create([
            'user_id' => $user->id,
            'message' => $this->argument('message')
        ]);
        event(new \App\Events\ChatMessage($message, $user));
    }
}
