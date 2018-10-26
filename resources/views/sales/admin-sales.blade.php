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
            <li class="header">Sales</li>
            <li class="active"><a href="/sales/sale-orders"><i class="fa fa-circle-thin"></i><span>Sale Order</span></a></li>
            <li><a href="/sales/quotations"><i class="fa fa-circle-thin"></i><span>Quotation</span></a></li>
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
                        Sales
                    </h1>
                    <a href="#" class="btn bg-purple">Create</a>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control input-md" id="navbar-search-input" placeholder="Search">
                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">

            

        </section>
    </div>
</div>
@endsection

@section('header-menu')
<li class="active"><a href="/admin/sales"><i class="fa fa-dollar"></i> <span class="hidden-xs">Sales</span></a></li>
<li><a href="/admin/inventory"><i class="fa fa-archive"></i> <span class="hidden-xs">Inventory</span></a></li>
<li><a href="/admin/purchase"><i class="fa fa-book"></i> <span class="hidden-xs">Purchases</span></a></li>
@endsection