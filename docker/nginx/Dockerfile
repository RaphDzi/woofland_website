FROM node:22-alpine AS assets

WORKDIR /app

# Compilation des assets Vite servis ensuite par Nginx.
COPY package.json package-lock.json vite.config.js postcss.config.js tailwind.config.js ./
COPY resources ./resources

RUN npm ci && npm run build

FROM nginx:1.27-alpine

WORKDIR /var/www/html

# Copie du repertoire public et de la configuration du serveur web.
COPY public ./public
COPY --from=assets /app/public/build ./public/build
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

EXPOSE 80
