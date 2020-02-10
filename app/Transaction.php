<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    protected $table    = 'gateway_transactions';
    public $timestamps = true;

    use SoftDeletes;

    protected $fillable = [
        'id',
        'port',
        'price',
        'ref_id',
        'tracking_code',
        'card_number',
        'status',
        'ip',
        'payment_date'
    ];

}
