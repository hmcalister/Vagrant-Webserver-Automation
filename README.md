# COSC349-Assignment1
A deployment of a user-facing web-server, database, and admin web-server on virtual machines using Vagrant

## Deploying this project
- Ensure that you have Vagrant and a virtual machine manager installed
    - For development, we have used Vagrant 2.2.18, and VirtualBox 6.1.26r145957
    - In this project, occasionally after using `vagrant halt` a VM will fail to boot at the next `vagrant up`. This happens periodically, and to different VMs, but I believe the problem can be tracked to incompatibilities between VirtualBox and Vagrant. While downgrading one or the other many solve the issue, a more connivent (for some meaning of the word) solution is to instead just use `vagrant destroy` on the misbehaving machine
- `git clone` this repository, and `cd` into the directory
- Run `vagrant up` to start the virtual machines defined in the `vagrantfile`
    - Note that if you do not have a `ubuntu/xenial64` box installed already, this will be installed upon running `vagrant up`. This may take some time.
- Once the vagrant indicates that the virtual machines are running, you can connect to the user-facing webserver by navigating to [`127.0.0.1:8080`](http://127.0.0.1:8080)

## Project Overview
This project has three virtual machines (running ubuntu/xenial). One is hosting a user-facing webserver, port forwarded for access on a local machine. Another is hosting a MySQL database, for storage in the project, and the final VM is running an admin-facing webserver, for ease of administering the project with a webpage gui.

### webserver
The webserver runs Apache2, configured to host the user-facing site using `usersite.conf`. This VM has a port forward from the loopback port 8080 to VM port 80, so upon deployment you can connect to [`127.0.0.1:8080`](http://127.0.0.1:8080) to access `usersite`. This VM is also configured to exist on the private network `192.168.2.0/24` with IP address `192.168.2.11` so connecting to this address with port 80 will also yield `usersite`. These configurations can all be altered from `vagrantfile`.

### dbserver
The webserver runs MYSQL. It is currently set up to  run on `192.168.2.12`. A database is created on startup of the VM that allows for web-admins to be authenticated if they attempt to connect to the admin control panel (see below.) This is handled through the `mysql-setup.sh` script, which is run for this VMs provisioning. In turn, this script creates a database and a MYSQL user. Note: the default for this MYSQL user credentials are all extremely insecure, if you looking to use this project anywhere outside of a local machine, consider changing these to something more secure! This can be done from the start of the `mysql-setup.sh` file.

After creating a database, tables are created using the `setup-database.sql` file. Finally, data is loaded into the admin table using the `admins.secret` file and an SQL loader call. This is all terribly cohesive between files, so if you are planning to make a small change (e.g. changing a column name) please read carefully over these scripts to ensure you make all relevant changes so the database will initialize correctly.

### adminserver
The adminserver runs Apache2, configured to host the admin-facing site using `adminsite.conf`. This VM has a port forward from the loopback port 8081 to VM port 80, so upon deployment you can connect to [`127.0.0.1:8081`](http://127.0.0.1:8081) to access `adminsite`. This VM is also configured to exist on the private network `192.168.2.0/24` with IP address `192.168.2.13` so connecting to this address with port 80 will also yield `adminsite`. These configurations can all be altered from `vagrantfile`. The current login is determined by the database files (specifically the admin table), and by default is Username: root, Password: root

## Credits
- A large portion of this project has been developed based on repurposed files from [COSC349 labs](https://cosc349.cspages.otago.ac.nz/lab-schedule/) (link working: July 2021). A massive credit goes to Dr. David Eyers, who provided these resources and allowed for them to be reused. Specifically, large parts of the `vagrantfile`, and `webserver.conf` file are based on these lab files.
- Virtual Machines in this project run [`Ubuntu/Xenial`](https://ubuntu.com/16-04).
- Webservers are using [Apache2](https://www.apache.org/licenses/LICENSE-2.0).
- The styling for the webpages for this project was aided by [SkeletonCSS](http://getskeleton.com/])