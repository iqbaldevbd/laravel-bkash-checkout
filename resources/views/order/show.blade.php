<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          crossorigin="anonymous">
    {{--Favicon--}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.ico') }}">
    {{--CSRF Token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel - bKash Payment Integration</title>
</head>
<body>

<div class="container">
    
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-5">
                <div class="card-header">
                    {{ $order->product_name }}
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $order->product_name }}</h5>
                    <p class="card-text amount">{{ $order->amount }}</p>
                    <p class="card-text invoice">{{ $order->invoice }}</p>
                    @if($order->status == 'Pending')
                        <button class="btn btn-primary" id="bKash_button">Pay with bKash</button>
                    @else
                    <table>
                    <tr>
                                <td style = "font-size:35px;;">
                                    <span class="badge badge-success">Paid</span>
                               
                                </td>
                        </tr>
                    </table>
                        
                        
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-1.8.2.min.js"  crossorigin="anonymous"></script>

<script id="myScript"
        src="https://scripts.sandbox.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout-sandbox.js"></script>

<script>
    var accessToken = '';

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{!! route('token') !!}",
            type: 'GET',
            contentType: 'application/json',
            success: function (data) {
                console.log('got data from token  ..');
                console.log(JSON.stringify(data));

                accessToken = JSON.stringify(data);
            },
            error: function () {
                console.log('error');

            }
        });

        var paymentConfig = {
            createCheckoutURL: "{!! route('createpayment') !!}",
            executeCheckoutURL: "{!! route('executepayment') !!}",
            queryCheckoutURL: "{!! route('querypayment') !!}"

        };


        var paymentRequest;
        paymentRequest = {amount: $('.amount').text(), intent: 'sale', invoice: $('.invoice').text()};
        console.log(JSON.stringify(paymentRequest));

        bKash.init({
            paymentMode: 'checkout',
            paymentRequest: paymentRequest,
            createRequest: function (request) {
                console.log('=> createRequest (request) :: ');
                console.log(request);

                $.ajax({
                    url: paymentConfig.createCheckoutURL + "?amount=" + paymentRequest.amount + "&invoice=" + paymentRequest.invoice,
                    type: 'GET',
                    contentType: 'application/json',
                    success: function (data) {
                        console.log('got data from create  ..');
                        console.log('data ::=>');
                        console.log(JSON.stringify(data));

                        var obj = JSON.parse(data);

                        if (data && obj.paymentID != null) {
                            paymentID = obj.paymentID;
                            bKash.create().onSuccess(obj);
                        }
                        else {
                            console.log('error');
                            bKash.create().onError();
                        }
                    },
                    error: function () {
                        console.log('error');
                        bKash.create().onError();
                    }
                });
            },
            onClose: function () {
            // for error handle after close bKash Popup
                  window.location.href = "{!! route('orders.index') !!}";
            },

            executeRequestOnAuthorization: function () {
                console.log('=> executeRequestOnAuthorization');
                $.ajax({
                    url: paymentConfig.executeCheckoutURL + "?paymentID=" + paymentID,
                    type: 'GET',
                    contentType: 'application/json',
                    success: function (data) {
                        console.log('got data from execute  ..');
                        console.log('data ::=>');
                        console.log(JSON.stringify(data));

                        data = JSON.parse(data);
                        if (data && data.paymentID != null) {
                            alert('[SUCCESS] data : ' + JSON.stringify(data));
                            window.location.href = "{!! route('orders.index') !!}";
                        }
                        else {
                            //Query API Calling incase of no response from payment API
                            $.ajax({
                                        url: paymentConfig.queryCheckoutURL + "?paymentID=" + paymentID,
                                        type: 'GET',
                                        contentType: 'application/json',
                                        success: function (data) {
                                            console.log('got data from execute  ..');
                                            console.log('data ::=>');
                                            console.log(JSON.stringify(data));

                                            data = JSON.parse(data);
                                            if (data && data.paymentID != null) {
                                                alert('[SUCCESS] data : ' + JSON.stringify(data));
                                                window.location.href = "{!! route('orders.index') !!}";
                                            }
                                            else {

                                                bKash.execute().onError();
                                            }
                                        },
                                        error: function () {
                                            bKash.execute().onError();
                                        }
                                    });
                            //bKash.execute().onError();
                        }
                    },
                    error: function () {
                        bKash.execute().onError();
                    }
                });
            }
        });

        console.log("Right after init ");
    });

    function callReconfigure(val) {
        bKash.reconfigure(val);
    }

    function clickPayButton() {
        $("#bKash_button").trigger('click');
        
    }
</script>
</body>
</html>