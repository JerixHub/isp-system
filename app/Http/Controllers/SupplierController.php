<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('inventory.supplier.admin-inventory-supplier', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventory.supplier.admin-inventory-supplier-create');
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
            'name'              => 'required|max:255|string'
        ]);

        $supplier = new Supplier;
        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->contact_person = $request->contact_person;
        $supplier->contact_number = $request->contact_number;
        $supplier->save();

        return redirect()->action('SupplierController@show', ['id' => $supplier->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $current_supplier = Supplier::find($id);
        $name = $current_supplier->name;
        $address = $current_supplier->address;
        $contact_person = $current_supplier->contact_person;
        $contact_number = $current_supplier->contact_number;
        return view('inventory.supplier.admin-inventory-supplier-show', compact('name','address','contact_person','contact_number', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $current_supplier = Supplier::find($id);
        $name = $current_supplier->name;
        $address = $current_supplier->address;
        $contact_person = $current_supplier->contact_person;
        $contact_number = $current_supplier->contact_number;
        return view('inventory.supplier.admin-inventory-supplier-edit', compact('name','address','contact_person','contact_number', 'id'));
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
            'name'      => 'required|max:255|string'
        ]);

        $current_supplier = Supplier::find($id)->update(['name'=>$request->name, 'address'=>$request->address, 'contact_person'=>$request->contact_person, 'contact_number'=>$request->contact_number]);
        return redirect()->action('SupplierController@show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $current_supplier = Supplier::find($id);

        $current_supplier->delete();

        return redirect()->action('SupplierController@index');
    }

    public function ajax_destroy($id){

        $current_supplier = Supplier::find($id);
        $current_supplier->delete();

        return "Successfully Deleted!";
    }
}
