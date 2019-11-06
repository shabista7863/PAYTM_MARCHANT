<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PaytmWallet;
use App\Paytm;
use Session;

class PaytmController extends Controller
{
    public function index()
    {
        return view('paytm');
    }

    public function order(Request $request)
    {
            $this->validate($request, [
                 'name' => 'required',
                 'phonenumber' =>'required|numeric|digits:10',
                 'email' =>'required',
               ]);
        
               $user = $request->all();
               $user['id'] = rand(1111,9999);
               $user['amount'] = $request->amount;
                $user['status'] = '0';
                $user['order_id'] = 'null';
                
                paytm::insert($user);
                // $value = Session('key', 'Payment Successfully Credited.');
                // return back()->with('success',$value);

       $payment = PaytmWallet::with('receive');
        $payment->prepare([
          'order' => $user['id'],
          'user' => 'id',
          'mobile_number' => $request->phonenumber,
          'email' => $request->email,
          'amount' => $user['amount'],
          'callback_url' => url('payment/status')
        ]);
       // return redirect()->with('alert-success','Payment Successfully Credited.');
        return $payment->receive();
       
    }
    

    public function paymentCallback()
     {       
        $transaction = PaytmWallet::with('receive');        
        $response = $transaction->response() ;
        if($transaction->isSuccessful()){
            paytm::where('id',$response['ORDERID'])->update(['status'=>1, 'transaction_id'=>$response['TXNID']]);
           // dd('Payment Successfully Credited.');
            //$value = Session('key', 'You are successfully added all fields');
        return redirect('paytm')->with('success','Payment Successfully Credited.');

        }else if($transaction->isFailed()){
           paytm::where('id',$response['ORDERID'])->update(['status'=>0, 'transaction_id'=>$response['TXNID']]);
          //  dd('Payment Failed. Try again lator');
         
         return redirect('paytm')->with('danger','Payment Failed. Try again later');

        }else if($transaction->isOpen()){
         
       }
         $transaction->getResponseMessage(); 
         $transaction->getOrderId(); 
         $transaction->getTransactionId(); 
    }  

    public function valid()
    {
   //  PaytmController::paymentCallback();
   //     $value = Session('key', 'Payment Successfully Credited.');
   //       return back('payment/status')->with('success',$value);
      }
}
