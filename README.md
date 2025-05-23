A Laravel-based e-commerce solution with modern features.

## Installation

1. Clone the repository:
   ```bash
   https://github.com/mostafaamahmoudd/e-commerce.git
   cd e-commerce
   ```

2. Install dependencies:
   ```bash
   composer install
   npm install
   ```

3. Configure environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Set up database:
    - Create MySQL database
    - Update `.env` with database credentials:
      ```env
      DB_DATABASE=your_db_name
      DB_USERNAME=your_db_user
      DB_PASSWORD=your_db_password
      ```

5. Run migrations:
   ```bash
   php artisan migrate --seed
   ```

6. Start development server:
   ```bash
   php artisan serve
   ```

## Project Structure

```
e-commerce/
├── app/
│   ├── Enums/              # Custom enumeration classes
│   ├── Http/               # Request handling layer
│   │   ├── Controllers/    # Application controllers
│   │   └── Requests/       # Form request classes
│   ├── Models/             # Database models
│   ├── Relations/          # Model relationship definitions
│   └── Providers/          # Service providers
├── database/               # Migrations, Factories and seeders
├── public/                 # Publicly accessible assets
├── resources/
│   ├── views/              # Blade templates
│   └── assets/             # Frontend source files
├── config/                 # Configuration files
└── routes/                 # Application routes
```

## Contributing

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request
