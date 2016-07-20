#!/bin/bash

cd litapp
docker build --no-cache -t litapp .
docker stop litapp-container && docker rm litapp-container
sleep 1
docker run --name litapp-container -d -p 80:80 litapp
