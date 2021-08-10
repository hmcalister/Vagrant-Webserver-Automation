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
      apt-get install -y nginx php php-fpm php-mysql
            
      # Set our webserver to use the config file in the shared (root) directory
      cp /vagrant/usersite /etc/nginx/sites-available/
      # activate our website configuration
      ln -s /etc/nginx/sites-available/usersite /etc/nginx/sites-enabled/
      # and disable the default website provided with nginx
      unlink /etc/nginx/sites-enabled/default
      # Reload the webserver configuration, to pick up our changes
      systemctl reload nginx
    SHELL
    # Run ufw startup script
    webserver.vm.provision "shell", path: "ufw/ufw-usersite-config.sh"
  end

  # Configure the database VM
  config.vm.define "dbserver" do |dbserver|
    dbserver.vm.hostname = "dbserver"
    # Create a private network IP address to communivate with other VMs
    dbserver.vm.network "private_network", ip: "192.168.2.12"

    # The following line is for consistency for assignment markers in the CS labs
    dbserver.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]
    # Run MySQL startup script 
    dbserver.vm.provision "shell", path: "database-setup/mysql-setup.sh"
    # Run ufw startup script
    dbserver.vm.provision "shell", path: "ufw/ufw-dbserver-config.sh"
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
      apt-get install -y nginx php php-fpm php-mysql      

      # Set our webserver to use the config file in the shared (root) directory
      cp /vagrant/adminsite /etc/nginx/sites-available/
      # activate our website configuration
      ln -s /etc/nginx/sites-available/adminsite /etc/nginx/sites-enabled/
      # and disable the default website provided with Apache
      unlink /etc/nginx/sites-enabled/default
      # Reload the webserver configuration, to pick up our changes
      systemctl reload nginx
    SHELL
    # Run ufw startup script
    adminserver.vm.provision "shell", path: "ufw/ufw-adminsite-config.sh"
  end

end

#  LocalWords:  webserver xenial64
