FROM nginx:stable-alpine

RUN rm /etc/nginx/conf.d/default.conf
COPY ./compose/nginx/nginx.conf /etc/nginx/conf.d/default.conf
COPY ./compose/nginx/default.conf /etc/nginx/conf.d/default.conf

# Make Directory - Workspace
RUN mkdir -p /var/www/html

# ADD and set Group
RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel

# Set Group to Workspace
RUN chown laravel:laravel /var/www/html