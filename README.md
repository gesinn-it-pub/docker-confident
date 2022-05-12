# docker-confident

Build a local ConfIDent Docker image (on top of [docker-openresearch-stack](https://github.com/gesinn-it-pub/docker-openresearch-stack))

## Getting started

The most simple form of running the ConfIDent Docker image is

```
> docker run --rm -p 8080:80 ghcr.io/gesinn-it-pub/confident:latest
```

> Note that you **must** use 8080 as host port here.

In this case, the Wiki is using an SQLite dabatase (which is not persisted between runs!) and Elasticsearch is not available. Now navigate to http://localhost:8080.

The following docker-compose file is an example of a more elaborate scenario:

```yml
version: '3'

services:

  wiki:
    image: ghcr.io/gesinn-it-pub/confident:latest
    ports:
      - '8080:80'
    volumes:
      - wiki:/data
      - images:/var/www/html/images
    environment:
      - WIKI_DOMAIN=localhost
      - WIKI_PORT=8080 # must be the same as in ports above
      - ELASTICSEARCH_HOST=elasticsearch
      - MYSQL_HOST=mysql

  elasticsearch:
    image: elasticsearch:6.8.23
    volumes:
      - elasticsearch:/usr/share/elasticsearch/data
    environment:
      - discovery.type=single-node
      - "ES_JAVA_OPTS=-Xms512m -Xmx512m"

  mysql:
    image: mysql:5
    volumes:
      - mysql:/var/lib/mysql
    environment:
      MYSQL_ROOT_PASSWORD: database

volumes:
  wiki:
  images:
  elasticsearch:
  mysql:
```

Save this file as `docker-compose.yml` and start the services using

```shell
> docker-compose up -d
```

Watch the Wiki installation by

```shell
> docker-compose logs -f
```

The Wiki is using a MySQL database and has Elasticsearch enabled.
Moreover, alle the data is persisted after

```shell
> docker-compose down
```

## Update

To update the openresearch-stack base image, set the version in `context/Dockerfile`:

```Dockerfile
ARG OPENRESEARCH_STACK=2.3.1
```

To update the ConfIDent skin, set the version in `context/Dockerfile`:

```Dockerfile
ARG CONFIDENT_SKIN_VERSION=1.0.7
```

## Test

[BackstopJS](https://github.com/garris/BackstopJS) is used to perform visual regression tests
by comparing DOM screenshots over time. To run BackstopJS, execute

```shell
> make ci
```

Afterwards, the BackstopJS Report is avaiable at `backstop/backstop_data/html_report/index.html`.
To accept the result of the last run as the new reference for future tests, execute

```shell
> make backstop-approve
```

and commit your changes to the repository.

## Release

-   Set the version in `context/Dockerfile` following the [Semantic Versioning Specification](https://semver.org/):
    ```Dockerfile
    ARG CONFIDENT_VERSION=5.1.0-alpha1
    ```
-   Commit your changes with comment "prepared <CONFIDENT_VERSION>"
-   Start a new "release" in GitHub. This will
    -   run the CI process,
    -   build the Docker image,
    -   and release the image with the correct version tagged
