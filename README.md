# Todo List API

This is the backend API for the Vue.js Todo List application. This API provides endpoints for creating, retrieving, updating, and deleting items on the todo list.

## Setup

First, clone the repository:

```bash
git clone https://github.com/michaelbarley/todo-list-api.git
cd todo-list-api
```

Then, install the Composer dependencies:

```bash
composer install
```

You will need to create a .env file with your database connection details. You can use the provided .env.example file as a template:

```bash
cp .env.example .env
```

Generate an app encryption key:
```bash
php artisan key:generate
```

Run the migrations to create the necessary tables in your database:

```bash
php artisan migrate
```

## Running the API

To start the server, use the serve Artisan command:

```bash
php artisan serve
```

By default, this will start the server on `http://localhost:8000`.

## Testing

This repository includes a suite of tests that you can run to verify the functionality of the API:

```bash
php artisan test
```

## Connecting with the Frontend

To connect this backend API with the (frontend application)[https://github.com/michaelbarley/todo-list], you'll need to set the axios.defaults.baseURL in the todos.js file of the frontend project to match the URL of your local API instance.

For example, if your local API is running on `http://localhost:8000`, you should set:

```javascript
axios.defaults.baseURL = 'http://localhost:8000';
```
