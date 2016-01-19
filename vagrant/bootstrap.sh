#!/bin/bash
(
	export DEBIAN_FRONTEND=noninteractive

	touch /home/vagrant/.nano_history

	export LANGUAGE=en_US.UTF-8
	export LANG=en_US.UTF-8
	export LC_ALL=en_US.UTF-8
	locale-gen en_US.UTF-8
	dpkg-reconfigure locales

	echo ""
	echo "### Updating & upgrading apt data"
	apt-get update -y
	apt-get upgrade -y

	sudo apt-get install -y apache2 git

	sudo apt-get install -y python-software-properties
	sudo LC_ALL=en_US.UTF-8 add-apt-repository -y ppa:ondrej/php
	sudo apt-get update -y
	sudo apt-get install -y -f php7.0

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
	echo "${PHP_SETTINGS}" > /etc/php/7.0/apache2/conf.d/90-babysteps.ini

	echo ""
	echo "### Configuring Apache Vhost"
	echo "ServerName babysteps.dev" >> /etc/apache2/apache2.conf
	echo "ServerName babysteps.dev" | sudo tee /etc/apache2/conf-available/fqdn.conf

	sudo echo 127.0.0.1 babysteps.dev >> /etc/hosts
	sudo echo Listen 8060 >> /etc/apache2/ports.conf

	cat /var/www/babysteps/vagrant/config/apache-vhosts > /etc/apache2/sites-available/000-default.conf
	a2enmod rewrite
	service apache2 restart

	echo ""
	echo "### Installing mysql server 5.6"
	sudo apt-get update -y
	sudo DEBIAN_FRONTEND=noninteractive apt-get install -y -f mysql-server-5.6
	sudo mysql -u root -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY '' WITH GRANT OPTION; FLUSH PRIVILEGES;"

	echo ""
	echo "### Bootstrap completed"

)
#2>&1 | logger -t vagrant.bootstrap
exit 0

