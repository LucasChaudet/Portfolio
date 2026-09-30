FROM nginx:alpine

# Copier le site dans le dossier servi par Nginx
COPY . /usr/share/nginx/html

EXPOSE 80

# Vérifier que le site répond
HEALTHCHECK --interval=30s --timeout=3s --retries=3 \
  CMD wget -q --spider http://localhost/ || exit 1