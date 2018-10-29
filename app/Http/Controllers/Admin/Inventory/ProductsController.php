<?php

namespace App\Http\Controllers\Admin\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Product;
use App\UnitMeasure;
use App\Supplier;
use App\StockMove;

class ProductsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('inventory.products.admin-inventory-products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $units = UnitMeasure::all();
        $suppliers = Supplier::all();
        return view('inventory.products.admin-inventory-products-create', compact('categories', 'units', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'              => 'required|max:255|string',
            'unit_measure'      => 'required|integer'
        ]);

        $product = new Product;
        $product->name = $request->name;
        $product->sale_price = $request->sale_price;
        $product->cost_price = $request->cost_price;
        $product->description = $request->description;
        $product->unit_measure_id = $request->unit_measure;
        if($request->is_active == 'on'){
            $product->is_active = 'yes';
        }else{
            $product->is_active = 'no';
        }
        $product->product_type = $request->product_type;
        $product->barcode = $request->barcode;
        $product->category_id = $request->category;
        $product->quantity = $request->forecast_qty;
        $product->save();

        if(!empty($request->suppliers)){
            foreach ($request->suppliers as $supplier) {
                DB::table('product_supplier')->insert(
                    [
                        'supplier_id'   =>$supplier,
                        'product_id'    =>$product->id,
                        'created_at'    => \Carbon\Carbon::now(),
                        'updated_at'    => \Carbon\Carbon::now()
                    ]
                );
            }
        }

        if(!empty($request->forecast_qty)){
            DB::table('stock_moves')->insert(
                [
                    'reference'         => $product->barcode,
                    'product_id'        => $product->id,
                    'quantity'          => $request->forecast_qty,
                    'unit_measure_id'   => $request->unit_measure,
                    'created_at'        => \Carbon\Carbon::now(),
                    'updated_at'        => \Carbon\Carbon::now()
                ]
            );
        }

        return redirect()->action('Admin\Inventory\ProductsController@show', ['id'=>$product->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $current_product = Product::find($id);
        dd($current_product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
