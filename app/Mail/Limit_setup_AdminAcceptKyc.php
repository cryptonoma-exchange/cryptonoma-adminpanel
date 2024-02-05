<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Coinuser;


class Limit_setup_AdminAcceptKyc extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $uid;
    protected $name;

    public function __construct($uid,$name)
    {
         $this->uid =$uid;
         $this->name =$name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $user = Coinuser::where('id', $this->uid)->first();

        return  $this->subject($this->name.' Status')->markdown('email.limit_adminaccept_kyc')
        ->with([
        'username' => $user->name,
        'name' => $this->name,
        ]);
    }
}
