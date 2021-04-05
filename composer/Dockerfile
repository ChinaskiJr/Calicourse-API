FROM composer:1.8.4

RUN addgroup -g 1000 symfony && adduser -G symfony -g symfony -s /bin/sh -D symfony

USER symfony

WORKDIR /var/www/html

ENTRYPOINT [ "composer" ]
