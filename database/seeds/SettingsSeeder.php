<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Settings::create([
        	'site_name' => "Laravel 5.4 blog",
        	'contact_number' => "0987765432",
        	'contact_email' => "espejo.a2@gmail.com",
        	'address' => 'Cebu City'
        ]);
    }
}
