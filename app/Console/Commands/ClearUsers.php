<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ClearUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove inactive users from the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get all inactive users (where doesn't have events)
        $users = User::whereDoesntHave('events')->get();

        // Check if there are any users
        if ($users->isEmpty()) {
            // Display a message to the user
            $this->info('There are no inactive users');

            // Stop the command
            return;
        }

        // Show the number of users
        $this->info('There are ' . $users->count() . ' inactive users');

        // Confirm with the user
        if (!$this->confirm('Are you sure you want to delete these users?')) {
            // Stop the command
            return;
        }
        // Display a message to the user
        $this->info('Deleting users');

        // Start a progress bar
        $bar = $this->output->createProgressBar($users->count());

        // Loop through the users
        foreach ($users as $user) {
            // Delete the user
            $user->delete();

            // Advance the progress bar
            $bar->advance();
        }

        // Finish the progress bar
        $bar->finish();

        // Add a new line
        $this->line('');

        // Display a message to the user
        $this->info('The users have been deleted');
    }
}
