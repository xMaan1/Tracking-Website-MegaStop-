<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class UpdateAdminCredentials extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:update-credentials';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update admin credentials to the specified values';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Find or create admin user
        $user = User::first();
        
        if ($user) {
            // Update existing user
            $user->name = 'Abdul Rehman';
            $user->email = 'abdulrehmanbilal25@gmail.com';
            $user->password = Hash::make('abdulrehman2555');
            $user->save();
            
            $this->info('Admin credentials updated successfully.');
        } else {
            // Create new user
            User::create([
                'name' => 'Abdul Rehman',
                'email' => 'abdulrehmanbilal25@gmail.com',
                'password' => Hash::make('abdulrehman2555'),
            ]);
            
            $this->info('Admin user created successfully.');
        }
        
        // Output the credentials for confirmation
        $this->info('Admin Login Details:');
        $this->info('Email: abdulrehmanbilal25@gmail.com');
        $this->info('Password: abdulrehman2555');
    }
}
