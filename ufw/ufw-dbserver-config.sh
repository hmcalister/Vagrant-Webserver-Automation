#!/bin/bash

# Sets firewall for vm running database server

# Deny all incoming and outgoing ports
ufw default deny incoming
ufw default deny outgoing

# Allow SSH
ufw allow SSH

# Allow SQL 
# Allow incoming request on VM subnet
ufw allow from 192.168.2.0/24 proto tcp to any port 3306
#Allow outoging requests on VM subnet
ufw allow to 192.168.2.0/24 proto tcp port 3306

# Enable firewall
ufw enable

systemctl status ufw 


