<?php

namespace App\Http\Controllers\Admin\Sales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	return view('sales.admin-sales');
    }
}
