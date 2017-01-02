#!/bin/bash

#export MYSQL_HOST=$DB_PORT_3306_TCP_ADDR;
export MYSQL_PWD=$MYSQL_ROOT_PASSWORD
echo "Importing base SQL database"

for f in /import/schemas/*.sql
do
  echo " > $f";
  mysql -u root < $f
done

for f in /import/phpmyadmin/*.sql
do
  echo " > $f";
  mysql -u root < $f
done

for f in /import/spurt/*.sql
do
  echo " > $f";
  mysql -u root spurt < $f
done


echo "Importing base SQL database COMPLETE"
