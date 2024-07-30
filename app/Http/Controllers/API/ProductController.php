<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getAll(Request $request)
    {
        $limit = $request->input('limit');
        $name = $request->input('name');
        $description = $request->input('description');
        $tags = $request->input('tags');
        $categories = $request->input('categories');
        $price_from = $request->input('price_from');
        $price_to = $request->input('price_to');

        $product = Product::with(['category', 'galleries']);

        if ($name){
            $product->where('name', 'like', '%', $name, '%');
        }
        if ($description){
            $product->where('name', 'like', '%', $description, '%');
        }
        if ($tags){
            $product->where('name', 'like', '%', $tags, '%');
        }
        if ($categories){
            $product->where('categories', $categories);
        }
        if ($price_from){
            $product->where('price_from', '>=', $price_from);
        }
        if ($price_to){
            $product->where('price_from', '<=', $price_from);
        }

        return ResponseFormatter::success(
            $product->paginate($limit),
            sprintf('Success Get All Products')
        );
    }

    public function getById(string $id)
    {
        if ($id) {
            $product = Product::with(['category', 'galleries'])->find($id);

            if ($product) {
                return ResponseFormatter::success(
                    $product,
                    sprintf('Success Get Product with id = %i', $id)
                );
            }else{
                return ResponseFormatter::error(
                    message: 'error, product not found',
                );
            }
        };

        return ResponseFormatter::error(
            message: 'error, id is required',
        );
    }
}
