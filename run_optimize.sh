#!/bin/sh

rm -f bootstrap/cache/*.php
rm -f public/cache/*
rm -f storage/logs/*
artisan view:clear
artisan clear-compiled
artisan config:cache
artisan route:cache
artisan optimize --force
