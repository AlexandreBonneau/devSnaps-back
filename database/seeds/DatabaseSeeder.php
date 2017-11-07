<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->call('UsersTableSeeder');
        // If you want some base Snaps to be shown in your new app, run the following command line : `artisan db:seed --class=SnapsTableSeeder`
    }
}
