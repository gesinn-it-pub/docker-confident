######################################
# docker-confident                   #
######################################

ARG OPENRESEARCH_STACK=0.0.32
FROM ghcr.io/gesinn-it-pub/openresearch-stack:${OPENRESEARCH_STACK}

# LocalSettings.Custom.php
ADD LocalSettings.Custom.php /var/www/html/

# Global styles
COPY mediawiki-global-styles/styles/* /var/www/html/resources/src/mediawiki.gesinn-it.global.styles/

# Media (do not use styles/* otherwise directory structure will be flattened)
COPY media /var/www/html/_custom/media

# Styles (do not use styles/* otherwise directory structure will be flattened)
COPY styles /var/www/html/_custom/styles

# ConfIDentSkin
ARG CONFIDENT_SKIN_VERSION=1.0.13
RUN get-github-extension.sh ConfIDentSkin $CONFIDENT_SKIN_VERSION gesinn-it-pub/ConfIDentSkin

######################################
# run as http://localhost:8080		 #
######################################
ENV WIKI_DOMAIN=localhost
ENV WIKI_PORT=8080

######################################
# set confident version     		 #
######################################
ARG CONFIDENT_VERSION=1.9.11
RUN echo $CONFIDENT_VERSION > confident-version.txt && \
    echo "\$wgConfidentVersion = '$CONFIDENT_VERSION';" >> LocalSettings.Include.php
