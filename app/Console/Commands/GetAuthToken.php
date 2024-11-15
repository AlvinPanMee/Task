<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class GetAuthToken extends Command
{
    protected $signature = 'get:authtoken';

    protected $description = 'Generate API Token';

    public function handle(): bool 
    {
        $text = bin2hex(random_bytes(20));
        $key = Hash::make($text);

        $message = "This is your auth_token to access Task API. Add the auth token to your request headers
auth_token:$key \n
NEXT STEP: Paste the following line into .env
AUTH_TOKEN=$text
        ";
        $this->info($message);

        return true;
    }
}