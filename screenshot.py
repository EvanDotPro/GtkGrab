#!/usr/bin/python
# Copyright: Evan Coury <me@evancoury.com>
# License: GNU GPL, version 3; http://www.gnu.org/licenses/gpl-3.0.txt

from pynotify import *
import sys, urllib2, urllib, os, gtk, base64
from gtk import RecentManager

init("cli notify")
os.system('gnome-screenshot ' + sys.argv[1])
recentMgr = gtk.recent_manager_get_default()
recentMgr.set_limit(-1)
recentlyUsed = recentMgr.get_items()
recentlyUsed.sort(key=lambda x: x.get_modified, reverse=True)
for n in range(1, 20):
    recentItem = recentlyUsed.pop()
    if recentItem.has_application('GNOME Screenshot'):
        break

path = urllib.unquote_plus(recentItem.get_uri())[7:]
if recentItem.has_application('GNOME Screenshot') == False or os.path.exists(path) == False or path[-3:] != 'png':
    Notification('Screenshot Aborted!', 'No screenshot was uploaded.').show()
    sys.exit()

postURL = 'http://host.tld/screenshothandler.php';
data = base64.b64encode(open(path, 'r').read())
url = urllib2.urlopen(urllib2.Request(postURL), data).read();
os.remove(path)

os.system('echo -n "' + url + '" | xclip -selection c')
Notification('Screenshot Uploaded', "Copied URL to clipboard: \n" + url).show()
