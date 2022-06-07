set ENV vars (url, port, DB creds)
npm install
composer install
php artisan migrate:fresh --seed
npm run dev

Creds to login as user:
    login: user@user.com
    password: 12345678

Creds to login as admin:
    login: admin@admin.com
    password: 12345678
