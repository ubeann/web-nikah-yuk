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
   git clone https://github.com/your-username/nikah-yuk.git
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

7. Start the development server using the following command:

    ```bash
    php artisan serve
    ```

8. Access the website by visiting `http://localhost:8000` in your web browser.

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
