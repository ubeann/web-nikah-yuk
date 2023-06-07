# Nikah Yuk Website with Laravel 10.x

This GitHub repository contains a web programming project developed as part of the Web Programming course. The project focuses on building a website called "Nikah Yuk" using the Laravel framework version 10.x. The website aims to assist couples who are planning to get married by providing various useful features.

## Features ✨

- User registration: Couples can register as users to access the website's features.
- Event scheduling: Couples can create and manage their wedding event schedule, including dates, times, and locations.
- Guest list: Couples can create and manage their guest list, including tracking the attendance status of each guest.
- Photo gallery: Couples can upload and share their wedding photos with invited guests.
- Location map: Couples can add a map to the wedding venue to help guests find the location easily.

## Repository Contents 📁

This repository provides the foundational code for starting the development of the "Nikah Yuk" website using Laravel 10.x. It includes essential components such as models, controllers, and views used to implement the website's functionality.

## Getting Started 🚀

To get started with the project, follow the steps below:

1. Clone the repository to your local machine using the following command:

   ```bash
   git clone https://github.com/ubeann/nikah-yuk.git
   ```

2. Install the project dependencies using the following command:

    ```bash
    composer install
    ```

3. Set up the database configuration by creating a copy of the `.env.example` file and renaming it to `.env`. Then, update the database connection settings with your local database credentials.

4. Generate an application key by running the following command:

    ```bash
    php artisan key:generate
    ```

5. Run the database migrations to create the necessary tables in the database:

    ```bash
    php artisan migrate
    ```

6. Run the database seeders to populate the tables with sample data:

    ```bash
    php artisan db:seed
    ```

7. Run the storage link command to create a symbolic link from `public/storage` to `storage/app/public`:

    ```bash
    php artisan storage:link
    ```

8. Start the development server using the following command:

    ```bash
    php artisan serve
    ```

9. Access the website by visiting `http://localhost:8000` in your web browser.

## Commands 📜

Command is a way to interact with the Laravel application through the command-line interface (CLI). The following are some of the commands that you can use to interact with the application:

1. Import user data from a CSV file:

    ```bash
    php artisan import:users <path-to-csv-file>
    ```

    ```php
    <?php

    namespace App\Console\Commands;

    use Illuminate\Console\Command;
    use App\User;
    use Illuminate\Support\Facades\Hash;

    class ImportUsers extends Command
    {
        protected $signature = 'import:users {file}';

        protected $description = 'Import users from CSV file';

        public function handle()
        {
            $file = $this->argument('file');
            
            $csv = \League\Csv\Reader::createFromPath($file);
            $csv->setHeaderOffset(0);
            
            foreach ($csv as $row) {
                $user = new User();
                $user->name = $row['name'];
                $user->email = $row['email'];
                $user->password = Hash::make($row['password']);
                $user->save();
            }
            
            $this->info('Users imported successfully.');
        }
    }
    ```

2. Remove `cancelled` events from the database:

    ```bash
    php artisan event:remove-cancelled
    ```

    ```php
    <?php

    namespace App\Console\Commands;

    use Illuminate\Console\Command;
    use App\Models\Event;

    class RemoveCancelledEvents extends Command
    {
        protected $signature = 'event:remove-cancelled';

        protected $description = 'Remove cancelled events';

        public function handle()
        {
            $cancelledEvents = Event::where('status', 'cancelled')->get();
            
            foreach ($cancelledEvents as $event) {
                $event->delete();
            }
            
            $this->info('Cancelled events removed successfully.');
        }
    }
    ```

3. Remove `inactive` users from the database:

    ```bash
    php artisan user:remove-inactive
    ```

    ```php
    <?php

    namespace App\Console\Commands;

    use Illuminate\Console\Command;
    use App\Models\User;

    class RemoveInactiveUsers extends Command
    {
        protected $signature = 'user:remove-inactive';

        protected $description = 'Remove inactive users';

        public function handle()
        {
            $inactiveUsers = User::where('active', false)->get();
            
            foreach ($inactiveUsers as $user) {
                $user->delete();
            }
            
            $this->info('Inactive users removed successfully.');
        }
    }
    ```

Other commands are available in the `app/Console/Commands` folder.

## Job 📬

Job is a unit of work that is executed in the background. The following are some of the jobs that you can use to perform background tasks:

1. Send an email to a user:

    ```bash
    php artisan email:send <user-id>
    ```

    ```php
    <?php

    namespace App\Jobs;

    use App\Models\User;
    use App\Mail\SendEmail;
    use Illuminate\Bus\Queueable;
    use Illuminate\Queue\SerializesModels;
    use Illuminate\Queue\InteractsWithQueue;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Foundation\Bus\Dispatchable;
    use Illuminate\Support\Facades\Mail;

    class SendEmailJob implements ShouldQueue
    {
        use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

        protected $user;

        public function __construct(User $user)
        {
            $this->user = $user;
        }

        public function handle()
        {
            Mail::to($this->user->email)->send(new SendEmail($this->user));
        }
    }
    ```

