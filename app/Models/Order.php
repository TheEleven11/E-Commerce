<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'tbl_order';
    protected $primaryKey = 'order_id';
    public $timestamps = true;

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    
    public function shipping(){
        return $this->belongsTo(Shipping::class, 'shipping_id');
    }
}
