<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TicketChat;


class Tickets extends Model
{   

        protected $connection = 'mysql2';
    protected $table = 'bitcoinx_supporttickets';

    public static function index()
    {
        $tickets = Tickets::on('mysql2')
        ->join('bitcoinx_users', 'bitcoinx_supporttickets.uid', '=', 'bitcoinx_users.id')
        ->select('bitcoinx_supporttickets.*','bitcoinx_users.name')
        ->orderBy('id','desc')->paginate(10);
        return $tickets;
    }

    public function admin_unreadmsg($ticketid)
    {
        $admin_unreadmsg = TicketChat::where(['ticketid' => $ticketid,'admin_status' => 0])->count();
        return $admin_unreadmsg;
    }
    

}
