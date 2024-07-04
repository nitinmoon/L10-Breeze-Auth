<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;
use App\Models\SmtpSetting;

class MailConfigurationService
{
    public static function configureMail()
    {
        //set the settings of SMTP email configurations start
        $smtpSettings = SmtpSetting::first();
        if ($smtpSettings) {
            Config::set('mail.mailers.smtp.transport', $smtpSettings->smtp_transport);
            Config::set('mail.mailers.smtp.host', $smtpSettings->smtp_host);
            Config::set('mail.mailers.smtp.port', $smtpSettings->smtp_port);
            Config::set('mail.mailers.smtp.username', $smtpSettings->smtp_username);
            Config::set('mail.mailers.smtp.password', $smtpSettings->smtp_password);
            Config::set('mail.mailers.smtp.encryption', $smtpSettings->smtp_encryption);
            Config::set('mail.from.name', $smtpSettings->smtp_mail_from_name);
            Config::set('mail.from.address', $smtpSettings->smtp_mail_from_address);
            Config::set('mail.default', 'smtp');
        }
        //set the settings of SMTP email configurations end
    }
}