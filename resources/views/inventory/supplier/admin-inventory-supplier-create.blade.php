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
            <li><a href="/admin/inventory/products"><i class="fa fa-circle-o"></i><span>Products</span></a></li>
            <li class="active"><a href="/admin/inventory/suppliers"><i class="fa fa-circle-o"></i><span>Suppliers</span></a></li>
            <li><a href="/admin/inventory/categories"><i class="fa fa-circle-o"></i><span>Categories</span></a></li>
            <li><a href="/admin/inventory/unit-measures"><i class="fa fa-circle-o"></i><span>Unit Measure</span></a></li>
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
    <div class="content-padding">
        <section class="content-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <h1>
                        Category
                    </h1>
                </div>
            </div>
        </section>
        <section class="content">
            <form action="{{ action('Admin\Inventory\SupplierController@store') }}" method="post">
                @csrf
                <input type="submit" class="btn bg-green" role="button" value="Save">

                <div class="form-content">
                    <div class="form-group row">
                        <label for="name" class="col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label">Supplier Name</label>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label">Address</label>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="contact_person" class="col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label">Contact Person</label>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <input type="text" class="form-control" id="contact_person" name="contact_person" placeholder="ex. John Doe">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="contact_number" class="col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label">Contact Number</label>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="ex. 0916xxxxxxx">
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
@endsection

@section('header-menu')
<li><a href="/admin/sales"><i class="fa fa-dollar"></i> <span class="hidden-xs">Sales</span></a></li>
<li class="active"><a href="/admin/inventory"><i class="fa fa-archive"></i> <span class="hidden-xs">Inventory</span></a></li>
<li><a href="/admin/purchase"><i class="fa fa-book"></i> <span class="hidden-xs">Purchases</span></a></li>
@endsection