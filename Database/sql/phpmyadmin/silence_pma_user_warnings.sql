CREATE USER 'pma'@'%' IDENTIFIED WITH mysql_native_password BY '***';
GRANT USAGE ON *.* TO 'pma'@'%' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;