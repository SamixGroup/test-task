<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class AuthorizeUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:authorize {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Use this command to authorize a user with email and password';

    /**
     * Execute the console command.
     *
     * @throws \Exception
     */
    public function handle()
    {
        $credentials = $this->arguments();
        unset($credentials['command']);
        if (!Auth::attempt($credentials)) {
            throw new \Exception("Failed to authorize a user with email {$credentials['email']} and password {$credentials['password']}");
        } else {
            printf("Your token: %s . Note that it will work only until %s", User::where('email', $credentials['email'])->first()->createToken('token')->plainTextToken, date("Y:m:d H:i:s",time() + 300));
        }
    }


}
