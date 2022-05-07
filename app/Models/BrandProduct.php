<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandProduct extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'tbl_brand_product';
    protected $primaryKey = 'brand_id';
    public $timestamps = true;

    public function product(){
        return $this->hasMany('App\Models\Product','brand_id');
    }
}
