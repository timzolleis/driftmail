FROM nginx:stable-alpine

COPY driftmail.nginx.conf /etc/nginx/conf.d/default.conf

RUN ln -sf /dev/stdout /var/log/nginx/access.log \ && ln -sf /dev/stderr /var/log/nginx/error.log
