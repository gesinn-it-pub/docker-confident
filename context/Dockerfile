######################################
# docker-confident                   #
######################################

ARG OPENRESEARCH_STACK=0.0.5
FROM ghcr.io/gesinn-it-pub/openresearch-stack:${OPENRESEARCH_STACK}

# LocalSettings.Custom.php
ADD LocalSettings.Custom.php /var/www/html/

# Media
COPY media/* /var/www/html/_custom/media/

# ConfIDentSkin
# RUN get-github-extension.sh ConfIDentSkin main gesinn-it-pub/confident-skin
