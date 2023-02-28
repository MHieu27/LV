<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ProductController extends Controller
{
    public function create(Request $request){
        $product = $request->all();
/*         $product = Product::create(Arr::only($product,['name','description'])); */
/*         $product = Product::findOrFail(2); */
        $user = User::findOrFail('17');

/*         return response()->json(['mess'=>$user->getKey(),'mess2'=>$product]); */
        $product->user()->save($user);
        return new ProductResource($product);
    }
}
