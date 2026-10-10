FROM php:8.3-apache

RUN docker-php-ext-install mysqli pdo_mysql

COPY . /var/www/html/
COPY render-entrypoint.sh /usr/local/bin/render-entrypoint
RUN chmod +x /usr/local/bin/render-entrypoint

EXPOSE 10000

CMD ["sh", "/usr/local/bin/render-entrypoint"]
