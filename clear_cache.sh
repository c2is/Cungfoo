#!/bin/sh
#
# 2013-08-14
# @GSP: vide le cache
#

echo "connected to $(uname -n)"
cd /var/www/local/virtualdomains/343/vacances-directes.com/current && rm -rf app/cache/*
#php -d memory_limit=256M ./console cache:clear
echo 'Cache cleared.'