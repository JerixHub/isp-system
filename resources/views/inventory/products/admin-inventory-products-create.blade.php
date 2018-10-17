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
            <li><a href="/inventory/categories"><i class="fa fa-circle-o"></i><span>Categories</span></a></li>
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
                            <div class="form-group row">
                                <!-- <label for="name" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-form-label">Product Name</label>
                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control input-lg" id="name" name="name" placeholder="Name">
                                </div> -->
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-form-label">Product Name</label>
                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control input-lg" id="name" name="name" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sale_price" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-form-label">Product Sale Price</label>
                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                    <input type="number" class="form-control" id="sale_price" name="sale_price" placeholder="Sale Price">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="purchase_price" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-form-label">Product Purchase Price</label>
                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                    <input type="number" class="form-control" id="purchase_price" name="purchase_price" placeholder="Purchase Price">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="parent_id" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-form-label">Category</label>
                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                    <select name="parent_id" id="parent_id" class="apply-select2 form-control">
                                        <option disabled selected value> -- no parent -- </option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
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