FROM ${DEPENDENCY_PROXY}composer:latest AS composer
FROM ${DEPENDENCY_PROXY}php:8.1-fpm-alpine

ARG PUID=1000
ARG PGID=1000

RUN apk add --no-cache --virtual .build-deps \
        # for extensions
        $PHPIZE_DEPS \
    && \
    apk add --no-cache \
        bash \
    && \
    pecl install \
        # for coverage runs
        pcov \
    && \
    docker-php-ext-enable pcov \
    && \
    echo "pcov.enabled = 1" >> /usr/local/etc/php/conf.d/docker-php-ext-pcov.ini \
    && \
    apk del .build-deps \
    && \
    rm -rf /tmp/pear

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Add a non-root user to prevent files being created with root permissions on host machine.
RUN addgroup -g ${PGID} user && \
    adduser -u ${PUID} -G user -D user

RUN mkdir /opt/phpstorm-coverage \
    && chown user:user /opt/phpstorm-coverage

USER user
