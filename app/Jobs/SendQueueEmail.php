<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use App\Settings;
use App\MarketingEmailRecipient;

class SendQueueEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;
    public $timeout = 7200; // 2 hours

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        //
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //

        $html = $this->details['content'];
        $to = $this->details['to'];
        $subject = $this->details['subject'];
        $from_email = $this->details['from_email'];
        $from_name =  $this->details['from_name'];
        $cc_email = $this->details['cc_email'];
        $recipient_id =  $this->details['recipient_id'];
       // $attachments = unserialize($this->details['attachments']);
         $attachments = (!empty($this->details['attachments'])) ?$this->details['attachments']: [];
         $setting_dtls = Settings::find(1);
         $logo =  $setting_dtls->logo;

        \Mail::send("admin.emails.email_template", ['content' => $html,'logo'=>$logo], function ($message) use (
            $html,
            $to,
            $subject,
            $from_email,
            $from_name,
            $cc_email,
            $attachments
        ) {
            $message->priority(1);
            $message->to($to);
            $message->from(env('MAIL_USERNAME'),'IMart'); 
            $message->cc($cc_email);

            if (count($attachments)) {
                foreach ($attachments as $attachment) {
                    $message->attach($attachment);
                }
            }

           $message->subject($subject);
        });
        $recipient_dtls = MarketingEmailRecipient::where('id',$recipient_id)->first();
        $recipient_dtls->email_sent=1;
        $recipient_dtls->updated_at=date('Y-m-d H:i:s');
        $recipient_dtls->save();


    }
}
