# Setup PHP.
FROM php:8.3 AS base

# Install relevant dependencies.
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    curl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Setup PCOV for code coverage.
RUN pecl install pcov

# Copy the application code.
COPY . /src

WORKDIR /src

# Install composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer
