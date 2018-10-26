<?php

namespace App\Http\Controllers\Admin\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InventoryController extends Controller
{

    public function index(){
    	return view('inventory.admin-inventory');
    }
}
