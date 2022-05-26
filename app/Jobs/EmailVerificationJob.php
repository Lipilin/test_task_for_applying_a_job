<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class EmailVerificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    private $confirmUrl;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user,$confirmUrl)
    {
        $this->user=$user;
        $this->confirmUrl=$confirmUrl;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data=[
            'url'=>$this->confirmUrl,
        ];
        Mail::send(['html'=>'mail_layout'],$data,function($message){
            $message->from(env('MAIL_USERNAME'))->to($this->user)->subject
            ('Подтвердите вашу почту');
        });

    }
}
