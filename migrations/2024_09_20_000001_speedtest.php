<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class Speedtest extends Migration
{
    public function up()
    {
        $capsule = new Capsule();
        $capsule::schema()->create('speedtest', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial_number');
            $table->string('base_rtt')->nullable();
            $table->string('country')->nullable();
            $table->string('dhcp_domain_name')->nullable();
            $table->string('dhcp_domain_name_servers')->nullable();
            $table->string('dhcp_routers')->nullable();
            $table->string('dhcp_subnet_mask')->nullable();
            $table->integer('dl_flows')->nullable();
            $table->integer('dl_responsiveness')->nullable();
            $table->bigInteger('dl_bytes_transferred')->nullable();
            $table->bigInteger('dl_throughput')->nullable();
            $table->bigInteger('end_time')->nullable();
            $table->string('external_ip')->nullable();
            $table->string('external_ip_isp')->nullable();
            $table->string('interface_name')->nullable();
            $table->string('ipv4dns')->nullable();
            $table->string('ipv4ip')->nullable();
            $table->string('ipv4mask')->nullable();
            $table->string('ipv4router')->nullable();
            $table->string('ipv6ip')->nullable();
            $table->string('ipv6mask')->nullable();
            $table->string('isp')->nullable();
            $table->float('isp_rating')->nullable();
            $table->integer('iteration')->nullable();
            $table->float('lat')->nullable();
            $table->float('lon')->nullable();
            $table->boolean('latest')->nullable();
            $table->bigInteger('start_time')->nullable();
            $table->string('test_endpoint')->nullable();
            $table->integer('ul_flows')->nullable();
            $table->integer('ul_responsiveness')->nullable();
            $table->bigInteger('ul_bytes_transferred')->nullable();
            $table->bigInteger('ul_throughput')->nullable();
  
            $table->index('serial_number');
            $table->index('base_rtt');
            $table->index('dl_responsiveness');
            $table->index('dl_throughput');
            $table->index('dl_bytes_transferred');
            $table->index('end_time');
            $table->index('interface_name');
            $table->index('isp');
            $table->index('isp_rating');
            $table->index('iteration');
            $table->index('start_time');
            $table->index('ul_bytes_transferred');
            $table->index('ul_responsiveness');
            $table->index('ul_throughput');
        });
    }

    public function down()
    {
        $capsule = new Capsule();
        $capsule::schema()->dropIfExists('speedtest');
    }
}
