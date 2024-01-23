<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Controller;
use App\Models\TransactionList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class RefundController extends Controller
{
    private $base_url;
    private $app_key;

    public function __construct()
    {
        $array = $this->_get_config_file();
        
        
        $post_token = array(
            'app_key' => $array["app_key"],
            'app_secret' => $array["app_secret"],
            'base_url' => $array["refundURL"],
            'proxy' => $array['proxy']
            
        );

        $this->app_key = $post_token['app_key'];
        $this->base_url = $post_token['base_url'];
        $this->proxy = $post_token['proxy'];
    }

    public function token()
    {
        //For session starting
        session_start();
        
        //get token 
        $request_token = $this->_bkash_Get_Token();
        $idtoken = $request_token['id_token'];

        $_SESSION['token'] = $idtoken;

        /*$strJsonFileContents = file_get_contents("config.json");
        $array = json_decode($strJsonFileContents, true);*/

        $array = $this->_get_config_file();

        $array['token'] = $idtoken;

        $newJsonString = json_encode($array);
        File::put(storage_path() . '/app/public/config.json', $newJsonString);

        echo $idtoken;
    }

    protected function _bkash_Get_Token()
    {
        /*$strJsonFileContents = file_get_contents("config.json");
        $array = json_decode($strJsonFileContents, true);*/
        
        //Calling Config File
        $array = $this->_get_config_file();

        $post_token = array(
            'app_key' => $array["app_key"],
            'app_secret' => $array["app_secret"]
        );

        $url = curl_init($array["tokenURL"]);
        $proxy = $array["proxy"];
        $posttoken = json_encode($post_token);
        $header = array(
            'Content-Type:application/json',
            'password:' . $array["password"],
            'username:' . $array["username"]
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $posttoken);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        //curl_setopt($url, CURLOPT_PROXY, $proxy);
        $resultdata = curl_exec($url);
        curl_close($url);
        return json_decode($resultdata, true);
    }

    protected function _get_config_file()
    {
        $path = storage_path() . "/app/public/config.json";
        return json_decode(file_get_contents($path), true);
    }

    public function index()
    {
        return view('bkash-refund');
    }
    
    public function refund(request $Request)
    {
        $CurrentURL =  url()->current();
        $paymentID = explode("/",$CurrentURL)[4];
        
        $TransactionList = TransactionList::where('paymentID',$paymentID)->get();             
        $array = $this->_get_config_file();

            $token = session()->get('bkash_token');
        
            $proxy = $this->proxy;
            
            $refundBody = array(
                'paymentID' => $TransactionList[0]->paymentID,
                'amount' => $TransactionList[0]->amount,
                'trxID' => $TransactionList[0]->trxID,
                'sku' => $TransactionList[0]->intent,
                'reason' => $TransactionList[0]->intent
                 );

            $url = curl_init($this->base_url);
    
            $refundBody = json_encode($refundBody);
    
            $header = array(
                'Content-Type:application/json',
                'authorization:' . $array['token'],
                'x-app-key:' . $this->app_key
            );
            

    
            curl_setopt($url, CURLOPT_HTTPHEADER, $header);
            curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($url, CURLOPT_POSTFIELDS, $refundBody);
            curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
            //curl_setopt($url, CURLOPT_PROXY, $proxy);
    
            $resultdata = curl_exec($url);
            $resultdata = json_decode($resultdata);

            DB::table('refunds')->insert(
                [
                'completedTime' => $resultdata->completedTime,
                'transactionStatus' => $resultdata->transactionStatus,
                'originalTrxID' => $resultdata->originalTrxID,
                'refundTrxID' => $resultdata->refundTrxID,
                'transactionStatus' => $resultdata->transactionStatus,
                'amount' => $resultdata->amount,
                'currency' => $resultdata->currency,
                'charge' => $resultdata->charge
            ]);
            if($resultdata->transactionStatus == 'Completed')
            {
                DB::table('transaction_lists')
                ->where('trxID',$resultdata->originalTrxID)
                ->update(["transactionStatus" => 'Refunded']);
            }

            curl_close($url);
            
            return view('Transaction.RefundDetails',compact('resultdata'));
       

       
    }

    // public function refundCurl($token, $post_fields)
    // {
    //     $url = curl_init("$this->base_url");
    //     $header = array(
    //         'Content-Type:application/json',
    //         "authorization:$token",
    //         "x-app-key:$this->app_key"
    //     );

    //     curl_setopt($url, CURLOPT_HTTPHEADER, $header);
    //     curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
    //     curl_setopt($url, CURLOPT_POSTFIELDS, json_encode($post_fields));
    //     curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
    //     $resultdata = curl_exec($url);
    //     curl_close($url);

    //     return json_decode($resultdata, true);
    // }
    public function searchTXN(request $Request)
    {
        $trxID = $Request->input('trxID');
        $array = $this->_get_config_file();

        $token = session()->get('bkash_token');    
        $proxy = $this->proxy;        
        $searchBODY = array(           
            'trxID' => $trxID
                );

        $url = curl_init($array['searchURL'].$trxID);  
        $searchBODY = json_encode($searchBODY);
        $header = array(
            'Content-Type:application/json',
            'authorization:' . $array['token'],
            'x-app-key:' . $this->app_key
        );
        
        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $searchBODY);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        //curl_setopt($url, CURLOPT_PROXY, $proxy);

        $resultdata = curl_exec($url);
        curl_close($url);
        $TransactionData =  json_decode($resultdata);

        

        return view('Transaction.TransactionDetails',compact('TransactionData'));

    }
    public function transSearchView(Request $Request)
    {
        return view('Transaction.TransactionDetails');
    }


    public function create()
    {
    }

    
    public function store(Request $request)
    {
    }

    public function show(Refund $refund)
    {
    }

    public function edit(Refund $refund)
    {
    }

    public function update(Request $request, Refund $refund)
    {
    }
    public function destroy(Refund $refund)
    {
    }
}
