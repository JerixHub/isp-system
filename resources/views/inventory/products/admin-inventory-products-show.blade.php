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
            <ol class="breadcrumb">
                <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="/admin/inventory">Inventory</a></li>
                <li><a href="/admin/inventory/categories">Category</a></li>
                <li class="active">{{$current_product->name}}</li>
            </ol>
            <a href="/admin/inventory/products/{{$id}}/edit" class="btn bg-purple">Edit</a>
            <a href="/admin/inventory/products/create" class="btn bg-purple">Create</a>
            <input type="button" class="btn bg-red delete" value="Delete">
            <form action="{{ action('Admin\Inventory\ProductsController@destroy', $id) }}" method="post" id="delete">
                {!! method_field('delete') !!}
                @csrf
            </form>
        </section>


        <section class="content">
            <div class="form-content">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 with-separator">
                        <label for="name">Product Name</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 field-name">
                        <h5>{{$current_product->name}}</h5>
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
                                            <div class="row">
                                                <label for="category" class="col-form-label col-lg-3 col-md-3 col-sm-3 col-xs-12 with-separator">Category</label>
                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 field-name">
                                                    <h5>{{$current_product->category->name}}</h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="product_type" class="col-form-label col-lg-3 col-md-3 col-sm-3 col-xs-12 with-separator">Product Type</label>
                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 field-name">
                                                    <h5>{{$current_product->product_type}}</h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="sale_price" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 with-separator">Sale Price</label>
                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 field-name">
                                                    <h5>{{Auth::user()->country->symbol}}{{$current_product->sale_price}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <label for="is_active" class="col-form-label col-lg-3 col-md-3 col-sm-3 with-separator">Active</label>
                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8 field-name">
                                                    <h5>{{$current_product->is_active}}</h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="barcode" class="col-form-label col-lg-3 col-md-3 col-sm-3 col-xs-4 with-separator">Barcode</label>
                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8 field-name">
                                                    <h5>{{$current_product->barcode}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <label for="description" class="col-xs-12 col-form-label">Description</label>
                                                <div class="col-xs-12 field-name">
                                                    <p>{{$current_product->description}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_2">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <label for="cost_price" class="col-form-label col-lg-3 col-md-3 col-sm-3 col-xs-12 with-separator">Cost Price</label>
                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 field-name">
                                                    <h5>{{Auth::user()->country->symbol}}{{$current_product->cost_price}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h3>Suppliers</h3>
                                            @if(count($suppliers) != 0)
                                            <ol>
                                                @foreach($suppliers as $supplier)
                                                <li>{{$supplier->name}}</li>
                                                @endforeach
                                            </ol>
                                            @else
                                            <h5>No Supplier</h5>
                                            @endif
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
                                                <input type="number" id="quantity" class="form-control" value="{{$current_product->quantity}}" disabled>
                                                <input type="hidden" id="quantity" name="quantity" value="{{$current_product->quantity}}">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn bg-purple btn-flat" data-toggle="modal" data-target="#product-modal">
                                                        Update
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="unit_measure" class="col-form-label col-lg-3 col-md-3 col-sm-3 col-xs-12 with-separator">Unit of Measure</label>
                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 field-name">
                                                <h5>{{$current_product->unit_measure->name}}</h5>
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
    </section>
</div>
</div>

<div class="modal fade" id="product-modal">
    <div class="modal-dialog">
        <form action="{{ action('Admin\Inventory\ProductsController@updateProductQuantity', $current_product->id) }}" method="post">
            @csrf
            {!! method_field('patch') !!}
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                    <h4 class="modal-title">Update Product Quantity</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="will_be_forecast" class="col-form-label col-lg-3 col-md-3 col-sm-4 col-xs-12">Update Quantity</label>
                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                    <input type="number" name="will_be_forecast" value="0" id="will_be_forecast" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-flat save-modal">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('header-menu')
<li><a href="/admin/sales"><i class="fa fa-dollar"></i> <span class="hidden-xs">Sales</span></a></li>
<li class="active"><a href="/admin/inventory"><i class="fa fa-archive"></i> <span class="hidden-xs">Inventory</span></a></li>
<li><a href="/admin/purchase"><i class="fa fa-book"></i> <span class="hidden-xs">Purchases</span></a></li>
@endsection

@section('js')
<script>
    $(document).on('click', '.delete', function(){
        $('#delete').submit();
    });
</script>
@endsection