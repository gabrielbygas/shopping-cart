# Shopping Cart Application

A modern e-commerce shopping cart application built with Laravel 12, Livewire 3, and Tailwind CSS.

## Author

**Gabriel KALALA**  
📧 Email: [gabrielkalala@protonmail.com](mailto:gabrielkalala@protonmail.com)

## Features

- 🛍️ Product browsing and listing
- 🛒 Interactive shopping cart management
- 👤 User authentication and authorization
- ⚡ Real-time cart updates with Livewire
- 🎨 Modern UI with Tailwind CSS
- 📱 Responsive design
- 📦 Stock management and validation
- 📧 Low stock notification system (queue-based)
- 🔄 Real-time quantity updates

## Tech Stack

- **Backend:** Laravel 12 (PHP 8.2+)
- **Frontend:** Livewire 3, Volt, Tailwind CSS 3
- **Authentication:** Laravel Breeze
- **Database:** SQLite (configurable)
- **Build Tool:** Vite
- **Testing:** Pest PHP

## Requirements

- PHP 8.2 or higher
- Composer
- Node.js & NPM
- SQLite (or another database of your choice)

## Installation

### Quick Setup

Run the automated setup script:

```bash
composer setup
```

This will:
- Install PHP dependencies
- Create `.env` file from `.env.example`
- Generate application key
- Run database migrations
- Install Node.js dependencies
- Build frontend assets

### Manual Setup

If you prefer to set up manually:

```bash
# Install PHP dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Install Node.js dependencies
npm install

# Build assets
npm run build
```

## Configuration

1. Update your `.env` file with your database credentials and other settings
2. Configure your mail settings if needed
3. Set your application URL

## Development

Start the development server with all services running:

```bash
composer dev
```

This command runs:
- Laravel development server (port 8000)
- Queue worker
- Application logs (Pail)
- Vite development server

Alternatively, run services individually:

```bash
# Start Laravel server
php artisan serve

# Start Vite development server
npm run dev

# Watch queue jobs
php artisan queue:listen

# Watch application logs
php artisan pail
```

## Testing

Run the test suite:

```bash
composer test
```

Or directly with Pest:

```bash
php artisan test
```

## Project Structure

```
app/
├── Livewire/          # Livewire components
│   ├── ProductList.php
│   └── CartManager.php
├── Models/            # Eloquent models
│   ├── User.php
│   ├── Product.php
│   └── Cart.php
└── ...

routes/
└── web.php           # Application routes

resources/
└── views/            # Blade templates

database/
├── migrations/       # Database migrations
└── factories/        # Model factories
```

## Key Routes

- `/` - Product listing (homepage)
- `/products` - Product listing
- `/cart` - Shopping cart (requires authentication)
- `/dashboard` - User dashboard (requires authentication)
- `/profile` - User profile (requires authentication)

## Main Functions

### Product Management
- **Product Listing**: Display all products with available stock
- **Stock Validation**: Real-time stock checking before adding to cart
- **Product Filtering**: Shows only products with stock > 0

### Cart Operations
- **Add to Cart**: Add products with quantity validation
  - Checks user authentication
  - Validates available stock
  - Updates existing cart items or creates new ones
  - Triggers low stock notifications (≤ 5 items)
  
- **Update Quantity**: Modify product quantities in cart
  - Real-time stock validation
  - Prevents over-ordering
  
- **Remove from Cart**: Delete items from shopping cart
  
- **View Cart**: Display all cart items with product details and totals

### Background Jobs
- **Low Stock Notifications**: Queued email notifications when product stock ≤ 5 units

## Information Flow

```
┌─────────────────────────────────────────────────────────────────┐
│                        User Interface                            │
│                     (Livewire Components)                        │
└─────────────────────────────────────────────────────────────────┘
                              │
                              ▼
┌─────────────────────────────────────────────────────────────────┐
│                      Product Browsing Flow                       │
├─────────────────────────────────────────────────────────────────┤
│  1. User visits homepage (/)                                     │
│  2. ProductList Component loads                                  │
│  3. Query products WHERE stock_quantity > 0                      │
│  4. Display products to user                                     │
└─────────────────────────────────────────────────────────────────┘
                              │
                              ▼
┌─────────────────────────────────────────────────────────────────┐
│                     Add to Cart Flow                             │
├─────────────────────────────────────────────────────────────────┤
│  1. User clicks "Add to Cart"                                    │
│  2. Check authentication (redirect to login if not authenticated)│
│  3. ProductList calls CartService->addToCart()                   │
│  4. CartService validates:                                       │
│     ├─ Product exists?                                           │
│     ├─ Stock available?                                          │
│     └─ User already has item in cart?                            │
│  5. If stock ≤ 5: Dispatch LowStockNotificationJob → Queue      │
│  6. Create or update Cart record in database                     │
│  7. Dispatch 'cart-updated' event                                │
│  8. Show success/error message                                   │
└─────────────────────────────────────────────────────────────────┘
                              │
                              ▼
┌─────────────────────────────────────────────────────────────────┐
│                      Cart Management Flow                        │
├─────────────────────────────────────────────────────────────────┤
│  1. User navigates to /cart (requires auth)                      │
│  2. CartManager Component loads                                  │
│  3. CartService->getCart() fetches user's cart items             │
│  4. Display cart with products and quantities                    │
│                                                                  │
│  Update Quantity:                                                │
│  ├─ User changes quantity                                        │
│  ├─ CartService->updateQuantity()                                │
│  ├─ Validate stock availability                                  │
│  ├─ Update Cart record                                           │
│  └─ Dispatch 'cart-updated' event                                │
│                                                                  │
│  Remove Item:                                                    │
│  ├─ User clicks remove                                           │
│  ├─ CartService->removeFromCart()                                │
│  ├─ Delete Cart record                                           │
│  └─ Dispatch 'cart-updated' event                                │
└─────────────────────────────────────────────────────────────────┘
                              │
                              ▼
┌─────────────────────────────────────────────────────────────────┐
│                      Background Processing                       │
├─────────────────────────────────────────────────────────────────┤
│  Queue: 'emails'                                                 │
│  Job: LowStockNotificationJob                                    │
│  Trigger: When product stock ≤ 5                                 │
│  Action: Send low stock alert notification                       │
└─────────────────────────────────────────────────────────────────┘
```

## Architecture Components

### Models
- **User**: Manages user accounts and authentication
  - Relationship: `hasMany(Cart)`
  
- **Product**: Stores product information
  - Fields: `id` (UUID), `name`, `price`, `stock_quantity`, `image_url`
  - Relationship: `hasMany(Cart)`
  
- **Cart**: Junction table for user shopping carts
  - Fields: `id` (UUID), `user_id`, `product_id`, `quantity`
  - Relationships: `belongsTo(User)`, `belongsTo(Product)`

### Services
- **CartService**: Business logic for cart operations
  - `addToCart()`: Add/update products in cart
  - `updateQuantity()`: Modify cart item quantity
  - `removeFromCart()`: Delete cart item
  - `getCart()`: Retrieve user's cart items

### Livewire Components
- **ProductList**: Displays products and handles add-to-cart action
- **CartManager**: Manages cart display and user interactions

### Jobs
- **LowStockNotificationJob**: Queued job for sending stock alerts

## Data Validation Rules

1. **Stock Validation**: Always check `stock_quantity` before cart operations
2. **Authentication**: Cart operations require authenticated users
3. **Quantity Limits**: Cannot add more than available stock
4. **Low Stock Threshold**: Notifications triggered at ≤ 5 units
5. **UUID Primary Keys**: All models use UUIDs for security

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
