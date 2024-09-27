#!/bin/bash

# speedtest_controller
NW_CTL="${BASEURL}index.php?/module/speedtest/"

# Get the script in the proper directory
"${CURL[@]}" "${NW_CTL}get_script/speedtest.py" -o "${MUNKIPATH}preflight.d/speedtest.py"

if [ "${?}" != 0 ]
then
	echo "Failed to download all required components!"
	rm -f ${MUNKIPATH}preflight.d/speedtest.py
	exit 1
fi

# Make executable
chmod a+x "${MUNKIPATH}preflight.d/speedtest.py"

# Set preference to include this file in the preflight check
setreportpref "speedtest" "${CACHEPATH}speedtest.plist"
