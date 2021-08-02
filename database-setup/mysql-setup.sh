#!/usr/bin/env bash

# Update Ubuntu software packages.
apt-get update

#Define some of the shell variables used to define database
# CHANGE THESE FOR SECURITY
export DBHOST='localhost'
export DBNAME='webdatabase'
export DBUSER='root'
export DBPASSWD='root'

export MYSQL_PWD='root'

# Ensure MYSQL doens't ask for password upon installation
echo "mysql-server mysql-server/root_password password $MYSQL_PWD" | debconf-set-selections 
echo "mysql-server mysql-server/root_password_again password $MYSQL_PWD" | debconf-set-selections

# Install the MySQL database server.
apt-get -y install mysql-server

# Create the web database
echo "CREATE DATABASE $DBNAME;" | mysql

# Create the user to access the database
echo "CREATE USER '$DBUSER'@'%' IDENTIFIED BY '$DBPASSWD';" | mysql

# Grant all permissions to the database user
echo "GRANT ALL PRIVILEGES ON $DBNAME.* TO '$DBUSER'@'%';" | mysql

# Use a sql script to create all of the tables we need
cat /vagrant/database-setup/setup-database.sql | mysql -u $DBUSER $DBNAME 

# Load the inital webadmin credentials into the admin table
echo "LOAD DATA LOCAL INFILE '/vagrant/database-setup/admins.secret' INTO TABLE admin FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' (username, passwd)" | mysql -u $DBUSER $DBNAME

# Load some initial game modes into the database
echo "LOAD DATA LOCAL INFILE '/vagrant/database-setup/gamemodes.data' INTO TABLE gamemode FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' (gametype,width,height,bomb_ratio)" | mysql -u $DBUSER $DBNAME


# Allow access to database from outside hosts using bind-address
# Note this is a security hole, we should really make this more local
# But having only private interfaces is good enough for now
sed -i'' -e '/bind-address/s/127.0.0.1/0.0.0.0/' /etc/mysql/mysql.conf.d/mysqld.cnf

# We then restart the MySQL server 
service mysql restart