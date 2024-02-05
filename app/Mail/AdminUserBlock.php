<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Coinuser;
use App\Models\KycSubmit;
use App\Models\user;

class AdminUserBlock extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $useralldata;
 
    public function __construct($user)
    {
        //$user = Coinuser::find($user->id);

        $useralldata = User::find($user->id); 


       // $remark= KycSubmit::edit($remark->kyc_id);

        // echo '<pre>';

        // print_r($remark->kyc_id);

        // exit();
         $this->useralldata =$useralldata;
         // $this->remark=$remark;
        
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.adminblockuser');
    }
}
