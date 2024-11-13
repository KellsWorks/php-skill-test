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
        return view('index', compact('products'));
    }

    public function create(Request $request) : View {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products',
            'quantity' => 'required|integer',
            'price' => 'required|integer',
        ]);
        if($validator->fails()){
            return view('index', ['errors' => $validator->errors()]);
        }
        Product::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);
        return redirect('/')->with('message', 'Product created successfully');
    }

    public function edit(Request $request, $id) : View {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products',
            'quantity' => 'required|integer',
            'price' => 'required|integer',
        ]);
        if($validator->fails()){
            return view('index', ['errors' => $validator->errors()]);
        }
        $product = Product::find($id);
        $product->name = $request->name;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->save();
        return view('edit', compact('product'));
    }
}
