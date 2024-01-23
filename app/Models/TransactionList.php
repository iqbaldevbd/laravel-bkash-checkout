<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionList extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'paymentID',
        'createTime',
        'updateTime',
        'trxID',
        'transactionStatus',
        'amount',
        'currency',
        'intent',
        'merchantInvoiceNumber',
        'customerMsisdn'


    ];
    
}
