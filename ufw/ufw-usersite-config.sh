#!/bin/bash

# Sets firewall for vm running usersite web server

# Allow SSH
ufw allow ssh

# Allow HTTP
ufw allow http

# Uncomment to allow HTTPS
# ufw allow from any proto tcp to any port 443
# ufw allow to any proto tcp port 443

# Allow SQL
ufw allow 3306

# Enable firewall
echo "y" | ufw enable

# Display output to check for errors
ufw status verbose 
systemctl status ufw


