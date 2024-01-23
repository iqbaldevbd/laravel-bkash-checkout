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
                 b$resultdata: 5px solid;
                 text-align: center;
            }
  </style>
    <title>Iq Bkash</title>
  </head>
    {{--CSRF Token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

  <body>
    <div class="center">
        <h1 >Refund Details</h1>
    </div>

    <div class = "container">
      <br>
        @if(isset($resultdata))
        <div class="row" style = "margin-left:180px;">
            <div class="col-md-12">
            <table class="table table-bordered tvake-sm mt-5">
  <thead class= "thead-dark">
    
            <tr>
                <th scope="col">Original TXN ID</th>
                <td>{!! $resultdata->originalTrxID !!}</td>
            </tr>
            <tr>
                <th scope="col">Refund Txn Time</th>
                <td>{!! $resultdata->refundTrxID  !!}</td>
            </tr>
            <tr>
                <th scope="col">Transaction Status</th>
                <td>{!! $resultdata->transactionStatus !!}</td>
            </tr>
          
            <tr>
                <th scope="col">Amount</th>
                <td>{!! $resultdata->amount !!}</td>
            </tr>
            <tr>
                <th scope="col">Currency</th>
                <td>{!! $resultdata->currency !!}</td>
            </tr>
            <tr>
                <th scope="col">Charge Amount</th>
                <td>{!! $resultdata->charge !!}</td>
            </tr>
           
      

  </thead>   


  
</table>
        </div>

    </div>
    @endif
    <!-- Optional JavaScript -->
   
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>