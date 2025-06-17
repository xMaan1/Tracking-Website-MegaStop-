

# MegaStop Order Tracking System

A comprehensive order tracking system for e-commerce businesses to track orders, monitor profits, and analyze business performance.

## Deployment Instructions for StackCP

Follow these steps to deploy the MegaStop Tracking Website on StackCP:

### Pre-deployment Setup

1. **Compile Assets**: Make sure all assets are compiled before deployment
   ```
   npm install
   npm run build
   ```

2. **Verify Build Folder**: The `public/build` directory should contain:
   - `manifest.json`
   - `assets/` directory with CSS and JS files

### Deployment Steps on StackCP

1. **Upload Files**:
   - Upload all files to your StackCP hosting account
   - Make sure the `public` folder is set as your web root

2. **Environment Configuration**:
   - Copy `.env.production` to `.env` on the server
   - Update the following values in `.env`:
     - `APP_KEY`: Generate a new key using `php artisan key:generate`
     - `APP_URL`: Set this to your actual domain
     - `DB_DATABASE`: Set the absolute path to your SQLite database

3. **Database Setup**:
   - Create the database directory if it doesn't exist
   - Make sure the storage directory is writable: `chmod -R 775 storage`
   - Run migrations: `php artisan migrate`
   - Seed the database: `php artisan db:seed`

4. **File Permissions**:
   - Set proper permissions:
     ```
     chmod -R 775 storage bootstrap/cache
     chown -R www-data:www-data .
     ```

5. **Final Steps**:
   - Clear cache: `php artisan optimize:clear`
   - Generate optimized files: `php artisan optimize`

### Troubleshooting

- If you encounter 500 errors, check the logs in `storage/logs/laravel.log`
- Make sure your SQLite database file has proper permissions
- If assets are not loading, verify that the asset paths in your `.env` file are correct

## Features

- Order tracking with status updates
- Financial dashboard with profit analysis
- Ad spend tracking
- Support for returned orders
- Delivery charge calculation

## License

The MegaStop Order Tracking System is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).