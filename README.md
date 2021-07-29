# COSC349-Assignment1
A deployment of a user-facing web-server, database, and admin web-server on virtual machines using Vagrant

## Deploying this project
- Ensure that you have Vagrant and a virtual machine manager installed
    - For development, we have used Vagrant 2.2.18, and VirtualBox 6.1.26r145957
- `git clone` this repository, and `cd` into the directory
- Run `vagrant up` to start the virtual machines defined in the `vagrantfile`
    - Note that if you do not have a `ubuntu/xenial64` box installed already, this will be installed upon running `vagrant up`. This may take some time.
- Once the vagrant indicates that the virtual machines are running, you can connect to the user-facing webserver by navigating to [`127.0.0.1:8080`](http://127.0.0.1:8080)

## Project Overview
This project has three virtual machines (running ubuntu/xenial). One is hosting a user-facing webserver, port forwarded for access on a local machine. Another is hosting a MySQL database, for storage in the project, and the final VM is running an admin-facing webserver, for ease of administering the project with a webpage gui.

### webserver
The webserver runs Apache2, configured to host the user-facing site using `usersite.conf`. This VM has a port forward from the loopback port 8080 to VM port 80, so upon deployment you can connect to [`127.0.0.1:8080`](http://127.0.0.1:8080) to access `usersite`. This VM is also configured to exist on the private network `192.168.2.0/24` with IP address `192.168.2.11` so connecting to this address with port 80 will also yield `usersite`. These configurations can all be altered from `vagrantfile`.

### dbserver
The webserver runs MYSQL. Little has been done to set this up yet.

### adminserver
The adminserver runs Apache2, configured to host the admin-facing site using `adminsite.conf`. This VM has a port forward from the loopback port 8081 to VM port 80, so upon deployment you can connect to [`127.0.0.1:8081`](http://127.0.0.1:8081) to access `adminsite`. This VM is also configured to exist on the private network `192.168.2.0/24` with IP address `192.168.2.13` so connecting to this address with port 80 will also yield `adminsite`. These configurations can all be altered from `vagrantfile`.

## Credits
- A large portion of this project has been developed based on repurposed files from [COSC349 labs](https://cosc349.cspages.otago.ac.nz/lab-schedule/) (link working: July 2021). A massive credit goes to Dr. David Eyers, who provided these resources and allowed for them to be reused. Specifically, large parts of the `vagrantfile`, and `webserver.conf` file are based on these lab files.
- Virtual Machines in this project run (`Ubuntu/Xenial`)[https://ubuntu.com/16-04].
- Webservers are using (Apache2)[https://www.apache.org/licenses/LICENSE-2.0].
- The styling for the webpages for this project was aided by [SkeletonCSS](http://getskeleton.com/])