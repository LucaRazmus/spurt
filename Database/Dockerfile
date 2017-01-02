FROM mysql:latest

ADD sql/. /import
ADD sqlimport.sh        /docker-entrypoint-initdb.d/sqlimport.sh
