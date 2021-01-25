#!/bin/bash

PID=`/bin/ps -ef | \
     /bin/grep -i RPi_name | \
     /bin/egrep -v "grep|$$|start|stop|status" | \
     /usr/bin/awk '{print $2}'`
     
if [ "${PID}" != '' ] ; then
    echo "Restart of RPi with PID = "$PID
     /bin/kill ${PID}
else
   echo "RPi is not running...so starting."
fi

/usr/bin/python3 /root/Alexa/IOT-Pi3-Alexa-Automation-master/RPi_name_port_gpio.py 2>&1 &
