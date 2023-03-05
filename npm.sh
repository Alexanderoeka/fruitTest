#!/usr/bin/env bash


docker compose exec -ti node npm $@


#DOCKER_COMPOSE_EXIST=$(which docker-compose)
#
#if [ -z "$DOCKER_COMPOSE_EXIST" ]; then
#  docker compose exec node yarn $@
#else
#  docker-compose exec node yarn $@
#fi