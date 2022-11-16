FROM nginx:stable-alpine

# ADD Custom Config
ADD ./docker/nginx/nginx.conf /etc/nginx/nginx.conf

# ADD Site configs
ADD ./docker/nginx/sites-enabled/ /etc/nginx/sites-enabled

# Make Directories - Workspace, Cloudflare
# Remove default nginx file. It's a trap (:
RUN mkdir -p /var/www/html \ 
    && mkdir -p /etc/cloudflare \
    && rm -rf /etc/nginx/conf.d/default.conf

ADD ./docker/nginx/certificates/ /etc/cloudflare

# ADD and set Group && chown work folder
RUN addgroup -g 1000 site && adduser -G site -g site -s /bin/sh -D site \
    && chown site:site /var/www/html