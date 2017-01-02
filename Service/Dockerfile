FROM thruio/docker-webapp:latest

RUN apt-get update && apt-get install -y \
		git \
		unzip \
		curl \
	--no-install-recommends && rm -r /var/lib/apt/lists/*
RUN curl -sL https://deb.nodesource.com/setup_6.x | bash -
RUN apt-get update && apt-get install -y \
		nodejs \
		ruby \
	--no-install-recommends && rm -r /var/lib/apt/lists/*

# Copy application code into /app
ADD ./ /app

RUN rm -fr /var/www/html && ln -s /app/public /var/www/html

RUN sed -i "s/newrelic.appname.*/newrelic.appname = \"Spurt Service\"/g" /etc/php/7.0/apache2/conf.d/newrelic.ini && \
    sed -i "s/newrelic.license.*/newrelic.license = \"b58acebf4f003ef5f7c87ebd1175ced6fc4a62ef\"/g" /etc/php/7.0/apache2/conf.d/newrelic.ini

RUN gem install sass

# Let composer do an install in /app, which may not be necessary.
RUN composer install && \
    composer dumpautoload -o && \
    npm install && \
    ./node_modules/grunt/bin/grunt prod