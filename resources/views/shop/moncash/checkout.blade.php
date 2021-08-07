@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <h1>Your Select Products</h1>
            @foreach($cartShop->items as $order)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul class="list-group">
                                <li class="list-group-item">
                                    <span class="badge">${{ $order['price'] }}</span>
                                    {{ $order['item']['title'] }} | {{ $order['qty'] }} Units
                                </li>
                        </ul>
                    </div>
            @endforeach
                    <div class="panel-footer">
                        <strong>Total Price: ${{ $cartShop->totalPrice }}</strong>
                    </div>
                </div>
        </div>
        
    </div>

    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <h1 class="mt-5">Enjoy the Mon-Cash-PHP-SDK</h1>
            <p class="lead">This sample is created in order to show a hands on process to interact with the MonCash PHP SDK integration into php projects.</p>
            <hr />
            <br />
                <p>
                    The MonCash Button is generated with the following information: <br />
                    <ul>
                    <li><strong>OrderId</strong>: {{ $theOrder->getOrderId() }}</li>
                    <li><strong>Amount</strong>: {{ $theOrder->getAmount() }}</li>
                    </ul>
                </p>
                <p>
                    <a href="{{ URL::to($paymentObj->getRedirect()) }}" target='_blank'>
                        <img class="card-img-top rounded-circle text-center" 
                        src="https://moncashbutton.digicelgroup.com/Moncash-middleware/resources/assets/images/MC_button.png" 
                        alt="payez par moncash" style="width: 150px;">
                    </a>
                </p>
                <p>
                    <a class="btn btn-primary btn-lg" style="width:100%;" href="{{ url('/moncash/payment/details/?paymentDetails=1') }}" >Go to payment details
                    </a>
                </p>
        </div>
    </div>
@endsection