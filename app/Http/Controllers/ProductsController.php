<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function index(Request $request) : View {
        $products = Product::all();
        return view('index', )->with('products', $products);
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products',
            'quantity' => 'required|integer',
            'price' => 'required|integer',
        ]);
        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }
        Product::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);
        return response()->json([
            'message', 'Product created successfully'
        ], 201);
    }

    public function edit($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products',
            'quantity' => 'required|integer',
            'price' => 'required|integer',
        ]);
        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }
        $product = Product::find($id);
        $product->name = $request->name;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->save();
        return response()->json([
            'message', 'Product edited successfully'
        ], 201);
    }
}
