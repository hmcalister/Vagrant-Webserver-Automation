#!/bin/bash

# Sets firewall for vm running usersite web server

# Deny all incoming and outgoing ports
ufw default deny incoming
ufw default deny outgoing

# Allow SSH
ufw allow ssh

# Allow HTTP
ufw allow from any proto tcp to any port 80
ufw allow to any proto tcp port 80

# Uncomment to allow HTTPS
# ufw allow from any proto tcp to any port 443
# ufw allow to any proto tcp port 443

# Allow SQL
ufw allow from 192.168.2.0/24 proto tcp to any port 3306
ufw allow to 192.168.2.0/24 proto tcp port 3306

# Enable firewall
echo "y" | ufw enable

# Display output to check for errors
ufw status verbose 
systemctl status ufw


