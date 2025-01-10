# Coffee Shop Backend

Welcome to the Coffee Shop backend! This repository contains the server-side code for managing products, orders, and user profiles for our online coffee store. Built with Laravel, this API provides functionality for managing inventory, processing orders, and handling user data.

## Database Structure

The database consists of the following tables:

- **Profiles**: Stores user data, including whether the user is a customer or admin.
- **Orders**: Contains information about customer orders, including the total amount and status.
- **Products**: Stores information about products (e.g., coffee, ingredients) available in the shop.
- **Order_Items**: Contains details about individual items in an order.
- **Product_Recipes**: Stores the recipe for each product, including ingredients and their quantities.
- **Cup_Contents**: Stores the contents of each cup, linking products and ingredients.

## API Endpoints

The following endpoints are available:

### Authentication
- `GET /user`: Retrieves the authenticated user (requires authentication).

### Orders
- `GET /orders`: Retrieves a list of all orders.
- `GET /orders/{order_id}`: Retrieves a specific order's details.
- `POST /orders`: Creates a new order.
- `PUT /orders/{order_id}`: Updates the status of an order.
- `GET /orders/by-status`: Retrieves orders by their status.

### Order Items
- `GET /order_items`: Retrieves a list of all order items.
- `GET /order_items/{order_id}`: Retrieves the order items for a specific order.
- `POST /order_items`: Adds a new order item.
- `PUT /order_items/{order_id}`: Updates an order item.
- `DELETE /order_items/{order_id}`: Deletes an order item.

### Products
- `GET /products`: Retrieves a list of all products.
- `POST /products`: Adds a new product.
- `GET /products/{id}`: Retrieves details of a specific product.
- `PUT /products/{id}`: Updates a product.
- `DELETE /products/{id}`: Deletes a product.
- `GET /products/by-type`: Retrieves products by their type (e.g., coffee, equipment).

### Product Recipes
- `GET /product-recipes`: Retrieves a list of all product recipes.
- `POST /product-recipes`: Adds a new product recipe.
- `GET /product-recipes/{product}/{material}`: Retrieves a specific recipe.
- `PUT /product-recipes/{product}/{material}`: Updates a product recipe.
- `DELETE /product-recipes/{product}/{material}`: Deletes a product recipe.

### Users
- `GET /users`: Retrieves a list of all users.
- `GET /users/{id}`: Retrieves details of a specific user.
- `POST /users`: Creates a new user.
- `PUT /users/{id}`: Updates a user’s details.
- `DELETE /users/{id}`: Deletes a user.
- `GET /users/by-type`: Retrieves users by their type (e.g., customer, admin).
- `GET /users/{id}/orders`: Retrieves orders for a specific user.

### Cup Contents
- `GET /contents/{cup_id}`: Retrieves the contents of a specific cup.
- `POST /contents`: Adds content to a cup.
