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
        $units = UnitMeasure::all();
        $suppliers = $current_product->suppliers;
        return view('inventory.products.admin-inventory-products-show', compact('current_product', 'id', 'units', 'suppliers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $current_product = Product::find($id);
        $categories = Category::all();
        $units = UnitMeasure::all();
        $suppliers = Supplier::all();
        $current_suppliers = $current_product->suppliers;
        $supplier_array = array();
        if(count($current_suppliers) != 0){
            foreach ($current_suppliers as $current_supplier) {
                array_push($supplier_array, $current_supplier->id);
            }
        }
        return view('inventory.products.admin-inventory-products-edit', compact('current_product', 'id', 'categories', 'suppliers', 'units', 'supplier_array'));
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
        $validatedData = $request->validate([
            'name'              => 'required|max:255|string',
            'unit_measure'      => 'required|integer'
        ]);

        $update_array = array();

        $update_array['name'] = $request->name;
        $update_array['sale_price'] = $request->sale_price;
        $update_array['cost_price'] = $request->cost_price;
        $update_array['description'] = $request->description;
        $update_array['unit_measure_id'] = $request->unit_measure;
        if($request->is_active == 'on'){
            $update_array['is_active'] = 'yes';
        }else{
            $update_array['is_active'] = 'no';
        }

        $update_array['product_type'] = $request->product_type;
        $update_array['barcode'] = $request->barcode;
        $update_array['category_id'] = $request->category;
        if(!empty($request->forecast_qty)){
            $update_array['quantity'] = $request->forecast_qty;
            DB::table('stock_moves')->insert(
                [
                    'reference'         => $request->barcode,
                    'product_id'        => $id,
                    'quantity'          => $request->forecast_qty - $request->quantity,
                    'unit_measure_id'   => $request->unit_measure,
                    'created_at'        => \Carbon\Carbon::now(),
                    'updated_at'        => \Carbon\Carbon::now()
                ]
            );
        }

        if(!empty($request->suppliers)){
            $current_suppliers = Product::find($id)->suppliers;
            if(count($current_suppliers) != 0){
                foreach ($current_suppliers as $current_supplier) {
                    Product::find($id)->suppliers()->detach($current_supplier->id);
                }
                foreach ($request->suppliers as $supplier) {
                    DB::table('product_supplier')->insert(
                        [
                            'supplier_id'   =>$supplier,
                            'product_id'    =>$id,
                            'created_at'    => \Carbon\Carbon::now(),
                            'updated_at'    => \Carbon\Carbon::now()
                        ]
                    );
                }
            }else{
                foreach ($request->suppliers as $supplier) {
                    DB::table('product_supplier')->insert(
                        [
                            'supplier_id'   =>$supplier,
                            'product_id'    =>$id,
                            'created_at'    => \Carbon\Carbon::now(),
                            'updated_at'    => \Carbon\Carbon::now()
                        ]
                    );
                }
            }
        }else{
            $current_suppliers = Product::find($id)->suppliers;
            foreach ($current_suppliers as $current_supplier) {
                Product::find($id)->suppliers()->detach($current_supplier->id);
            }
        }

        $current_product = Product::find($id)->update($update_array);
        return redirect()->action('Admin\Inventory\ProductsController@show', ['id'=>$id]);
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

    public function updateProductQuantity(Request $request, $id)
    {

        $current_product = Product::find($id);
        $current_quantity = $current_product->quantity;
        $new_quantity = $current_quantity + $request->will_be_forecast;
        $update_current_product = Product::find($id)->update(['quantity' => $new_quantity]);

        if(!empty($request->will_be_forecast)){
            DB::table('stock_moves')->insert(
                [
                    'reference'         => $current_product->barcode,
                    'product_id'        => $current_product->id,
                    'quantity'          => $request->will_be_forecast,
                    'unit_measure_id'   => $current_product->unit_measure->id,
                    'created_at'        => \Carbon\Carbon::now(),
                    'updated_at'        => \Carbon\Carbon::now()
                ]
            );
        }

        return redirect()->action('Admin\Inventory\ProductsController@show', ['id' => $id]);
    }
}
