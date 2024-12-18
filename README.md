# Laravel Stripe Ajax


## Installation Guide

Follow the steps below to get your project up and running.

### 1. Clone the repository

Clone the project repository to your local machine using the following command:

```bash
git clone https://github.com/Abouelez/laravel-stripe-ajax.git
```

### 2. Navigate to the project directory

Once the repository is cloned, change into the project directory:

```bash
cd laravel-stripe-ajax
```

### 3. Install project dependencies

Run `composer update` to install all the necessary PHP dependencies:

```bash
composer update
```

### 4. Set up the environment file

You need to configure your environment settings by creating a `.env` file.

- Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

- Open the `.env` file and modify the following key environment configurations to match your local setup:

    - **APP_KEY**: Generate a new application key using the following command:

      ```bash
      php artisan key:generate
      ```

    - **Database Configuration**: Update the database connection settings (e.g., `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`) according to your environment.

    - **Stripe Configuration**: If using Stripe, set up the following in your `.env` file:

      ```
      STRIPE_KEY=your-stripe-publishable-key
      STRIPE_SECRET=your-stripe-secret-key
      ```

    - **Other Configurations**: Set any other necessary environment variables according to your application requirements.

### 5. Migrate the database

Run the database migrations to set up the required tables:

```bash
php artisan migrate
```

### 6. (Optional) Seed the database

If you need to seed the database with sample data, run the following command:

```bash
php artisan db:seed
```

### 7. Start the development server

Run the following command to start the Laravel development server:

```bash
php artisan serve
```

Visit `http://127.0.0.1:8000` in your web browser to view the application.

## Usage

Provide a brief overview of how to use your application and its key features.

## Testing

To run the tests, use PHPUnit by running the following command:

```bash
php artisan test
```

If you have specific test instructions or guidelines, add them here.

# Project Overview

## Section 1: Routing and Middleware

1. **Route Creation**
   - I created a route `/test_route` that redirects to a method called `section_1` in the `ApiProductController`.

2. **Parameterized Route**
   - Added a parameter to the route and Laravel automatically sends it to the controller. Example: `/test_route/{Your_Message}` and your message will return as a JSON response.

3. **Logging Middleware**
   - I created a middleware called `LogIncomingRequest` that logs details about incoming requests using Laravel's Log facade. Then, I protected the route with this middleware.

---

## Section 2: Product Model and Migration

1. **Product Model and Migration**
   - I created the `Product` model and migration file for the `products` table with the following fields:
     - `name` (varchar(50))
     - `price` (decimal)
     - `quantity` (decimal)

2. **Filter Products by Price**
   - I added a function to the model, `get_products_up_price`, to return all products greater than a specified price. This will be used later in the "get all products" method with a filter.

3. **Add `category_id` Column**
   - Created a migration file to add a new column `category_id` to the `products` table.

4. **Seeder for `category_id`**
   - Created a seeder to assign random values to the `category_id`.

---

## Section 3: User Authentication

1. **Laravel Breeze Authentication**
   - Implemented user authentication using Laravel Breeze.

2. **Custom Authentication Middleware**
   - Created custom middleware (`AuthMiddleware`) to check if a user is authenticated.

3. **Authorization Policy**
   - Added an authorization policy to manage user permissions.

---

## Section 4: RESTful API and Sanctum Integration

1. **RESTful Endpoint**
   - Created a RESTful endpoint to retrieve all products via `/api/products`. You can also provide a price filter like `?min_price=50` to get products with a price greater than 50.

2. **Pagination**
   - Implemented pagination for the results.

3. **Sanctum Integration**
   - Integrated Laravel Sanctum to secure the API endpoints using tokens.

4. **Custom Login & Logout Methods**
   - I created custom login and logout methods in the API to generate tokens if the credentials are valid. Sanctum generates a token for the user, which is sent as a bearer token in each request. On logout, the token is deleted.

---

## Section 5: Unit Testing

1. **Unit Test for Add Product**
   - Created a unit test for the `add_product` method and ensured the record was stored in the database using `assertDatabaseHas`.

---

## Section 6: Blade Templates and AJAX Integration

1. **Blade Template for Products**
   - Created a Blade template to display a list of products at `/products`.

2. **Form to Add Product**
   - Created a form at `/create_product` to add new products.

3. **AJAX Integration**
   - Integrated AJAX to add products without refreshing the page.

---

## Section 7: Stripe Integration

1. **Stripe Integration**
   - Integrated Stripe but the implementation is not yet complete.
