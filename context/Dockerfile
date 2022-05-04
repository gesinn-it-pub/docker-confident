######################################
# docker-confident                   #
######################################

ARG OPENRESEARCH_STACK=0.0.10
FROM ghcr.io/gesinn-it-pub/openresearch-stack:${OPENRESEARCH_STACK}

# LocalSettings.Custom.php
ADD LocalSettings.Custom.php /var/www/html/

# Media
COPY media/* /var/www/html/_custom/media/

# Styles
COPY styles/* /var/www/html/_custom/styles/

# ConfIDentSkin
RUN get-github-extension.sh ConfIDentSkin 1.0.4 gesinn-it-pub/ConfIDentSkin

######################################
# set confident version     		 #
######################################
ARG CONFIDENT_VERSION=0.0.13
RUN echo $CONFIDENT_VERSION > confident-version.txt && \
    echo "\$wgConfidentVersion = '$CONFIDENT_VERSION';" >> LocalSettings.Include.php
