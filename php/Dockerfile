FROM php:8.1-fpm-alpine

# 時間指定
RUN apk --update add tzdata && \
    cp /usr/share/zoneinfo/Asia/Tokyo /etc/localtime && \
    apk del tzdata && \
    rm -rf /var/cache/apk/*

# Oniguruma正規表現エンジンインストール
# APKパッケージキャッシュを削除
RUN apk --update add oniguruma-dev && \
    rm -rf /var/cache/apk/*

# zip拡張モジュール
RUN apk --update add libzip-dev \
    &&  docker-php-ext-install zip

# MySql
RUN docker-php-ext-install pdo pdo_mysql mysqli mbstring && \
    docker-php-ext-install -j$(nproc) pdo_mysql

# PHP拡張モジュールインストール
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# gd xdebugインストール
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions gd xdebug

# composer のインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY php.ini-development /usr/local/etc/php/php.ini

WORKDIR /work

CMD ["php", "-S", "0.0.0.0:8000", "-t", "/work/public"]
