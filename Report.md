# COSC349 Assignment 1 Report
## Dan Skaf
## Hayden McAlister 1663787

## Project overview
This project has three virtual machines (running ubuntu/xenial). One is hosting a user-facing webserver, port forwarded for access on a local machine. Another is hosting a MySQL database, for storage in the project, and the final VM is running an admin-facing webserver, for ease of administering the project with a webpage gui.

All VMs are protected by UFW firewall, to block requests on ports that aren't needed on a VM by VM basis.

### Problem Points
- Conflicting versions of Vagrant(2.2.18)/VirtualBox(6.1.26r145957) on Windows machines often required vagrant destroy to successfully run vagrant up again
- Learning PHP, some JS, and AJAX caused many headaches
- Securing SQL queries using prepared statements was an adventure, to stop SQL injections from malicious users
    - Some queries could not be secured with this method (adminsite/tables.php has a query that uses POST variable to set table we query, not easy to parameterize)


