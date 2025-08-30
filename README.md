1. Сборка докера
   ````
docker-compose build
docker-compose up -d
docker exec -ti app /bin/bash
cp .env.example .env
php artisan key:generate
php artisan jwt:secret
php artisan migrate
php artisan db:seed

   ````
