#!/bin/bash

bash /src/wait-for-it.sh -h wiki.local -p 80 -t 120 && \
curl -L wiki.local > /dev/null && \
backstop $@
