### Project Details

This project is built using Laravel version 11 and focuses on REST API design. It implements best practices and emphasizes separating requests and responses while adhering to various design principles such as DRY (Don't Repeat Yourself), SOLID, and Separation of Concerns.

### Features Implemented

- Two complete CRUD operations for models: `Role` and `IpList`
- Usage of:
  - Traits
  - Services
  - Enums
  - Custom Middleware
  - JWT Token Authentication
  - Object-Oriented Programming (OOP) principles
  - DRY (Don't Repeat Yourself) approach
  - Request handling
  - Resource management

## Setting Up The Project

1. **Clone the Repository**: 
   - Open your terminal or command prompt.
   - Navigate to the directory where you want to clone the project.
   - Run the following command:
     ```bash
     git clone https://github.com/sMmominur/restapi-laravel.git
     ```

2. **Install Dependencies**:
   - Navigate into the cloned project directory:
     ```bash
     cd project-name
     ```
   - Install Composer dependencies:
     ```bash
     composer install
     ```

3. **Create Environment File**:
   - Make a copy of the `.env.example` file and rename it to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Generate an application key:
     ```bash
     php artisan key:generate
     ```

4. **Database Configuration**:
   - Open the `.env` file and configure your database connection settings.
   - Set the database name, username, password, and other relevant settings.

5. **Run Migrations and Seeders**:
   - Run database migrations to create tables:
     ```bash
     php artisan migrate
     ```
   - Run the seeders to populate the database with sample data:
     ```bash
     php artisan db:seed
     ```

6. **Serve the Application**:
   - Start the Laravel development server:
     ```bash
     php artisan serve
     ```

7. **Access the Application**:
   - Open your web browser and go to `http://localhost:8000` or the URL provided by the `php artisan serve` command.

8. **Test APIs**:
   - Utilize the provided CRUD operations for testing the REST APIs as per the project's documentation or instructions.

9. **Explore Additional Features**:
   - Explore and test additional features such as Traits, Services, Enums, Custom Middleware, JWT Token Authentication, Object-Oriented Programming (OOP) principles, DRY approach, Request handling, and Resource management as provided in the project.

10. **Start Developing**:
    - With the project set up, you can now start developing your application or explore further customization as per your requirements.

## API Sample and Documentation

Details of requests and responses are provided in the following Postman documentation. Please follow the document for comprehensive API usage and understanding.

[Postman Documentation](https://www.postman.com/mominur23/workspace/laravel-rest/collection/29494647-b8fb4f44-8602-40ba-99ec-573daf0a1996?action=share&creator=29494647)

Make sure to consult the provided documentation for information on how to interact with the APIs, including request formats, available endpoints, authentication mechanisms (if any), and sample responses.

This documentation serves as a guide for developers to effectively utilize and integrate the API endpoints into their applications.
