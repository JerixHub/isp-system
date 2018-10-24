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
            <li><a href="/inventory/products"><i class="fa fa-circle-o"></i><span>Products</span></a></li>
            <li><a href="/inventory/suppliers"><i class="fa fa-circle-o"></i><span>Suppliers</span></a></li>
            <li class="active"><a href="/inventory/categories"><i class="fa fa-circle-o"></i><span>Categories</span></a></li>
            <li><a href="/inventory/unit-measures"><i class="fa fa-circle-o"></i><span>Unit Measure</span></a></li>
        </ul>
    </section>
</aside>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-padding">
        <section class="content-header">
            <ol class="breadcrumb">
                <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="/inventory">Inventory</a></li>
                <li><a href="/inventory/categories">Category</a></li>
                <li class="active">{{$name}}</li>
            </ol>
            <a href="/inventory/categories/{{$id}}/edit" class="btn bg-purple">Edit</a>
            <a href="/inventory/categories/create" class="btn bg-purple">Create</a>
            <input type="button" class="btn bg-red delete" value="Delete">
            <form action="{{ action('CategoryController@destroy', $id) }}" method="post" id="delete">
                {!! method_field('delete') !!}
                @csrf
            </form>
        </section>


        <section class="content">
            <div class="form-content">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 with-separator">
                        <label for="name">Category Name</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 field-name">
                        <h5>{{$name}}</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 with-separator">
                        <label for="name">Parent Category</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 field-name">
                        @if(!empty($parent_id))
                            <h5 data-id="{{$parent_id}}">{{$parent_name}}</h5>
                        @else
                            <h5>No Parent Category</h5>
                        @endif
                    </div>
                </div>
            </div>
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
    $(document).on('click', '.delete', function(){
        $('#delete').submit();
    });
</script>
@endsection