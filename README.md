GtkGrab - Screenshot Uploader
================================

Introduction
------------
GtkGrab is an open source tool for Linux and Mac that takes a screenshot of a window or specified area of the screen, uploads it to a web server of your choice, and copies the URL to your clipboard automatically. Once you start using it, you'll wonder how you got along without it. GtkGrab is essentially a free and open source version of the commercial TinyGrab.com software/service, except that it works on Linux and you don't have to pay to use your own server.

Installation
------------
* Clone your own copy via Git.
* Set a username and password in handler.php and upload it to your server.
* Create a directory called **`caps`** on your server in the same directory as handler.php and chmod it to 777.
* Copy config.cfg-sample to config.cfg. Set the username and password to match handler.php and posturl to be the URL to handler.php.
* Follow any platform-specific instructions below.

Fedora Installation
-------------------
*Note: This process has been tested and verified to work on Fedora 14 but it may work on earlier versions.*

    yum install scrot ImageMagick xclip

Ubuntu Installation
-------------------
*Note: This process has been tested and verified to work on Ubuntu 10.4 but it may work on earlier versions.*

    sudo apt-get install scrot imagemagick xclip

Mac Installation
----------------
* Install Growl and growlnotify from http://growl.info/
* Use automator to run GtkGrab/screenshot-mac via the hotkey of your choice.


Windows Installation
--------------------
Sorry, GtkGrab does not support your operating system.
