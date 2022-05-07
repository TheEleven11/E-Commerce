<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'tbl_category_product';
    protected $primaryKey = 'category_id';
    public $timestamps = true;

    public function product(){
        return $this->hasMany('App\Models\Product','category_id');
    }
}
