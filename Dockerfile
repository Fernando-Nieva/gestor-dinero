FROM php:8.3-cli

WORKDIR /app

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libpng-dev \
    libzip-dev \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql bcmath gd zip

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

RUN npm install && npm run build

RUN composer install --optimize-autoloader --no-dev

CMD bash startup.sh