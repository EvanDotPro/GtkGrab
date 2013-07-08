#!/usr/bin/env bash

# Source: http://askubuntu.com/questions/107726/how-to-create-animated-gif-images-of-a-screencast

# Delay before starting
DELAY=5

# Sound notification to let one know when recording is about to start (and ends)
beep() {
    paplay /usr/share/sounds/gnome/default/alerts/sonar.ogg &
}

# Duration and output file
if [ $# -gt 0 ]; then
    D="--duration=$@"
else
    echo Default recording duration 10s to /tmp/recorded.gif
    D="--duration=10 /tmp/recorded.gif"
fi

# xrectsel from https://github.com/lolilolicon/FFcast2/blob/master/xrectsel.c
ARGUMENTS=$(xrectsel "--x=%x --y=%y --width=%w --height=%h") || exit -1

echo Delaying $DELAY seconds. After that, byzanz will start
for (( i=$DELAY; i>0; --i )) ; do
    echo $i
    sleep 1
done
beep
byzanz-record --verbose --delay=0 ${ARGUMENTS} $D
beep
