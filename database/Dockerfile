FROM mysql:5.7

ENV MYSQL_ALLOW_EMPTY_PASSWORD="yes"
ENV MYSQL_DATABASE="polly"

ADD setup.sql /docker-entrypoint-initdb.d/
