FROM nginx:stable-alpine3.20-perl

ENV NGINNXUSER=laravel
ENV NGINNXGROUP=laravel

RUN mkdir -p /var/www/html/public

ADD nginx/default.conf /etc/nginx/conf.d/default.conf

RUN sed -i "s/user www-data/user ${NGINNXUSER}/g" /etc/nginx/nginx.conf

RUN adduser -g ${NGINNXGROUP} -s /bin/sh -D ${NGINNXUSER}
