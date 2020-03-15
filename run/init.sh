#!/bin/bash

main() {
    waitForDatabase
    migrateDatabase
    startDockerEndpoint
}

waitForDatabase() {
    echo "Waiting for MySQL (db)"
    until mysql -h"$DB_HOST" -u"$DB_USERNAME" -p"$DB_PASSWORD"
    do
      printf "."
      sleep 1
    done
    echo -e "\nMySQL ready"
}

migrateDatabase() {
    cd /var/www/html
    php artisan migrate --force
}

startDockerEndpoint() {
    apache2-foreground
}

main
