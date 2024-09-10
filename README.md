# Magicport Project Management Tool

### Overview
The Magicport Project Management Tool is a Laravel-based application designed to manage projects and tasks. It implements the **Repository Pattern** to decouple the business logic from data access layers, promoting a cleaner and more maintainable codebase.

### Features
- Create, update, view, and delete projects.
- Manage tasks within each project.
- Tasks can be categorized by status (todo, in-progress, done).
- API-based structure using controllers and repositories.
- Login/logout functionality.

### Design Pattern: Repository Pattern
This project uses the **Repository Pattern** to encapsulate the data access logic and decouple it from the business logic within the controllers. The key benefits include:
- Centralized data access logic.
- Easier maintainability and testability.
- Flexibility to switch data sources or modify data access logic without affecting other parts of the code.

Each entity (Project, Task) has its own repository interface and repository implementation, making the code modular and easy to extend.

### Project Structure
```
app
├── Http
│   ├── Controllers
│   │   ├── LoginController.php
│   │   ├── ProjectController.php
│   │   └── TaskController.php
├── Models
│   ├── Project.php
│   ├── Task.php
├── Providers
├── Repositories
│   ├── ProjectRepositoryInterface.php
│   ├── ProjectRepository.php
│   ├── TaskRepositoryInterface.php
│   ├── TaskRepository.php
...
```

### Setup Instructions

#### 1. Clone the Repository
First, clone the repository to your local machine:
```bash
git clone https://github.com/taylankoca/magicport-project-management-tool
cd magicport-project-management-tool
```

#### 2. Install Dependencies
Install the PHP and Node.js dependencies:
```bash
composer install
npm install
```

#### 3. Set Up Environment Variables
Create a `.env` file by copying the example file:
```bash
cp .env.example .env
```
Update the `.env` file with your local environment configurations (e.g., database connection).

#### 4. Generate Application Key
Generate an application key by running the following command:
```bash
php artisan key:generate
```

#### 5. Set Up the Database
Migrate the database to create the necessary tables:
```bash
php artisan migrate
```

Optionally, you can also seed the database with test data (if seeds are available):
```bash
php artisan db:seed
```

In this step you should set default email and password for basic user. You can create more than one user.
```php
    public function run()
    {
        // Create a user with specific credentials
        User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('password123'), // Use Hash to securely store the password
        ]);
    }
}
```

#### 6. Compile Assets
Run the following command to compile the front-end assets using Vite:
```bash
npm run dev
```

#### 7. Start the Development Server
Run the Laravel development server:
```bash
php artisan serve
```

Now the project will be accessible at `http://127.0.0.1:8000`.

### Usage
- After logging in, you will be directed to the projects dashboard where you can create, update, view, and delete projects.
- You can manage tasks within each project and assign them different statuses.
