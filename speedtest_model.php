<?php

use CFPropertyList\CFPropertyList;

class Speedtest_model extends \Model
{
    public function __construct($serial_number = '')
    {
        parent::__construct('id', 'speedtest'); // Primary key, tablename
        $this->rs['id'] = '';
        $this->rs['serial_number'] = $serial_number;
        $this->rs['base_rtt'] = null;
        $this->rs['country'] = null;
        $this->rs['dhcp_domain_name'] = null;
        $this->rs['dhcp_domain_name_servers'] = null;
        $this->rs['dhcp_routers'] = null;
        $this->rs['dhcp_subnet_mask'] = null;
        $this->rs['dl_flows'] = null;
        $this->rs['dl_responsiveness'] = null;
        $this->rs['dl_bytes_transferred'] = null;
        $this->rs['dl_throughput'] = null;
        $this->rs['end_time'] = null;
        $this->rs['external_ip'] = null;
        $this->rs['external_ip_isp'] = null;
        $this->rs['interface_name'] = null;
        $this->rs['ipv4dns'] = null;
        $this->rs['ipv4ip'] = null;
        $this->rs['ipv4mask'] = null;
        $this->rs['ipv4router'] = null;
        $this->rs['ipv6ip'] = null;
        $this->rs['ipv6mask'] = null;
        $this->rs['isp'] = null;
        $this->rs['isp_rating'] = null;
        $this->rs['iteration'] = null;
        $this->rs['lat'] = null;
        $this->rs['lon'] = null;
        $this->rs['latest'] = null;
        $this->rs['start_time'] = null;
        $this->rs['test_endpoint'] = null;
        $this->rs['ul_flows'] = null;
        $this->rs['ul_responsiveness'] = null;
        $this->rs['ul_bytes_transferred'] = null;
        $this->rs['ul_throughput'] = null;

        return $this;
    }

    /**
     * Process data sent by postflight
     *
     * @param string data
     * @author tuxudo
     **/
    public function process($data)
    {
        // If data is empty, throw error
        if (! $data) {
            throw new Exception("Error Processing Speedtest Module Request: No data found", 1);
        } else { 

            // Delete previous entries
            $this->deleteWhere('serial_number=?', $this->serial_number);

            // Process incoming speedtest.plist
            $parser = new CFPropertyList();
            $parser->parse($data);
            $plist = $parser->toArray();

            // Process each result
            foreach ($plist as $result) {

                // Add the serial mumber to each entry
                $result['serial_number'] = $this->serial_number;

                foreach ($this->rs as $key => $value) {

                    // If key does not exist in $result, null it
                    if ( ! array_key_exists($key, $result) || $result[$key] == '' && $result[$key] != '0') {
                        $this->rs[$key] = null;

                    // Set the db fields to be the same as those in the speedtest result
                    } else {
                        $this->rs[$key] = $result[$key];
                    }
                }

                // Save the data. Gotta go fast
                $this->id = '';
                $this->save();
            }
        }
    }
}
