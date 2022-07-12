######################################
# docker-confident                   #
######################################

ARG OPENRESEARCH_STACK=0.0.14
FROM ghcr.io/gesinn-it-pub/openresearch-stack:${OPENRESEARCH_STACK}

# LocalSettings.Custom.php
ADD LocalSettings.Custom.php /var/www/html/

# Media (do not use styles/* otherwise directory structure will be flattened)
COPY media /var/www/html/_custom/media

# Styles (do not use styles/* otherwise directory structure will be flattened)
COPY styles /var/www/html/_custom/styles

# ConfIDentSkin
ARG CONFIDENT_SKIN_VERSION=1.0.9
RUN get-github-extension.sh ConfIDentSkin $CONFIDENT_SKIN_VERSION gesinn-it-pub/ConfIDentSkin

# Temporarily (until 4.2.0 released):
RUN get-github-extension.sh chameleon 8dcd3b7200f7fe3259e543173ed6da0a262e8972 ProfessionalWiki/chameleon && \
    rm -rf skins/chameleon && \
    mv extensions/chameleon skins

######################################
# run as http://localhost:8080		 #
######################################
ENV WIKI_DOMAIN=localhost
ENV WIKI_PORT=8080

######################################
# set confident version     		 #
######################################
ARG CONFIDENT_VERSION=1.5.0
RUN echo $CONFIDENT_VERSION > confident-version.txt && \
    echo "\$wgConfidentVersion = '$CONFIDENT_VERSION';" >> LocalSettings.Include.php
