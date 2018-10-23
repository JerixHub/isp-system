@extends('admin.admin-header')

@section('sidebar')
<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('/bower_components/admin-lte/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Inventory</li>
            <li class="active"><a href="/inventory/products"><i class="fa fa-circle-o"></i><span>Products</span></a></li>
            <li><a href="/inventory/suppliers"><i class="fa fa-circle-o"></i><span>Suppliers</span></a></li>
            <li><a href="/inventory/categories"><i class="fa fa-circle-o"></i><span>Categories</span></a></li>
            <li><a href="/inventory/unit-measures"><i class="fa fa-circle-o"></i><span>Unit Measure</span></a></li>
            <li><a href="/inventory/brands"><i class="fa fa-circle-o"></i><span>Brands</span></a></li>
        </ul>
    </section>
</aside>
@endsection

@section('content')
<div class="content-wrapper">
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> {{ session()->get('message') }}</h4>
        </div>
    @endif
    <div class="content-padding">
        <section class="content-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <h1>
                        Products
                    </h1>
                </div>
            </div>
        </section>
        <section class="content">
            <form action="{{ action('ProductsController@store') }}" method="post">
                @csrf
                <input type="submit" class="btn bg-green" role="button" value="Save">

                <div class="form-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name" class="col-xs-12 col-form-label">Product Name</label>
                                <div class="col-xs-12 input-group">
                                    <input type="text" class="form-control input-lg" id="name" name="name" placeholder="Name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row tabbed-content">
                        <div class="col-lg-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab_1" data-toggle="tab" aria-expanded="true">Information</a>
                                    </li>
                                    <li>
                                        <a href="#tab_2" data-toggle="tab" aria-expanded="false">Supplier</a>
                                    </li>
                                    <li>
                                        <a href="#tab_3" data-toggle="tab" aria-expanded="false">Inventory</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="product_type" class="col-form-label col-lg-3 col-md-3 col-sm-3 col-xs-12">Product Type</label>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 input-group">
                                                        <select name="product_type" id="product_type" class="form-control">
                                                            <option value="stockable">Stockable</option>
                                                            <option value="consumable">Consumable</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sale_price" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-form-label">Sale Price</label>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 input-group">
                                                        <span class="input-group-addon">&#8369;</span>
                                                        <input type="number" class="form-control" min="0" id="sale_price" name="sale_price" step="0.1" placeholder="Sale Price">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group form-check">
                                                    <label for="is_active" class="col-form-label col-lg-3 col-md-3 col-sm-3 col-xs-4">Active</label>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8 input-group">
                                                        <input type="checkbox" name="is_active" class="form-check-input" checked>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="barcode" class="col-form-label col-lg-3 col-md-3 col-sm-3 col-xs-4">Barcode</label>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8 input-group">
                                                        <input type="text" name="barcode" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="description" class="col-xs-12 col-form-label">Description</label>
                                                    <textarea class="form-control" rows="5" id="description"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab_2">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="cost_price" class="col-form-label col-lg-3 col-md-3 col-sm-3 col-xs-12">Cost Price</label>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 input-group">
                                                        <span class="input-group-addon">&#8369;</span>
                                                        <input type="number" class="form-control" min="0" id="cost_price" name="cost_price" step="0.1" placeholder="Cost Price">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h3>Suppliers</h3>
                                                <select name="supplier[]" id="supplier" class="form-control apply-select2">
                                                   <option disabled value> -- no supplier -- </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab_3">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h3>Stocks</h3>
                                                <div class="form-group">
                                                    <label for="quantity" class="col-form-label col-lg-3 col-md-3 col-sm-3 col-xs-12">Quantity</label>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 input-group">
                                                        <input type="number" class="form-control" disabled>
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn bg-purple btn-flat">
                                                                Update
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="unit_measure" class="col-form-label col-lg-3 col-md-3 col-sm-3 col-xs-12">Unit of Measure</label>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 input-group">
                                                        <select name="unit_measure" id="unit_measure" class="form-control apply-select2">
                                                            @foreach($units as $unit)
                                                            <option value="{{$unit->id}}">{{$unit->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
@endsection

@section('header-menu')
<li><a href="/sales"><i class="fa fa-dollar"></i> <span class="hidden-xs">Sales</span></a></li>
<li class="active"><a href="/inventory"><i class="fa fa-archive"></i> <span class="hidden-xs">Inventory</span></a></li>
<li><a href="/purchase"><i class="fa fa-book"></i> <span class="hidden-xs">Purchases</span></a></li>
@endsection

@section('js')
<script>

</script>
@endsection