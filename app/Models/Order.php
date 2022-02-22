<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $order = 'orders';
    protected $fillable = ['invoice', 'customer_name', 'total', 'status_order'];
}
