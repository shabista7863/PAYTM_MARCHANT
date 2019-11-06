<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paytm extends Model
{
    protected $table = 'paytm';
    
    protected $fillable = ['id','phonenumber','email','amount','status',
                            'order_id','transaction_id'];
}
