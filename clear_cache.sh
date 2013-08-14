#!/bin/sh
#
# 2013-08-14
# @GSP: vide le cache des frontaux en prod
#		ou le front en preprod
#
server_name="$(uname -n)"
if [ "$server_name" = "web04.vacancesdirectes-prod.resalys.com"\
  -o "$server_name" = "web05.vacancesdirectes-prod.resalys.com" ]
then
	echo 'connecting to web04'
	ssh web04.vacancesdirectes-prod.resalys.com "
	  cd /var/www/local/virtualdomains/343/vacances-directes.com/current && rm -rf app/cache/*
	  php -d memory_limit=256M ./console cache:clear
	  exit
	"
	echo 'connecting to web05'
	ssh web05.vacancesdirectes-prod.resalys.com "
	  cd /var/www/local/virtualdomains/343/vacances-directes.com/current && rm -rf app/cache/*
	  php -d memory_limit=256M ./console cache:clear
	  exit
	"
	echo 'done'
else
	rm -rf app/cache/*
	php -d memory_limit=256M ./console cache:clear
fi