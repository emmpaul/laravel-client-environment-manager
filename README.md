# Laravel Client Environment Manager

A Laravel application designed to manage client environments, including URLs, servers, and related configuration details. This app simplifies tracking and managing multiple environments for various clients.

## Features

- **Client Management**: Add, edit, and delete client profiles.
- **Environment Tracking**: Maintain detailed information for client environments, including URLs, servers, and other configurations.
- **Search and Filtering**: Quickly locate client environments with robust search and filtering capabilities.
- **Modern UI**: Built using ShadCN components for a clean and user-friendly interface.

## Requirements

- Docker (running the app with MySQL and meilisearch)
- Laravel Sail (optional for local development)

## Installation

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/emmpaul/laravel-clients.git
   cd laravel-clients
   ```

2. **Set Environment Variables**:
   Copy the `.env.example` file to `.env` and update the database and other configurations:
   ```bash
   cp .env.example .env
   ```
   Update `.env` with your database credentials and other necessary settings.

3. **Install Dependencies**:
   ```bash
   docker compose -f docker-compose.prod.yml up -d
   ```

4. **Run Migrations**:
   ```bash
   docker compose -f docker-compose.prod.yml exec app php artisan migrate
   ```

## Usage

1. Navigate to `http://localhost` (or the configured host and port from the `.env` file).
2. Login or register a new account.
3. Begin adding and managing client environments via the dashboard.

## Development

### Technologies Used

- **Laravel Framework**: Backend logic and API
- **Vue.js with Inertia.js**: Frontend interactivity
- **ShadCN**: Modern UI components
- **Laravel Breeze**: Authentication scaffolding

### Local Development Tips

- Use Laravel Sail for a Docker-based local development environment.

## Contributing

1. Fork the repository.
2. Create a feature branch:
   ```bash
   git checkout -b feature/your-feature
   ```
3. Commit your changes:
   ```bash
   git commit -m "Add your feature description"
   ```
4. Push to the branch:
   ```bash
   git push origin feature/your-feature
   ```
5. Create a pull request.

## License

This project is open-source and available under the [MIT License](LICENSE).

---

Start managing your client environments with ease and efficiency!

