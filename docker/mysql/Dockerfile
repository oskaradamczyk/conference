FROM mysql:latest

ENV MYSQL_ROOT_PASSWORD=secret

COPY custom.cnf /etc/mysql/conf.d/
RUN chmod 755 /etc/mysql/conf.d/custom.cnf
