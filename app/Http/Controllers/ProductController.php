<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function create(Request $request){
        $product = $request->all();
        $product = Product::create(Arr::only($product,['name','description']));
/*         $product = Product::findOrFail(4); */
        $user = User::findOrFail(Auth::id());
/*         return response()->json(['mess'=>$user,'mess2'=>$product]); */
        $product->user($request->rating)->save($user);
        return new ProductResource($product);
    }
}
