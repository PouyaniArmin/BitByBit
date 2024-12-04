# BitByBit

BitByBit is a simple programming blog platform built with PHP and designed to help developers share articles, tutorials, and discussions. The platform follows the MVC (Model-View-Controller) pattern and includes essential features like content management, email notifications, middleware for admin authentication, CSRF protection, and more.

## Features

- **MVC Architecture**: The application follows the Model-View-Controller pattern for better organization and scalability.
- **Email Service**: Email functionality for account verification and password reset is implemented using PHP Mailer.
- **Middleware**: A middleware layer has been implemented for admin routes to protect sensitive actions.
- **CSRF Protection**: The platform uses CSRF token validation to prevent Cross-Site Request Forgery attacks.
- **Content Management**: Simple content management system allowing users to create, edit, and manage articles.
- **Search**: Basic search functionality for articles.

## Requirements

- PHP 8.3 or higher
- Composer
- MySQL or other compatible database
- PHPMailer library

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/yourusername/bitbybit.git
    cd bitbybit
    ```

2. Install dependencies:

    ```bash
    composer install
    ```

3. Configure environment variables:
   - Copy `.env.example` to `.env` and configure your environment settings (e.g., database credentials, email configuration).

4. Import the database schema:
   - The database schema is provided in `sql/schema.sql`.
   - Run the following command to import the schema into your database:
     ```bash
     mysql -u username -p database_name < sql/schema.sql
     ```

5. Run the application:
   - You can use the built-in PHP server to run the application:
     ```bash
     php -S localhost:8000 -t public/
     ```

## Contributing

Feel free to fork the repository, submit issues, and make pull requests. Contributions are welcome!

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
