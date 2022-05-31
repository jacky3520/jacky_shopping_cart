<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\productSku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class productFetchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        productSku::truncate();
        product::truncate();

        $product = new product;

        $data = Http::get('https://orderhkuat.pokeguide.com/api/v1/goods/2');
        $product_info = json_decode($data)->good;
//        dd($product_info);

        $product->product_name = $product_info->goods_name;
        $product->product_options = json_encode($product_info->options, true);
        $product->min_price = $product_info->min_price;
        $product->max_price = $product_info->max_price;

        $product->save();

        foreach ($product_info->goods_sku as $sku) {
            productSku::create([
                'sku_id' => $sku->sku_id,
                'price' => $sku->price,
                'inventory' => $sku->inventory,
                'sku_img' => $sku->sku_images[0]->url,
                'sku_mapping' => json_encode($sku->sku_option_mappings),
            ]);
        }

    }
}
