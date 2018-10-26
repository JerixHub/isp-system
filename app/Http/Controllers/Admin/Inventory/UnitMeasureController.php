<?php

namespace App\Http\Controllers\Admin\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UnitMeasure;

class UnitMeasureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = UnitMeasure::all();
        return view('inventory.unitmeasure.admin-inventory-unitmeasure', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventory.unitmeasure.admin-inventory-unitmeasure-create');
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
            'name'      => 'required|max:255|string|regex:/(^[A-Za-z ]+$)+/',
            'abbrev'    => 'required|max:255|string|regex:/(^[A-Za-z ]+$)+/'
        ]);

        $unitmeasure = UnitMeasure::firstOrCreate(
            ['name' => $request->name],
            ['abbrev' => $request->abbrev]
        );

        return redirect()->action('Admin\Inventory\UnitMeasureController@show', ['id' => $unitmeasure->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $current_unit = UnitMeasure::find($id);
        $name = $current_unit->name;
        $abbrev = $current_unit->abbrev;
        return view('inventory.unitmeasure.admin-inventory-unitmeasure-show', compact('name','abbrev','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $current_unit = UnitMeasure::find($id);
        $name = $current_unit->name;
        $abbrev = $current_unit->abbrev;

        return view('inventory.unitmeasure.admin-inventory-unitmeasure-edit', compact('name', 'abbrev', 'id'));
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
            'name'      => 'required|max:255|string|regex:/(^[A-Za-z ]+$)+/',
            'abbrev'    => 'required|max:255|string|regex:/(^[A-Za-z ]+$)+/'
        ]);

        $current_unit = UnitMeasure::find($id)->update(['name'=>$request->name, 'abbrev'=>$request->abbrev]);
        return redirect()->action('Admin\Inventory\UnitMeasureController@show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $current_unit = UnitMeasure::find($id);

        $current_unit->delete();

        return redirect()->action('Admin\Inventory\UnitMeasureController@index');
    }

    public function ajax_destroy($id){

        $current_unit = UnitMeasure::find($id);
        $current_unit->delete();

        return "Successfully Deleted!";
    }
}
