<?php

namespace App\Services;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use App\StaffEmail;
use Exception;

class SendEmailToStaffService
{
    /**
     * Send email to the staff.
     *
     * @param  Mailable $mailable
     * @return boolean
     */
    public function send(Mailable $mailable)
    {
        $staffEmails = StaffEmail::where('active', true)->get();

        if (count($staffEmails) > 0)
        {
            try
            {
                foreach ($staffEmails as $staffEmail)
                {
                    Mail::to($staffEmail->email)->send($mailable);
                }
            }
            catch (Exception $e)
            {
                if(count(Mail::failures()) > 0)
                {
                    Mail::to(env('MAIL_USERNAME', 'renancr176@gmail.com'))
                    ->send($mailable);
                }

                return false;
            }
        }
        else
        {
            Mail::to(env('MAIL_USERNAME', 'renancr176@gmail.com'))
            ->send($mailable);

            return false;
        }

        return true;
    }
}
