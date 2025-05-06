<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>
            .center 
            {
                 bTransaction: 5px solid;
                 text-align: center;
            }
  </style>
    <title>Iq Bkash</title>
  </head>
    {{--CSRF Token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

  <body>
  <div class="center">
        <h1 >Transaction List</h1>
    </div>

    <div class = "container">
      <br>
      <!-- <div class = "row" style = "position:relative;width:50%;height:50%;border:3px solid #73AD21; margin-left:250px;">
        <div class = "col-sm-6">
            <form name="add-blog-post-form" id="add-blog-post-form" method="get" action="{{url('search-txn')}}">
              @csrf
                
                <div class="form-group">
                  <label for="exampleInputText">Transaction ID</label>
                  <input name="trxID" class="form-control" placeholder = "Enter Transaction ID" required="">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <br>
            </form>
            <br>
          </div>
       </div> -->
    
        <div class="row">
            <div class="col-md-12">
            <table class="table table-bTransactioned tvake-sm mt-5">
  <thead class= "thead-dark">
    
            <tr>
                <th scope="col">SL</th>
                <th scope="col">Payment ID</th>
                <th scope="col">TXN ID</th>
                <th scope="col">Amount</th>
                <th scope="col">Invoice ID</th>
                <th scope="col">Intent</th>
                <th scope="col">Wallte No</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>


            </tr>

  </thead>
  <tbody>
    
    @foreach($TransactionList as $Transaction)
    <tr @if($Transaction->status == 'Completed') class = "table-sucess" @endif>
      <th scope="row">{!! $Transaction->id !!}</th>
      <td name = "paymentID">{!! $Transaction->paymentID !!}</td>
      <td name = "trxID">{!! $Transaction->trxID !!}</td>
      <td name = "amount">{!! $Transaction->amount !!}</td>
      <td>{!! $Transaction->merchantInvoiceNumber !!}</td>
      <td name = "intent">{!! $Transaction->intent !!}</td>
      <td>{!! $Transaction->customerMsisdn !!}</td>
      <td>{!! $Transaction->transactionStatus !!}</td>
      <td class = "text-right">
        @if($Transaction->transactionStatus != 'Refunded')
        <a href="{{ url('refund/' .$Transaction->paymentID)}}" class= "btn btn-sm btn-warning"> 
                Refund
        </a>
        @else
        <p><span class = "badge badge-success">Refunded</span></p>
        @endif
    </td>

    </tr>
    @endforeach


  </tbody>
</table>
            </div>
        </div>

    </div>
    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-1.8.2.min.js"  crossorigin="anonymous"></script>

    <script id="myScript"
        src="https://scripts.sandbox.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout-sandbox.js"></script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>