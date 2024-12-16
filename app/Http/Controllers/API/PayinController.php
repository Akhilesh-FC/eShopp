<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PayinController extends Controller
{ 
	public function payin(Request $request) 
    { 
       
         $validator = Validator::make($request->all(), [  
            'user_id' => 'required|exists:users,id', 
            'cash' => 'required|numeric|min:100', 
            'type' =>'required|in:1',
        ]);
        $validator->stopOnFirstFailure();

        if ($validator->fails()) { 
            $response = [
                'status' => 400,
                'message' => $validator->errors()->first() 
            ];
            return response()->json($response, 200);  
        }
        
	$cash = $request->cash;
    
    $userid = $request->user_id;
		 
              $date = date('YmdHis');
        $rand = rand(11111, 99999);
        $orderid = $date . $rand;
        $datetime=now();
        $check_id = DB::table('users')->where('id',$userid)->first();
       
        if ($check_id) { 
            $redirect_url = env('APP_URL')."api/checkPayment?order_id=$orderid"; 

            $insert_payin = DB::table('payins')->insert([
                'user_id' => $request->user_id,
                'cash' => $request->cash,
                'type' => $request->type,
                'order_id' => $orderid,
                'redirect_url' => $redirect_url,
                'status' => 1, // Assuming initial status is 0
				'typeimage'=>"https://eshop.foundercode.org/uploads/fastpay_image.png",
                'created_at'=>$datetime,
                'updated_at'=>$datetime
            ]);
         // dd($redirect_url);
            if (!$insert_payin) {
                return response()->json(['status' => 400, 'message' => 'Failed to store record in payin history!']);
            }
 
            $postParameter = [
                'merchantid' =>"04",
                'orderid' => $orderid,
                'amount' => $request->cash,
                'name' => $check_id->username,    
                'email' => "abc@gmail.com",  
                'mobile' => $check_id->mobile,   
                'remark' => 'payIn', 
                'type'=>$request->cash,
                'redirect_url' => env('APP_URL')."api/checkPayment?order_id=$orderid"
              // 'redirect_url' => config('app.base_url') ."/api/checkPayment?order_id=$orderid"
            ];
            // print_r($postParameter);die;
            // echo json_encode($postParameter);die;


            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://indianpay.co.in/admin/paynow',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0, 
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($postParameter),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Cookie: ci_session=1ef91dbbd8079592f9061d5df3107fd55bd7fb83'
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
             
			echo $response;
		//	dd($response);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Internal error!'
            ]);
        }
    } 
//orignal

// public function payin(Request $request)
// {
//     $validator = Validator::make($request->all(), [
//         'user_id' => 'required|exists:users,id',
//         'cash' => 'required|numeric|min:100',
//         'type' => 'required|in:1',
//     ]);
//     $validator->stopOnFirstFailure();

//     if ($validator->fails()) {
//         return response()->json([
//             'status' => 400,
//             'message' => $validator->errors()->first(),
//         ], 200);
//     }

//     $result = $this->processPayment($request->user_id, $request->cash);

//     if (!$result['success']) {
//         return response()->json([
//             'status' => 400,
//             'message' => $result['message'],
//         ]);
//     }

//     return response()->json([
//         'status' => 200,
//         'message' => 'Payment initiated successfully.',
//         'data' => [
//             'order_id' => $result['order_id'],
//             'redirect_url' => $result['redirect_url'],
//         ],
//     ]);
// }

    
//     private function processPayment($userId, $amount)
// {
//     $date = date('YmdHis');
//     $rand = rand(11111, 99999);
//     $orderId = $date . $rand;
//     $datetime = now();

//     $user = DB::table('users')->where('id', $userId)->first();

//     if (!$user) {
//         return ['success' => false, 'message' => 'User not found.'];
//     }

//     $redirectUrl = env('APP_URL') . "api/checkPayment?order_id=$orderId";

//     $insertPayin = DB::table('payins')->insert([
//         'user_id' => $userId,
//         'cash' => $amount,
//         'type' => 1, // Assuming type = 1 for online payments
//         'order_id' => $orderId,
//         'redirect_url' => $redirectUrl,
//         'status' => 1, // Assuming status = 1 initially
//         'typeimage' => "https://eshop.foundercode.org/uploads/fastpay_image.png",
//         'created_at' => $datetime,
//         'updated_at' => $datetime,
//     ]);

