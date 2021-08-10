#!/bin/bash

# Sets firewall for vm running database server

# Deny all incoming and outgoing ports
ufw default deny incoming
ufw default deny outgoing

# Allow SSH
ufw allow ssh

# Allow SQL 
ufw allow mysql

# Enable firewall
echo "y" | ufw enable

# Display output to check for error
ufw status verbose
systemctl status ufw 


