# Accounts Manager

Welcome to the Accounts Manager repository! This is a simple Laravel project that allows you to store your account credentials locally. It provides a user-friendly interface for managing and organizing your accounts.

## Getting Started

To get started with the Accounts Manager project, follow the steps below:

### Prerequisites

Make sure you have the following prerequisites installed on your machine:

- PHP (version >= 7.4)
- Composer
- Laravel (version >= 8.0)
- MySQL (or any other compatible database system)

### Installation

1. Clone the repository to your local machine using the following command:

   ```
   git clone https://github.com/Kenchiie/Accounts-Manager.git
   ```

2. Change into the project directory:

   ```
   cd accounts-manager
   ```

3. Install the project dependencies using Composer:

   ```
   composer install
   ```

4. Create a new MySQL database named `accounts_manager` (or choose a different name if you prefer). You can use any other compatible database system as well.

5. Configure the database connection by copying the `.env.example` file to `.env`:

   ```
   cp .env.example .env
   ```

   Then, open the `.env` file and update the following lines:

   ```
   DB_DATABASE=accounts_manager
   DB_USERNAME=your-database-username
   DB_PASSWORD=your-database-password
   ```

   Replace `your-database-username` and `your-database-password` with your actual database credentials.

6. Migrate the database to create the necessary tables:

   ```
   php artisan migrate
   ```

7. Generate a new application key:

   ```
   php artisan key:generate
   ```

8. Serve the application locally:

   ```
   php artisan serve
   ```

   By default, the application will be accessible at `http://127.0.0.1:8000`.

Congratulations! You have successfully set up the Accounts Manager project on your local machine.

## Usage

Once the application is up and running, you can access it in your web browser by navigating to `http://127.0.0.1:8000`. Here are a few instructions to help you get started:

1. Register a new user account using the provided registration form.
2. Log in with your newly created account.
3. Use the account management features to add, edit, and delete your account credentials.
4. Organize your accounts using categories or any other method that suits your needs.

Feel free to explore the application and customize it according to your preferences.

## Contributing

Contributions to the Accounts Manager project are always welcome! If you find any issues or have suggestions for improvements, please open an issue on the GitHub repository. If you'd like to contribute code, you can fork the repository, make your changes, and submit a pull request.

## License

This project is licensed under the [MIT License](LICENSE). Feel free to use, modify, and distribute the code as per the terms of this license.

## Acknowledgments

Special thanks to the Laravel community for their excellent documentation and the numerous open-source contributors who make projects like this possible.