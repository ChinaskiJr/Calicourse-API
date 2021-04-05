FROM httpd:2.4.46

# Copy apache vhost file to proxy php requests to php-fpm container
COPY apache.conf /usr/local/apache2/conf/calicourse.apache.conf

RUN echo "Include /usr/local/apache2/conf/calicourse.apache.conf" \
    >> /usr/local/apache2/conf/httpd.conf
