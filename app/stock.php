<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    protected $fillable = [
           'productName',
           'productDescription',
           'productCode',
           'stock',
           'costInGbp',
           'discontinued'
          
    ];
}
