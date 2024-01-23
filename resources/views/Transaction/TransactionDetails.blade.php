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
                 b$TransactionData: 5px solid;
                 text-align: center;
            }
  </style>
    <title>Iq Bkash</title>
  </head>
    {{--CSRF Token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

  <body>
    <div class="center">
        <h1 >Transaction Details</h1>
    </div>

    <div class = "container">
      <br>
      <div class = "row" style = "position:relative;width:50%;height:50%;border:3px solid #73AD21; margin-left:250px;">
        <div class = "col-sm-6">
            <form name="add-blog-post-form" id="add-blog-post-form" method="get" action="{{url('search-txn')}}">
              @csrf
                
                <div class="form-group">
                  <label for="exampleInputText">Search Transaction</label>
                  <input name="trxID" class="form-control" placeholder = "Enter TXN ID" required="">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <br>
            </form>
            <br>
          </div>
       </div>
    @if(isset($TransactionData))
        <div class="row" style = "margin-left:250px;">
            <div class="col-md-8">
            <table class="table table-bordered tvake-sm mt-5">
  <thead class= "thead-dark">
    
            <tr>
                <th scope="col">TXN ID</th>
                <td>{!! $TransactionData->trxID !!}</td>
            </tr>
            <tr>
                <th scope="col">Initiate Time</th>
                <td>{!! $TransactionData->initiationTime  !!}</td>
            </tr>
            <tr>
                <th scope="col">Completetion Time</th>
                <td>{!! $TransactionData->completedTime !!}</td>
            </tr>
          
            <tr>
                <th scope="col">Wallet No</th>
                <td>{!! $TransactionData->customerMsisdn !!}</td>
            </tr>
            <tr>
                <th scope="col">Transaction Type</th>
                <td>{!! $TransactionData->transactionType !!}</td>
            </tr>
            <tr>
                <th scope="col">Transaction Amount</th>
                <td>{!! $TransactionData->amount !!}</td>
            </tr>
            <tr>
                <th scope="col">Currency</th>
                <td scope = "col">{!! $TransactionData->currency !!}</td>
            </tr>
            <tr>
                <th scope="col">Transaction Status</th>
                <td scope = "col">{!! $TransactionData->transactionStatus !!}</td>
            </tr>

            <tr>
                <th scope="col">Organization ShortCode</th>
                <td>{!! $TransactionData->organizationShortCode !!}</td>
            </tr>
      

  </thead>   


  
</table>
            </div>
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