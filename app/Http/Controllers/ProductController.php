<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::orderBy('created_at','desc')->get();
        return view('products.index')->with('products', $products);
    }
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $stock = $product->stock === 0 ? 'Indisponible' : 'Disponible';
        
        return view('products.show', [
            'product' => $product,
            'stock' => $stock
        ]);
    }
}
