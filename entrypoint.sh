#!/bin/bash

# Run migrations
php artisan migrate --seed

# Start the Laravel application with `php artisan serve`
php artisan serve --host=0.0.0.0 --port=8000
