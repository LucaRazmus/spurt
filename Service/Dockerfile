FROM thruio/docker-webapp:latest
MAINTAINER Matthew Baggett <matthew@baggett.me>

# Copy application code into /app
ADD ./ /app

RUN rm -fr /var/www/html && ln -s /app/public /var/www/html

RUN sed -i "s/newrelic.appname.*/newrelic.appname = \"Spurt Service\"/g" /etc/php/7.0/apache2/conf.d/newrelic.ini && \
    sed -i "s/newrelic.license.*/newrelic.license = \"b58acebf4f003ef5f7c87ebd1175ced6fc4a62ef\"/g" /etc/php/7.0/apache2/conf.d/newrelic.ini

# Let composer do an install in /app, which may not be necessary.
RUN composer install && \
    composer dumpautoload -o
