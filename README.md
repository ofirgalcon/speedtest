Speedtest module
==============

Uses `networkQuality` on macOS 12+ to determine the current internet speed. This module requires the `network` module to be installed and operating on the client Mac. 

By default this module is disabled and will not run. The admin must enable and configure the module before it will run on the clients. See below for how to configure it.

The `networkQuality` binary uses Apple's servers to determine network speeds. See [https://support.apple.com/en-us/101942](https://support.apple.com/en-us/101942) for information about how it works.

When the module is enabled, you can trigger a one time retest of the current network by touching a file at `/Users/Shared/.com.github.munkireport.speedtest`

Be mindful of network congestion and data usage with this module. It is not recommended to enable this module on in office or lab locations. You are responsible for any network problems created or data overages caused by using this module. 



Configuration
-------------

All configuration keys are set within the `MunkiReport` domain. See include mobile configuration profile for an example how to use a profile to configure this module. 

###`speedtest_enabled`

By default the module is disabled. To enable the module, set `speedtest_enabled` on the clients with: 
```sudo defaults write /Library/Preferences/MunkiReport.plist speedtest_enabled -bool True
```

###`speedtest_get_isp`
By default the module does not get ISP information from Speedtest.net's API ([https://www.speedtest.net/speedtest-config.php](https://www.speedtest.net/speedtest-config.php)). No data about your Mac is sent to Speedtest.net. 

To get information about the ISP, set `speedtest_get_isp` on the clients with: 
```sudo defaults write /Library/Preferences/MunkiReport.plist speedtest_get_isp -bool True
```
###`speedtest_get_location`
By default the module does not collect and report on the IP's reported latitude and longitude coordinates from Speedtest.net's API ([https://www.speedtest.net/speedtest-config.php](https://www.speedtest.net/speedtest-config.php)). No data about your Mac is sent to Speedtest.net. Enabling this requires enabling `speedtest_get_isp`.

To get the IP's reported latitude and longitude, set `speedtest_get_location` on the clients with: 
```sudo defaults write /Library/Preferences/MunkiReport.plist speedtest_get_location -bool True
```
###`speedtest_weekly_run`
By default the module does not retest a network. To enable retesting networks once a week, set `speedtest_weekly_run` on the clients with: 
```sudo defaults write /Library/Preferences/MunkiReport.plist speedtest_weekly_run -bool True
```

###`speedtest_current_only`
By default the module shows the last 5 networks it has run a speedtest on. If this is set on MacBooks or Macs that change networks often it could trigger them to retest the network speeds with every new network change.

To show only the current network, set `speedtest_current_only` on the clients with: 
```sudo defaults write /Library/Preferences/MunkiReport.plist speedtest_current_only -bool True
```

###`speedtest_debug_enabled`
By default the module does not show debug information on the client. To show the debug information and logic, set `speedtest_debug_enabled` on the clients with: 
```sudo defaults write /Library/Preferences/MunkiReport.plist speedtest_debug_enabled -bool True
```

Table Schema
-----

* base_rtt (string) Base RTT (ping)
* country (string) Country of the external IP address
* dhcp_domain_name (string) Domain name from DHCP
* dhcp_domain_name_servers (string) DNS from DHCP
* dhcp_routers (string) Routers from DHCP
* dhcp_subnet_mask (string) Subnet mask from DHCP
* dl_flows (integer) Download flow count
* dl_responsiveness (integer) Responsiveness of download connection
* dl_bytes_transferred (bigInt) Downloaded data amount in bytes
* dl_throughput (bigInt) Download speed in bytes
* end_time (bigInt) Timestamp of when test ended
* external_ip (string) External IP address from network module
* external_ip_isp (string) External IP address from Speedtest.net
* interface_name (string) Interface used for testing
* ipv4dns (string) IPv4 DNS server
* ipv4ip (string) IPv4 address
* ipv4mask (string) IPv4 network mask
* ipv4router (string) IPv4 router address
* ipv6ip (string) IPv6 address
* ipv6mask (int) IPv6 subnet mask
* isp (string) ISP as reported by Speedtest.net
* isp_rating (string) ISP rating as reported by Speedtest.net
* iteration (integer) Tests done on the network
* lat (float) Reported latitude of IP address by Speedtest.net
* lon (float) Reported latitude of IP address by Speedtest.net
* latest (boolean) If this is the current/latest test
* start_time (bigInt) Timestamp of when test started
* test_endpoint (string) The endpoint used to test network speeds
* ul_flows (interger) Upload flow count
* ul_responsiveness (integer) Responsiveness of upload connection
* ul_bytes_transferred (bigInt) Uploaded data amount in bytes
* ul_throughput (bigInt) Upload speed in bytes
