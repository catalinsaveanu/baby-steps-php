#!/bin/bash
(
	export DEBIAN_FRONTEND=noninteractive

	touch /home/vagrant/.nano_history

	echo ""
	echo "### Updating & upgrading apt data"
	apt-get update
	apt-get upgrade

	echo "### Installing necessary packages"
	apt-get -q -y install htop git apache2 php5 php5-mysqlnd php-apc php5-mcrypt mysql-server-5.6 unzip php5-dev php5-gd php5-xdebug php5-curl php5-pgsql

	echo ""
	echo "### PHP settings"
	PHP_SETTINGS='
		session.gc_maxlifetime = 10800
		expose_php = Off
		post_max_size = 1024M
		upload_max_filesize = 1024M
	 	display_errors = On
	 	error_reporting = E_ALL
	'
	
	echo ""
	echo "### Configuring Apache Vhost"

	echo "${PHP_SETTINGS}" > /etc/php5/apache2/conf.d/90-babysteps.ini
	echo "ServerName babysteps.dev" | sudo tee /etc/php5/apache2/conf.d/fqdn

	sudo echo 127.0.0.1 babysteps.dev >> /etc/hosts
	sudo echo Listen 8060 >> /etc/apache2/ports.conf

	cat /var/www/babysteps/vagrant/config/apache-vhosts > /etc/apache2/sites-available/000-default.conf
	a2enmod rewrite
	service apache2 restart

	echo ""
	echo "### Bootstrap completed"

)
#2>&1 | logger -t vagrant.bootstrap
exit 0

