<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Events\ProductAdd;

class ProductController extends Controller
{

    /**
     * Display a listing of the prducts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index',compact('products',$products));
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*echo '<pre>' .
            var_dump([
                $request->name,
                $request->description,
                $request->amount,
                $request->available,
                $request->company
            ])
            . '</pre>';*/

        $validatedData = $request->validate([
            // 'name' => 'required|unique:products',
            'name' => 'required',
            'amount' => 'required|numeric',
            'company' => 'required',
            'available' => 'required',
            'description' => 'required',
        ]);

        $products   =  Product::create($request->all());

        // call our event here
        event(new ProductAdd($products));

        return redirect('/products');

    }
}
