<?php

namespace Database\Seeders;

use App\Models\SmtpSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SmtpSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SmtpSetting::create([
            'smtp_transport' => 'smtp',
            'smtp_host' => 'sandbox.smtp.mailtrap.io',
            'smtp_port' => '587',
            'smtp_username' => '97f48283770737',
            'smtp_password' => 'aab03ea3472c5f',
            'smtp_encryption' => 'tls',
            'smtp_mail_from_name' => 'Demo',
            'smtp_mail_from_address' => 'support@demo.com',
        ]);
    }
}
