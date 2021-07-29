# -*- mode: ruby -*-
# vi: set ft=ruby :

# A Vagrantfile to set up two VMs, a webserver and a database server,
# connected together using an internal network with manually-assigned
# IP addresses for the VMs.

Vagrant.configure("2") do |config|
  # All of our VMs will use this box, to save on space/cache
  config.vm.box = "ubuntu/xenial64"

  # Let's configure the user-facing webserver first
  config.vm.define "webserver" do |webserver|
    webserver.vm.hostname = "webserver"
    
    # Forward the ports 127.0.0.1:8080 to this VMs port 80 (the HTTP port for the apache server later)
    webserver.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"
    
    # Set a private network for these VMs to communicate with one another
    # These will all be on 192.168.2.0/24
    webserver.vm.network "private_network", ip: "192.168.2.11"

    # The following line is for consistency for assignment markers in the CS labs
    webserver.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]

    # Provision this webserver by running the following lines in the VM shell at startup
    webserver.vm.provision "shell", inline: <<-SHELL
      #Update the software on the VM
      apt-get update
      #Install apache2, the webserver for this VM
      apt-get install -y apache2 php libapache2-mod-php php-mysql
            
      # Set our webserver to use the config file in the shared (root) directory
      cp /vagrant/usersite.conf /etc/apache2/sites-available/
      # activate our website configuration
      a2ensite usersite
      # and disable the default website provided with Apache
      a2dissite 000-default
      # Reload the webserver configuration, to pick up our changes
      service apache2 reload
    SHELL
  end

  # Configure the database VM
  config.vm.define "dbserver" do |dbserver|
    dbserver.vm.hostname = "dbserver"
    # Create a private network IP address to communivate with other VMs
    dbserver.vm.network "private_network", ip: "192.168.2.12"

    # The following line is for consistency for assignment markers in the CS labs
    dbserver.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]
    
    dbserver.vm.provision "shell", inline: <<-SHELL
      # Update Ubuntu software packages.
      apt-get update
      
      # We create a shell variable MYSQL_PWD that contains the MySQL root password
      export MYSQL_PWD='insecure_mysqlroot_pw'

      # If you run the `apt-get install mysql-server` command
      # manually, it will prompt you to enter a MySQL root
      # password. The next two lines set up answers to the questions
      # the package installer would otherwise ask ahead of it asking,
      # so our automated provisioning script does not get stopped by
      # the software package management system attempting to ask the
      # user for configuration information.
      echo "mysql-server mysql-server/root_password password $MYSQL_PWD" | debconf-set-selections 
      echo "mysql-server mysql-server/root_password_again password $MYSQL_PWD" | debconf-set-selections

      # Install the MySQL database server.
      apt-get -y install mysql-server

      # Run some setup commands to get the database ready to use.
      # First create a database.
      echo "CREATE DATABASE fvision;" | mysql

      # Then create a database user "webuser" with the given password.
      echo "CREATE USER 'webuser'@'%' IDENTIFIED BY 'insecure_db_pw';" | mysql

      # Grant all permissions to the database user "webuser" regarding
      # the "fvision" database that we just created, above.
      echo "GRANT ALL PRIVILEGES ON fvision.* TO 'webuser'@'%'" | mysql
      
      # Set the MYSQL_PWD shell variable that the mysql command will
      # try to use as the database password ...
      export MYSQL_PWD='insecure_db_pw'

      # ... and run all of the SQL within the setup-database.sql file,
      # which is part of the repository containing this Vagrantfile, so you
      # can look at the file on your host. The mysql command specifies both
      # the user to connect as (webuser) and the database to use (fvision).
      cat /vagrant/setup-database.sql | mysql -u webuser fvision

      # By default, MySQL only listens for local network requests,
      # i.e., that originate from within the dbserver VM. We need to
      # change this so that the webserver VM can connect to the
      # database on the dbserver VM. Use of `sed` is pretty obscure,
      # but the net effect of the command is to find the line
      # containing "bind-address" within the given `mysqld.cnf`
      # configuration file and then to change "127.0.0.1" (meaning
      # local only) to "0.0.0.0" (meaning accept connections from any
      # network interface).
      sed -i'' -e '/bind-address/s/127.0.0.1/0.0.0.0/' /etc/mysql/mysql.conf.d/mysqld.cnf

      # We then restart the MySQL server to ensure that it picks up
      # our configuration changes.
      service mysql restart
    SHELL
  end

  # Finally the admin web-server
  config.vm.define "adminserver" do |adminserver|
    adminserver.vm.hostname = "adminserver"
    
    # Forward the ports 127.0.0.1:8081 to this VMs port 80 (the HTTP port for the apache server later)
    adminserver.vm.network "forwarded_port", guest: 80, host: 8081, host_ip: "127.0.0.1"
    
    # Another IP address on the private network
    adminserver.vm.network "private_network", ip: "192.168.2.13"

    # The following line is for consistency for assignment markers in the CS labs
    adminserver.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]

    # Provision this webserver by running the following lines in the VM shell at startup
    adminserver.vm.provision "shell", inline: <<-SHELL
      #Update the software on the VM
      apt-get update
      #Install apache2, the webserver for this VM
      apt-get install -y apache2 php libapache2-mod-php php-mysql
            
      # Set our webserver to use the config file in the shared (root) directory
      cp /vagrant/adminsite.conf /etc/apache2/sites-available/
      # activate our website configuration
      a2ensite adminsite
      # and disable the default website provided with Apache
      a2dissite 000-default
      # Reload the webserver configuration, to pick up our changes
      service apache2 reload
    SHELL
  end

end

#  LocalWords:  webserver xenial64
