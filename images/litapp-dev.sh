#!/bin/bash
# Starts litapp in a container operating on your local litapp repository,
# i.e., the changes you apply are reflected immediately in the container.

cd litapp-dev

# if litapp dev container is not available locally, build it
if docker images | grep "litapp\s*dev"
then
  echo
else
  printf "building litapp:dev...\n"
  docker build -t litapp:dev .
fi

# run litapp-dev
printf "starting litapp:dev...\n"
docker run --name litapp-dev -d -p 80:80 -v $PWD/../../litapp:/app litapp:dev
