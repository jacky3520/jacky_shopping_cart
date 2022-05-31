<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\productSku;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function getProduct()
    {
        return product::all()->first();
    }

    public function getProductSku()
    {
        return productSku::all();
    }

    public function getProductOptions()
    {
        $product_options = json_decode(product::all()->first()->product_options, true);
        $option_list = [];
        foreach($product_options as $option)
        {
            array_push($option_list, $option);
        }

        return $option_list;
    }
}
