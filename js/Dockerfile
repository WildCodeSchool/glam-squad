#syntax=docker/dockerfile:1.4

# Versions
FROM node:20.9-alpine AS node_upstream

# Base stage for dev and build
FROM node_upstream AS base

# Check https://github.com/nodejs/docker-node/tree/b4117f9333da4138b03a546ec926ef50a31506c3#nodealpine to understand why libc6-compat might be needed.
# hadolint ignore=DL3018
RUN apk add --no-cache libc6-compat

WORKDIR /srv/app

COPY package.json .
COPY backend/package.json backend/
COPY frontend/package.json frontend/el-touncho-mdb-react-ui-kit.tgz frontend/plugins frontend/

RUN npm install

COPY --link . ./

EXPOSE 5173
EXPOSE 3000

COPY --link --chmod=755 docker/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
ENTRYPOINT ["docker-entrypoint"]
