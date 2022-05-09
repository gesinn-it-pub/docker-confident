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
RUN get-github-extension.sh ConfIDentSkin 1.0.7 gesinn-it-pub/ConfIDentSkin

# Temporarily (until https://github.com/ProfessionalWiki/chameleon/pull/332 merged):
RUN get-github-extension.sh chameleon 5fa26148d625054047ca2a36f448df3a49939e8a gesinn-it-pub/chameleon && \
    rm -rf skins/chameleon && \
    mv extensions/chameleon skins

######################################
# set confident version     		 #
######################################
ARG CONFIDENT_VERSION=0.0.16
RUN echo $CONFIDENT_VERSION > confident-version.txt && \
    echo "\$wgConfidentVersion = '$CONFIDENT_VERSION';" >> LocalSettings.Include.php
