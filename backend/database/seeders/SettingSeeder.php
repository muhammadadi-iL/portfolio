<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'site_title' => 'Muhammad Adil Khan Portfolio',
            'company_name' => 'Muhammad Adil Khan Portfolio',
            'email' => 'admin@mak-portfolio.com',
            'phone' => '+923180253146',
            'address' => '700 Toy Fall Suite 586',
            'paypal_env' => 'Testing',
            'paypal_client_id' => '',
            'paypal_testing_secret_key' => '',
            'stripe_env' => 'Testing',
            'stripe_publishable_key' => '',
            'stripe_testing_secret_key' => '',
            'authorize_env' => 'Testing',
            'authorize_merchant_login_id' => '',
            'authorize_merchant_transaction_key' => ''
        ]);
    }
}
