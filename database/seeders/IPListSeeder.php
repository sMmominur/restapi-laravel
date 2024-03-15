<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IPListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define data for ip_lists table
        $ipLists = [
            [
                'ip_address' => '127.0.0.1',
                'status' => 'Whitelist',
                'ip_type' => 'IPv4',
                'remarks' => 'Local Host IP',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ip_address' => '::1',
                'status' => 'Whitelist',
                'ip_type' => 'IPv4',
                'remarks' => 'Local Host IP',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'ip_address' => '2001:0db8:85a3:0000:0000:8a2e:0370:7334',
                'status' => 'Blocklist',
                'ip_type' => 'IPv6',
                'remarks' => 'Sample IPv6 address',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        // Insert data into the ip_lists table
        DB::table('ip_lists')->insert($ipLists);
    }
}
