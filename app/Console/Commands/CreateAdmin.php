<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {email} {password} {firstname?} {lastname?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create an admin account'; 

    /**
     * Execute the console command.
     */
    public function handle() {
        
        $email = $this->argument('email');
        $password = $this->argument('password');
        Admin::create([
            'email' => $email,
            'password' => Hash::make($password),
            'first_name' => $this->argument('firstname') ?? 'admin',
            'last_name' => $this->argument('lastname') ?? 'admin',
        ]);

        $this->info("Created new admin account with email: $email, password: '{$password}' ");
    }
}
