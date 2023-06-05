<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "order";
    protected $fillable = ['order_no', 'receiver_name', 'receiver_address', 'receiver_phone', 'order_val', 'status', 'shipping_fee'];
}
