FROM php:8.3-fpm

# Установка системных зависимостей
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    sqlite3 \
    npm \
    libsqlite3-dev \
    && rm -rf /var/lib/apt/lists/*

# Установка PHP-расширений
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
RUN docker-php-ext-install pdo_pgsql

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY package.json ./

# Копируем php.ini
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini
COPY package.json ./


WORKDIR /var/www

# Установка зависимостей
COPY composer.json composer.lock ./
COPY package.json ./
COPY vite.config.mjs ./

RUN composer install --no-dev --optimize-autoloader --no-scripts --no-progress
RUN npm config set strict-ssl false

# Копируем код
COPY . .

RUN composer run post-autoload-dump
RUN npm install
RUN npm run build
RUN chown -R www-data:www-data /var/www

EXPOSE 9000

CMD ["php-fpm"]
