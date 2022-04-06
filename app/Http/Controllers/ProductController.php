<?php namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller{

    public function getProducts(Request $request){
        return (new Product())->query();
    }

    public function getProduct($id){
        $_product = null;
        foreach ((new Product())->query()->where('title', urldecode($id)) as $product){
            $_product = $product;
            break;
        }
        return response()->json($_product);
    }

}