//     if (!$insertPayin) {
//         return ['success' => false, 'message' => 'Failed to store record in payin history.'];
//     }

//     $postParameter = [
//         'merchantid' => "04",
//         'orderid' => $orderId,
//         'amount' => $amount,
//         'name' => $user->username,
//         'email' => "abc@gmail.com",
//         'mobile' => $user->mobile,
//         'remark' => 'payIn',
//         'type' => $amount,
//         'redirect_url' => $redirectUrl,
//     ];

//     $curl = curl_init();
//     curl_setopt_array($curl, [
//         CURLOPT_URL => 'https://indianpay.co.in/admin/paynow',
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_ENCODING => '',
//         CURLOPT_MAXREDIRS => 10,
//         CURLOPT_TIMEOUT => 0,
//         CURLOPT_FOLLOWLOCATION => true,
//         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//         CURLOPT_CUSTOMREQUEST => 'POST',
//         CURLOPT_POSTFIELDS => json_encode($postParameter),
//         CURLOPT_HTTPHEADER => [
//             'Content-Type: application/json',
//             'Cookie: ci_session=1ef91dbbd8079592f9061d5df3107fd55bd7fb83',
//         ],
//     ]);

//     $response = curl_exec($curl);
//     curl_close($curl);

//     return [
//         'success' => true,
//         'order_id' => $orderId,
//         'redirect_url' => $redirectUrl,
//         'response' => $response,
//     ];
// }


    public function checkPayment(Request $request)
    {

        $orderid = $request->input('order_id');
	
        if ($orderid == "") {
            return response()->json(['status' => 400, 'message' => 'Order Id is required']);
        } else {
            $match_order = DB::table('payins')->where('order_id', $orderid)->where('status', 1)->first();

            if ($match_order) {
                $uid = $match_order->user_id;
            
                $cash = $match_order->cash;
                
               
                $orderid = $match_order->order_id;
                 $datetime=now();
              // dd("UPDATE payins SET status = 2 WHERE order_id = $orderid AND status = 1 AND user_id = $uid");

              $update_payin = DB::table('payins')->where('order_id', $orderid)->where('status', 1)->where('user_id', $uid)->update(['status' => 2]);
    
                if ($update_payin) {
                   
                return redirect()->away(env('APP_URL').'/payment_success.php');
                    
                } else {
                    return response()->json(['status' => 400, 'message' => 'Failed to update payment status!']);
                }
            } else {
                return response()->json(['status' => 400, 'message' => 'Order id not found or already processed']);
            }
        }
    }
	
    public function withdraw_request(Request $request)
    {
    
    		  $date = date('Ymd');
            $rand = rand(1111111, 9999999);
            $transaction_id = $date . $rand;
    	
    		 $userid=$request->userid;
    		 $amount=$request->amount;
    		   $validator=validator ::make($request->all(),
            [
                'userid'=>'required',
    			'amount'=>'required',
    			
            ]);
            $date=date('Y-m-d h:i:s');
            if($validator ->fails()){
                $response=[
                    'success'=>"400",
                    'message'=>$validator ->errors()
                ];                                                   
                
                return response()->json($response,400);
            }
          
    		 $datetime = date('Y-m-d H:i:s');
    		 
             $user = DB::select("SELECT * FROM `users` where `id` =$userid");
    		 $account_id=$user[0]->accountno_id;
    		 $mobile=$user[0]->mobile;
    		 $wallet=$user[0]->wallet;
    // 		 dd($wallet);
    		 $accountlist=DB::select("SELECT * FROM `bank_details` WHERE `id`=$account_id");
    		 
    		 $insert= DB::table('transaction_history')->insert([
            'userid' => $userid,
            'amount' => $amount,
            'mobile' => $mobile,
    		  'account_id'=>$account_id,
            'status' => 0,
    			 'type'=>1,
            'date' => $datetime,
    		  'transaction_id' => $transaction_id,
        ]);
    		  DB::select("UPDATE `users` SET `wallet`=`wallet`-$amount,`winning_wallet`=`winning_wallet`-$amount  WHERE `id`=$userid");
              if($insert){
              $response =[ 'success'=>"200",'data'=>$insert,'message'=>'Successfully'];return response ()->json ($response,200);
          }
          else{
           $response =[ 'success'=>"400",'data'=>[],'message'=>'Not Found Data'];return response ()->json ($response,400); 
          } 
        }
	
    public function redirect_success()
    {
        return view('success');
    }
	

	
	
}
