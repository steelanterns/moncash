@extends('layouts.master')

@section('content')
    <h3>Here the details for the issued payment</h3>
            <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <td>Reference</td>
                    <td>Transaction ID</td>
                    <td>Cost</td>
                    <td>Message</td>
                    <td>Payer</td>
                    <td>Date</td>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                      <td><?php echo $transactionDetails->getPayment()->getReference();?></td>
                      <td><?php echo $transactionDetails->getPayment()->getTransactionId();?></td>
                      <td><?php echo $transactionDetails->getPayment()->getCost();?></td>
                      <td><?php echo $transactionDetails->getPayment()->getMessage();?></td>
                      <td><?php echo $transactionDetails->getPayment()->getPayer();?></td>
                      <td><?php echo date('D M d Y', $transactionDetails->getTimestamp()/1000);?></td>
                    </tr>
                </tbody>
            </table>
            <p><a class="btn btn-primary btn-lg" style="width:100%;" href='./' >Go back </a></p>     
endsection