<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use League\Csv\Reader;

class ImportUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:users {csv-file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import users from a CSV file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the file name from the command argument
        $file = $this->argument('csv-file');

        // Get filename from the path
        $filename = basename($file);

        // Check if the file exists
        if (!file_exists($file)) {
            // Display a message to the user
            $this->error('The file ' . $filename . ' does not exist');

            // Stop the command
            return;
        }

        // Check extension
        if (pathinfo($file, PATHINFO_EXTENSION) !== 'csv') {
            // Display a message to the user
            $this->error('The file ' . $filename . ' is not a CSV file');

            // Stop the command
            return;
        }

        // Display a message to the user
        $this->info('Importing users from ' . $filename);

        // Open the CSV file
        $csv = Reader::createFromPath($file, 'r');

        // Set the header offset
        $csv->setHeaderOffset(0);

        // Set counter
        $counter = 1;

        // Loop through the CSV records
        foreach ($csv as $record) {
            // Create a new user
            $user = new User();

            // Set the user's attributes
            $user->name = $record['name'];
            $user->phone = $record['phone'];
            $user->email = $record['email'];
            $user->password = Hash::make($record['password']);

            // Save the user
            $user->save();

            // Display a message to the user
            $this->info($counter . ' - ' . $user->name . ' imported');

            // Increment counter
            $counter++;
        }

        // Display a message to the user
        $this->info('All users imported');
    }
}
