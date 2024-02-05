<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Coinuser;
use App\Models\AffilateCommission;
use App\Models\UserWallet;

class AffliateTransaction extends Model
{

	protected $connection = 'mysql2';
	protected $table ='affliate_transaction';

    public static function affliate_transaction($userid,$amount,$type){
         
        $users 		 = Coinuser::on('mysql2')->where('id',$userid)->first(); 
        $refcode	 = $users->parent_id ;  // myself code  
        $commissions = AffilateCommission::get();  
         
        if(count($commissions) > 0)
        { 
			foreach($commissions as $commission) { 
              $coin = $commission->coin;             
              if($refcode != ''){
				
				$referuser = Coinuser::where('referral_id',$refcode)->first(); //check parent id 

				if($referuser){   
					if($type == 'deposit')
					{
						$dbcommission = $commission->deposit ;
					}
					elseif($type == 'trade')
					{ 
						$dbcommission = $commission->trade ;

					}
					else
					{
						return 'Invalid type';

					}
					$calculate  = bcdiv(sprintf('%.10f',$dbcommission),100,8);
					$commission_affilate = bcmul(sprintf('%.10f',$amount) ,sprintf('%.10f',$calculate),8);
          if($commission_affilate  > 0)
          {
  					$uid = $referuser->id;

     
  				    UserWallet::creditAmount($uid, $coin, $commission_affilate,8);
  					$reason = 'Generation '.$commission->generation.' affiliate commission';
  					self::CreateTransaction($uid,$coin,$reason,$commission_affilate); 
          } 
				}else { 
                    break;
				} 
				$refcode = $referuser->parent_id;  
               }
               else{
                 break;
               } 
            }
        }
        return true;
    }

    public static function CreateTransaction($uid,$coin,$reason,$commission_affilate)
    {

    	$affliate_transaction = new AffliateTransaction();
    	$affliate_transaction->uid  = $uid;
    	$affliate_transaction->coin  = $coin;
    	$affliate_transaction->reason  = $reason;
    	$affliate_transaction->commission  = $commission_affilate;
    	$affliate_transaction->created_at = date('Y-m-d H:i:s',time());
		$affliate_transaction->updated_at = date('Y-m-d H:i:s',time());
    	$affliate_transaction->save();
    	

    }

       public static function affliateHistory()
    {
    	$history = AffliateTransaction::orderBy('id', 'desc')->paginate(15);

    	return $history;
    }

     public function user() {
        return $this->belongsTo('App\Models\User', 'uid', 'id');
    }


}
