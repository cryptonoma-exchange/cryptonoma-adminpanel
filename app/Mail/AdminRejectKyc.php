<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Coinuser;
use App\Models\KycSubmit;

class AdminRejectKyc extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $remark;
    public function __construct($user,$remark)
    {
        $user = Coinuser::find($user->id);

        
        $remark= KycSubmit::edit($remark->kyc_id);

        // echo '<pre>';

        // print_r($remark->kyc_id);

        // exit();
         $this->user =$user;
         $this->remark=$remark;
        
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.adminreject_kyc');
    }
}
