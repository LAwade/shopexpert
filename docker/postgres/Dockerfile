FROM postgres:13-alpine

COPY ./backup/dump_data.sql /docker-entrypoint-initdb.d/dump_data.sql

EXPOSE 5432