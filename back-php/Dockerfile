#syntax=docker/dockerfile:1.4

# Versions
# hadolint ignore=DL3007
FROM composer/composer:2-bin as composer_upstream
FROM php:8-fpm-alpine as phpserver

WORKDIR /app

# persistent / runtime deps
# hadolint ignore=DL3018
RUN apk add --no-cache \
		acl \
		file \
		freetype \
		freetype-dev \
		gettext \
		git \
		icu-dev \
		libjpeg-turbo \
		libjpeg-turbo-dev \
		libpng \
		libpng-dev \
		libxslt \
		libzip-dev \
		nginx \
		nodejs \
		npm \
		yarn \
		zip \
	;

RUN set -eux; \
	docker-php-ext-install \
		bcmath \
		pdo_mysql \
		opcache \
		zip \
	;

RUN docker-php-ext-configure intl && docker-php-ext-install intl && docker-php-ext-enable intl

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) \
	&& docker-php-ext-install -j${NPROC} gd \
	&& apk del --no-cache freetype-dev libpng-dev libjpeg-turbo-dev

COPY --link nginx.conf /etc/nginx/nginx.conf
COPY --link php.ini /usr/local/etc/php/conf.d/local.ini
COPY --link --chmod=755 docker/docker-entrypoint.sh /usr/local/bin/docker-entrypoint

ENTRYPOINT ["docker-entrypoint"]

# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="${PATH}:/root/.composer/vendor/bin"

COPY --from=composer_upstream --link /composer /usr/bin/composer

HEALTHCHECK --start-period=60s CMD curl -f http://localhost:2019/metrics || exit 1

ENV APP_ENV=prod

COPY --link composer.* symfony.* package.json yarn.lock ./
RUN set -eux; \
	composer install --no-cache --prefer-dist --no-dev --no-autoloader --no-scripts --no-progress \
	&& yarn install \
	;

COPY --link . ./
RUN yarn build

EXPOSE 80

RUN set -eux; \
	mkdir -p var/cache var/log; \
	composer dump-autoload --classmap-authoritative --no-dev; \
	composer dump-env prod; \
	composer run-script --no-dev post-install-cmd; \
	chmod +x bin/console; sync;
