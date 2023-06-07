<?php

namespace App\Console\Commands;

use App\Models\Event;
use Illuminate\Console\Command;

class ClearEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove canceled events from the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get all canceled events
        $events = Event::where('status', 'canceled')->get();

        // Check if there are any events
        if ($events->isEmpty()) {
            // Display a message to the user
            $this->info('There are no canceled events');

            // Stop the command
            return;
        }

        // Show the number of events
        $this->info('There are ' . $events->count() . ' canceled events');

        // Confirm with the user
        if (!$this->confirm('Are you sure you want to remove these events?')) {
            // Stop the command
            return;
        }

        // Display a message to the user
        $this->info('Removing events');

        // Start a progress bar
        $bar = $this->output->createProgressBar($events->count());

        // Loop through the events
        foreach ($events as $event) {
            // Delete the event
            $event->delete();

            // Advance the progress bar
            $bar->advance();
        }

        // Finish the progress bar
        $bar->finish();

        // Add a new line
        $this->line('');

        // Display a message to the user
        $this->info('All canceled events have been removed');
    }
}
