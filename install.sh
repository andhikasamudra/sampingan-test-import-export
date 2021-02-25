# install dependencies
composer install
# copy environment file
cp .env.example .env
# generate secret key
php artisan key:generate
# running migration
php artisan migrate
# running seeder
php artisan db:seed
