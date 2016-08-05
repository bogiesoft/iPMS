#!/bin/sh

cd storage
rm -f database.sqlite
touch database.sqlite
../artisan migrate
chmod 666 database.sqlite
cd ..
