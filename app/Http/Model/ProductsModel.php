<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class ProductsModel extends Model
{
    protected $table='products';
    protected $primaryKey='products_id';
    public $timestamps=false;
}
