<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(20);
        return view('inventory.category.admin-inventory-category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('inventory.category.admin-inventory-category-create', compact('categories'));
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
            'name' => 'required|max:255',
        ]);

        $category = new Category;
        if(!empty($request->name)){
            $category->name = $request->name;
        }

        if(!empty($request->parent_id)){
            $category->parent_id = $request->parent_id;
        }

        $category->save();

        return redirect()->action('CategoryController@show', ['id' => $category->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $current_categ = Category::find($id);
        $name = $current_categ->name;
        $parent_categ = $current_categ->parent;
        if(!empty($parent_categ)){
            $parent_name = $parent_categ->name;
            $parent_id = $parent_categ->id;
        }
        return view('inventory.category.admin-inventory-category-show', compact('name', 'id', 'parent_name', 'parent_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::where('id','!=',$id)->get();
        $current_categ = Category::find($id);
        $name = $current_categ->name;
        $parent_categ = $current_categ->parent;
        if(!empty($parent_categ)){
            $parent_name = $parent_categ->name;
            $parent_id = $parent_categ->id;
        }
        return view('inventory.category.admin-inventory-category-edit', compact('categories', 'name', 'id', 'parent_id'));

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
            'name' => 'required|max:255',
        ]);
        $current_categ = Category::find($id)->update(['name'=>$request->name, 'parent_id'=>$request->parent_id]);
        return redirect()->action('CategoryController@show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $current_categ = Category::find($id);
        $children = $current_categ->children;
        foreach ($children as $child) {
            $child->update(['parent_id'=>null]);
        }

        $current_categ->delete();

        return redirect()->action('CategoryController@index');
    }

    public function ajax_destroy($id){

        $current_categ = Category::find($id);
        $children = $current_categ->children;
        foreach ($children as $child) {
            $child->update(['parent_id'=>null]);
        }

        $current_categ->delete();

        return "Successfully Deleted!";
    }
}
