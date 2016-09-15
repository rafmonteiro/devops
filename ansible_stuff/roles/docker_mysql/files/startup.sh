#!/bin/bash


if [ ! -f /var/lib/mysql/ibdata1 ]; then
	mysql_install_db

	/usr/bin/mysqld_safe &
	sleep 10s

	echo "GRANT ALL ON *.* TO admin@'%' IDENTIFIED BY 'password' WITH GRANT OPTION; FLUSH PRIVILEGES" | mysql
    echo "create database dockerapp" | mysql
	killall mysqld
	sleep 10s
fi
service syslog-ng restart
/usr/bin/mysqld_safe