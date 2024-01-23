<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;
    protected $fillable = [
        'completedTime',
        'transactionStatus',
        'originalTrxID',
        'refundTrxID',
        'amount',
        'currency',
        'charge'
    ];
}
