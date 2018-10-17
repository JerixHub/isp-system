@extends('admin.admin-header')

@section('sidebar')
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar"><!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('/bower_components/admin-lte/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Inventory</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="/inventory/products"><i class="fa fa-circle-o"></i><span>Products</span></a></li>
            <li class="active"><a href="/inventory/categories"><i class="fa fa-circle-o"></i><span>Categories</span></a></li>
            <li><a href="/inventory/brands"><i class="fa fa-circle-o"></i><span>Brands</span></a></li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
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
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <h1>
                        Category
                    </h1>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control input-md" id="navbar-search-input" placeholder="Search">
                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <form action="{{ action('CategoryController@update', $id) }}" method="post">
                {!! method_field('patch') !!}
                @csrf
                <input type="submit" class="btn bg-green" role="button" value="Save">

                <div class="form-content">
                    <div class="form-group row">
                        <label for="name" class="col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label">Category Name</label>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="parent_id" class="col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label">Parent Category</label>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <select name="parent_id" id="parent_id" class="form-control apply-select2">
                                <option value> -- no parent -- </option>
                                @foreach($categories as $category)
                                    @if(!empty($parent_id))
                                        @if($category->id == $parent_id)
                                            <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                        @else
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endif
                                    @else
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </section><!-- /.content -->
    </div>
</div><!-- /.content-wrapper -->
@endsection

@section('header-menu')
<li><a href="/sales"><i class="fa fa-dollar"></i> <span class="hidden-xs">Sales</span></a></li>
<li class="active"><a href="/inventory"><i class="fa fa-archive"></i> <span class="hidden-xs">Inventory</span></a></li>
<li><a href="/purchase"><i class="fa fa-book"></i> <span class="hidden-xs">Purchases</span></a></li>
@endsection