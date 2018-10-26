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
            <li class="active"><a href="/admin/inventory/products"><i class="fa fa-circle-o"></i><span>Products</span></a></li>
            <li><a href="/admin/inventory/suppliers"><i class="fa fa-circle-o"></i><span>Suppliers</span></a></li>
            <li><a href="/admin/inventory/categories"><i class="fa fa-circle-o"></i><span>Categories</span></a></li>
            <li><a href="/admin/inventory/unit-measures"><i class="fa fa-circle-o"></i><span>Unit Measure</span></a></li>
        </ul>
    </section>
</aside>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-padding">
        <section class="content-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <h1>
                        Products
                    </h1>
                    <a href="/admin/inventory/products/create" class="btn bg-purple">Create</a>
                </div>
            </div>
        </section>


        <section class="content">
            <div class="row">
                @foreach($products as $product)
                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 product-cards">
                    <div class="box box-primary">
                        <div class="box-header">
                            <a href="/admin/inventory/products/{{$product->id}}"><h3 class="box-title">{{$product->name}}</h3></a>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <p class="product-price">Price: &#8369;{{$product->sale_price}}/{{$product->unit_measure->name}}</p>
                                    <p class="cost-price">Cost Price: &#8369;{{$product->cost_price}}/&#0024;{{$product->unit_measure->name}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    </div>
</div>
@endsection

@section('header-menu')
<li><a href="/admin/sales"><i class="fa fa-dollar"></i> <span class="hidden-xs">Sales</span></a></li>
<li class="active"><a href="/admin/inventory"><i class="fa fa-archive"></i> <span class="hidden-xs">Inventory</span></a></li>
<li><a href="/admin/purchase"><i class="fa fa-book"></i> <span class="hidden-xs">Purchases</span></a></li>
@endsection