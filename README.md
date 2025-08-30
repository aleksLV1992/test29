Запуск проекта (Docker)

1. Сборка и запуск контейнеров

# Собрать образы
docker-compose build

# Запустить контейнеры в фоне
docker-compose up -d


2. Настройка Laravel

# Зайти в контейнер PHP
docker exec -it app bash

# Скопировать .env-файл
cp .env.example .env

# Сгенерировать ключ приложения
php artisan key:generate

# Сгенерировать JWT-секрет (если используется laravel/passport или tymon/jwt-auth)
php artisan jwt:secret

# Выполнить миграции базы данных
php artisan migrate

# Заполнить базу тестовыми данными (опционально)
php artisan db:seed


Примечания

- Убедитесь, что в docker-compose.yml сервис PHP называется "app".
  Если имя другое (например, laravel-app, php, backend), замените "app" в команде docker exec.

- Дождитесь полной инициализации базы данных (PostgreSQL/MySQL) при первом запуске.

- Для полной пересборки:
  docker-compose down --volumes
  docker-compose build --no-cache
  docker-compose up -d


Проверка работоспособности

Откройте в браузере:
http://localhost:8081  (или другой порт из docker-compose.yml)

Или проверьте API:
curl http://localhost:8081/api/user

