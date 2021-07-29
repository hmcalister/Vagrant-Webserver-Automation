# COSC349-Assignment1
A deployment of a user-facing web-server, database, and admin web-server on virtual machines using Vagrant

## Deploying this project
- Ensure that you have Vagrant and a virtual machine manager installed
    - For development, we have used Vagrant 2.2.18, and VirtualBox 6.1.26r145957
- `git clone` this repository, and `cd` into the directory
- Run `vagrant up` to start the virtual machines defined in the `vagrantfile`
    - Note that if you do not have a `ubuntu/xenial64` box installed already, this will be installed upon running `vagrant up`. This may take some time.
- Once the vagrant indicates that the virtual machines are running, you can connect to the user-facing webserver by navigating to (`127.0.0.1:8080`)[http://127.0.0.1:8080]

## Credits
- The styling for the webpages for this project was aided by (SkeletonCSS)[http://getskeleton.com/].