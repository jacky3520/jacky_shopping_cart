<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productSku extends Model
{
    use HasFactory;

    protected $primaryKey = 'sku_id';
    public $timestamps = false;

    protected $fillable =
        [
            'sku_id',
            'price',
            'inventory',
            'sku_img',
            'sku_mapping',
        ];

}