2. Send booking information to a user:

    ```bash
    php artisan booking:send <user-id>
    ```

    ```php
    <?php

    namespace App\Jobs;

    use App\Models\User;
    use App\Mail\BookingConfirmationMail;
    use Illuminate\Bus\Queueable;
    use Illuminate\Queue\SerializesModels;
    use Illuminate\Queue\InteractsWithQueue;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Foundation\Bus\Dispatchable;
    use Illuminate\Support\Facades\Mail;

    class BookingConfirmationJob implements ShouldQueue
    {
        use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

        protected $user;

        public function __construct(User $user)
        {
            $this->user = $user;
        }

        public function handle()
        {
            Mail::to($this->user->email)->send(new BookingConfirmationMail($this->user));
        }
    }
    ```

Other jobs are available in the `app/Jobs` folder.

## Queue 🧺

Queue is a mechanism for deferring the execution of a time-consuming task, such as sending an email, until a later time. The following are some of the queues that you can use to perform time-consuming tasks:

1. Send an email to a user:

    ```bash
    php artisan queue:send-email <user-id>
    ```

    ```php
    <?php

    namespace App\Http\Controllers;

    use App\Models\User;
    use App\Jobs\SendEmailJob;

    class UserController extends Controller
    {
        public function sendEmail($id)
        {
            $user = User::findOrFail($id);
            
            SendEmailJob::dispatch($user);
            
            return redirect()->back()->with('success', 'Email sent successfully.');
        }
    }
    ```

2. Send booking information to a user:

    ```bash
    php artisan queue:booking-confirmation <user-id>
    ```

    ```php
    <?php

    namespace App\Http\Controllers;

    use App\Models\User;
    use App\Jobs\BookingConfirmationJob;

    class UserController extends Controller
    {
        public function bookingConfirmation($id)
        {
            $user = User::findOrFail($id);
            
            BookingConfirmationJob::dispatch($user);
            
            return redirect()->back()->with('success', 'Booking confirmation sent successfully.');
        }
    }
    ```

Other queues are available in the `app/Http/Controllers` folder.

## Email Service 📧

The application uses [Mailtrap](https://mailtrap.io/) to send emails. Mailtrap is a fake SMTP server for development teams to test, view, and share emails sent from the development and staging environments without spamming real customers. Mail service will be used when `user register`, `payment success`, and `event approved`.

To use Mailtrap, you need to create a free account and update the `MAIL_USERNAME` and `MAIL_PASSWORD` values in the `.env` file with your Mailtrap credentials.

There are example of mail on laravel project, you can find it on `resources/views/emails` folder.

```php
use Illuminate\Support\Facades\Mail;

Mail::to($user->email)->send(new BookingConfirmationMail($event));
```

## Notification Service 📩

Laravel provides a unified API for sending notifications across a variety of delivery channels, including mail, SMS (via Nexmo), and Slack. Notifications may also be stored in a database so they may be displayed in your web interface. Notification will be used when `user register`, `payment success`, and `event approved`.

The application uses [Nexmo](https://www.nexmo.com/) to send SMS notifications. Nexmo is a cloud communications platform that enables you to send and receive SMS messages worldwide.

To use Nexmo, you need to create a free account and update the `NEXMO_KEY` and `NEXMO_SECRET` values in the `.env` file with your Nexmo credentials.

There are example of notification on laravel project, you can find it on `app/Notifications` folder.

```php
$user->notify(new SendNotification($user));
```

## API Service 📡 (for Frontend Developers)

The application provides a RESTful API service that allows frontend developers to access the application's data. The following are some of the API endpoints that you can use to access the data:

1. Get all users:

    ```bash
    GET /api/users
    ```

2. Get a user by ID:

    ```bash
    GET /api/users/{id}
    ```

3. Update a user by ID:

    ```bash
    PUT /api/users/{id}
    ```

4. Delete a user by ID:

    ```bash
    DELETE /api/users/{id}
    ```

Other API endpoints are available in the `routes/api.php` file.
Output data is in JSON format. Example:

```json
{
    "status": "success",
    "code" : 200,
    "message": "OK, data retrieved successfully.",
    "data": [
        {
            "id": 1,
            "name": "Muhammad Rizal Bagus Prakasa",
            "gender": "male",
            "email": "ubeann@mail.com",
        }
    ],
    "meta": {
        "total": 1,
        "page": 1,
        "limit": 10
    },
    "errors": null,
    "stacktrace": null,
    "timestamp": "2021-10-01 00:00:00"
}
```

## Contribution 🤝

If you would like to contribute to this project, please follow these steps:

1. Fork the repository to your GitHub account.

2. Create a new branch for your feature or bug fix.

3. Make the necessary changes and commit them.

4. Push the changes to your forked repository.

5. Submit a pull request to the main repository, explaining the changes you made.

## License 📄

This project is licensed under the [MIT License](LICENSE).

Feel free to modify and customize the code according to your needs.

---

We hope you find this project useful for your Web Programming course. If you have any questions or need further assistance, please don't hesitate to reach out. Good luck with your project!
