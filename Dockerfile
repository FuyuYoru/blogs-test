FROM php:8.2-fpm

# 1. Устанавливаем зависимости для PHP и сборки Node
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    libonig-dev \
    libzip-dev \
    zlib1g-dev \
    curl \
    unzip \
    git \
    gnupg \
    && docker-php-ext-install pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# 2. Устанавливаем Node.js и npm через NodeSource
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g sass \
    && rm -rf /var/lib/apt/lists/*

# 3. Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Рабочая директория
WORKDIR /var/www

# 5. Копируем entrypoint
COPY docker/php-entrypoint.sh /usr/local/bin/php-entrypoint.sh
RUN chmod +x /usr/local/bin/php-entrypoint.sh

# 6. Задаём entrypoint
ENTRYPOINT ["php-entrypoint.sh"]