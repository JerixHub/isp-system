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
            <li class="active"><a href="/inventory/categories"><i class="fa fa-circle-o"></i><span>Categories</span></a></li>
            <li><a href="/inventory/brands"><i class="fa fa-circle-o"></i><span>Brands</span></a></li>
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
                        Category
                    </h1>
                    <a href="/inventory/categories/create" class="btn bg-purple">Create</a>
                    <a href="#" class="btn btn-danger action-delete" data-csrf="{{csrf_token()}}" style="display: none;">Delete</a>
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
        	<div class="row">
                <div class="col-lg-12">
                    @if(count($categories) != 0)
                    <table class="table table-bordered content-table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="check-all"></th>
                                <th>Category Name</th>
                                <th>Parent Category</th>
                                <th>Show Products</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td><input type="checkbox" class="checker" data-id="{{$category->id}}"></td>
                                <td><a href="/inventory/categories/{{$category->id}}">{{$category->name}}</a></td>
                                <td>
                                    @if(!empty($category->parent))
                                    <a href="/inventory/categories/{{$category->parent->id}}">{{$category->parent->name}}</a>
                                    @endif
                                </td>
                                <td><a href="#" class="btn btn-primary btn-flat">Show Products</a><a href="/inventory/categories/{{$category->id}}/edit" class="btn btn-primary btn-flat">Edit</a><input type="button" class="btn bg-red btn-flat delete" value="Delete">
                                <form action="{{ action('CategoryController@destroy', $category->id) }}" method="post" id="delete">
                                    {!! method_field('delete') !!}
                                    @csrf
                                </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $categories->links() }}
                    @else
                    <div class="no-content">
                        <p class="no-content-create">
                            Press to create new category
                        </p>
                    </div>
                    @endif
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
    $('.action-delete').click(function(){
        var csrf = $(this).data('csrf');
        var confirmation = confirm('This action cannot be undone, are you sure you want to proceed?');
        if(confirmation == true){
            $('.checker.ready').each(function(){
                var id = $(this).data('id');
                $.ajax({
                    url: '/inventory/categories/ajax/'+id,
                    type: 'delete',
                    data: {_token: csrf, method: 'delete'},
                    success: function(data){
                        location.reload();
                    },
                    error: function(err){
                        console.log(err);
                    }
                });

            });

        }
    });
</script>
@endsection