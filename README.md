# GtkGrab - Screenshot Uploader

Version 0.2.0 Created by Evan Coury

## Update Notice

If you are updating GtkGrab, please be aware that you may need to update your
config.cfg file (see the samples) and/or your handler.php on the server after
updating.

## Introduction

GtkGrab is an open source tool for Linux and Mac that takes a screenshot of a
window or specified area of the screen, uploads it to a web server of your
choice, and copies the URL to your clipboard automatically. Once you start
using it, you'll wonder how you got along without it. GtkGrab is essentially a
free and open source version of the commercial TinyGrab.com software/service,
except that it also works on Linux and you don't have to pay to use your own
server. The name GtkGrab implies that it may only work in GTK-based desktop
environment such as Gnome, however this is no longer the case (though it was
originally). To be clear, GtkGrab has been tested to work on Linux running both
Gnome and KDE as well as on Mac OSX.

## Usage Instructions

* Press your specified keyboard shortcut.
* On Linux: Either click and drag to specify an area of the screen to capture,
  or click on the title of a window to capture just that window.
* On Mac: Use the space bar to toggle between mouse and window selection modes.
* Within a few seconds, you should get an unobtrusive notification that your
  screenshot has been uploaded and that the URL has been copied to your
  clipboard.

## Installation

* Clone your own copy via Git.
* Set a username and password in handler.php and upload it to your server.
* Create a directory called **`caps`** on your server in the same directory as
  handler.php and chmod it to 777.
* Copy the appropriate config.cfg-sample-{os} to config.cfg. Set the username
  and password to match handler.php and posturl to be the URL to handler.php.
* Follow any platform-specific instructions below.

### Amazon S3 Upload Support
* Alternatively, GtkGrab supports using `s3cmd` (available in ruby-gems) to
  upload screenshots to Amazon S3.
* To configure: `s3cmd --configure` to create a `.s3cfg` file and place it in
  the GtkGrab directory. In your GtkGrab config, set `postURL` to `s3`.
* **Note:** if a local `.s3cfg` is not available, then the default `.s3cfg` will
  be used instead (if it exists).

### Fedora Installation

In your terminal, run the following command as root or via sudo:

`yum install scrot xclip`

In Gnome, set up a keyboard shortcut for **`GtkGrab/screenshot`** of your
choosing via System -> Preferences -> Keyboard Shortcuts.

### Ubuntu Installation

In your terminal, run the following command:

`sudo apt-get install scrot xclip`

In Gnome, set up a keyboard shortcut for **`GtkGrab/screenshot`** of your
choosing via System -> Preferences -> Keyboard Shortcuts.

### Arch Linux Installation

In your terminal, run the following command as root or via sudo:

`pacman -S scrot xclip`

In Gnome, set up a keyboard shortcut for **`GtkGrab/screenshot`** of your
choosing via System -> Preferences -> Keyboard Shortcuts.

### Mac Installation

* Install Growl and growlnotify from http://growl.info/
* Use automator to run **`GtkGrab/screenshot`** via the keyboard shortcut
  of your choice. Instructions for this can be found
  [here](http://www.macosxautomation.com/services/learn/tut01/index.html),
  except where it says to select "Launch Application", you should select "Run
  Shell Script" instead.

### Windows Installation

Sorry, GtkGrab does not support your operating system. If anyone would like to
add Windows support, please fork the project and let me know!

## Screenshot Tool

By default, GtkGrab uses scrot for making screenshots. And it will, by default,
only make screenshots of a selected area. But there is a 'command'
configuration directive. You can change this to any screenshot command that
saves a screenshot to the given path `%s`.

## Animated GIF Support

GtkGrab optionally supports recording an animated GIF of your screen. This
requires a few extra dependencies to work properly:

* [zenity](https://help.gnome.org/users/zenity/stable/) for prompting how long
  to record for.
* [xrectsel](https://github.com/lolilolicon/FFcast2/blob/master/xrectsel.c) for
  selecting the area to record.
* [byzanz](https://git.gnome.org/browse/byzanz/) for actually recording the gif
  (available in the Fedora base repo).

Currently, due to laziness, it uploads the gifs as png files, but they still
display fine in any modern browser.

Also due to laziness, the gif support only works on Linux, not Mac. Mac/Windows
support could be possible via [LICEcap](http://www.cockos.com/licecap/)
possibly.

To use GtkGrab in gif mode, simply invoke it with `./screenshot gif`.

## Keeping a local copy

You might want to keep a local copy of your screenshot! If you do, just add
the configuration option `localCopyPath` with where you want to store your
saved screenshots. The screenshots will be named with date and time. The path
does NOT need a trailing slash.

## Troubleshooting

* P: After taking a screenshot no notification is displayed, when running it
  from the command line the error 'sh: notify-send: not found'
* A: Install notify-osd libnotify-bin via your package manager
* P: ImportError: No module named ConfigParser
* A: GtkGrab wants python2 but your default is python3, you need to change the
  first line in `./screenshot` to point to your python2, /usr/bin/python2 for
  example
* P: Binding a keyboard shortcut in Gnome doesn't work.
* A: This is an issue with scrot. To solve this, try setting the command option
  in the config file to `sleep 0.5 && scrot --b -s %s`. For more information
  see [this](http://ubuntuforums.org/showthread.php?t=1881234) and
  [this](https://bbs.archlinux.org/viewtopic.php?id=143065) and
  [this](https://bbs.archlinux.org/viewtopic.php?id=159900) and
  [this](https://groups.google.com/forum/#!topic/linux.debian.bugs.dist/_tmJIFYBfZo).

## License

GtkGrab is released under the terms of the [GNU General Public License (GPL)
Version 3](http://en.wikipedia.org/wiki/GNU_General_Public_License). See
**`COPYING`** file for details.
