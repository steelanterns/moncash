<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use DGCGroup\MonCashPHPSDK\Order;
use DGCGroup\MonCashPHPSDK\Credentials;
use Illuminate\Support\Facades\Session;
use DGCGroup\MonCashPHPSDK\PaymentMaker;
use DGCGroup\MonCashPHPSDK\Configuration;
use DGCGroup\MonCashPHPSDK\TransactionCaller;

class MoncashController extends Controller
{
    //client Id
    private const CLIENT = '4e1dda81e593b429458fd6e2eee42d9f';
    //Secret Id
    private const SECRET = '2qWBPRt5HqroVm-CJdrRn_vZUQRE_F7T70W2auwRTIRb24sicPXstq_3enrKXwDu';
    private $configArray;
    private $credential;

    function __construct() {
        $this->configArray = Configuration::getSandboxConfigs();
        $this->credential = new Credentials( self::CLIENT, self::SECRET, $this->configArray );
      }

       //to create a new moncash Order

       public function orderObject(){
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;

          $amount = $total;
          $orderId = Str::random(3).auth()->user()->id.Str::random(4);

          $theOrder = new Order( $orderId, $amount );

          return $theOrder;
       }

      //to create a new moncash Payment
      public function paymentObject(){
          $paymentObj = PaymentMaker::makePaymentRequest( $this->orderObject(), $this->credential, $this->configArray );

        return $paymentObj;

      }

      public function getCheckoutByMoncash()
        {
            //if( $request->input('paymentDetails') )
            $orderObject = $this->orderObject();
            $paymentObj = $this->paymentObject();
            //dd( $paymentObjs['paymentObj'] );
            if (!Session::has('cart')) {
                return view('shop.shopping-cart');
            }

            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $total = $cart->totalPrice;

            return view('shop.moncash.checkout', [
                'total' => $total, 
                'cartShop' => $cart, 
                'paymentObj' => $paymentObj,
                'theOrder' => $orderObject,
            ]);
        }

        public function getPaymentDetails(){   
            $transactionDetails = TransactionCaller::getTransactionDetailsByOrderIdRequest( $this->orderObject(), $this->credential, $this->configArray );
            dd($transactionDetails); 
            
            return view('shop.moncash.detailsTransaction', [
                'transactionDetails' => $transactionDetails,
            ]);
        }
        
      public function postCheckoutByMoncash( Request $request ){
        dd( $request->all() );
      }
}
