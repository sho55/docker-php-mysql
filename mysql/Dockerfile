FROM mysql:5.7
RUN touch /var/log/mysql/mysqld.log # ログの置き場所を作る
FROM alpine:latest

RUN apk update && \
    apk add mysql-client