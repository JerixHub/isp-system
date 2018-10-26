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
            <li><a href="/admin/inventory/suppliers"><i class="fa fa-circle-o"></i><span>Suppliers</span></a></li>
            <li class="active"><a href="/admin/inventory/categories"><i class="fa fa-circle-o"></i><span>Categories</span></a></li>
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
                        Category
                    </h1>
                    <a href="/admin/inventory/categories/create" class="btn bg-purple">Create</a>
                    <a href="#" class="btn btn-danger action-delete" data-csrf="{{csrf_token()}}" style="display: none;">Delete</a>
                </div>
            </div>
        </section>


        <section class="content">
        	<div class="row">
                <div class="col-lg-12">
                    @if(count($categories) != 0)
                    <table class="table table-bordered content-table table-hover">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="check-all"></th>
                                <th>Category Name</th>
                                <th class="hidden-xs">Parent Category</th>
                                <th class="hidden-xs">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td><input type="checkbox" class="checker" data-id="{{$category->id}}"></td>
                                <td><a href="/admin/inventory/categories/{{$category->id}}">{{$category->name}}</a></td>
                                <td class="hidden-xs">
                                    @if(!empty($category->parent))
                                    <a href="/admin/inventory/categories/{{$category->parent->id}}">{{$category->parent->name}}</a>
                                    @endif
                                </td>
                                <td class="hidden-xs"><a href="#" class="btn btn-primary btn-flat">Show Products</a><a href="/admin/inventory/categories/{{$category->id}}/edit" class="btn btn-primary btn-flat">Edit</a><input type="button" class="btn bg-red btn-flat delete" value="Delete">
                                <form action="{{ action('Admin\Inventory\CategoryController@destroy', $category->id) }}" method="post" id="delete">
                                    {!! method_field('delete') !!}
                                    @csrf
                                </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
<li><a href="/admin/sales"><i class="fa fa-dollar"></i> <span class="hidden-xs">Sales</span></a></li>
<li class="active"><a href="/admin/inventory"><i class="fa fa-archive"></i> <span class="hidden-xs">Inventory</span></a></li>
<li><a href="/admin/purchase"><i class="fa fa-book"></i> <span class="hidden-xs">Purchases</span></a></li>
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
                    url: '/admin/inventory/categories/ajax/'+id,
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

    $(document).on('click', '.delete', function(){
        var confirmation = confirm('This action cannot be undone, are you sure you want to proceed?');
        if(confirmation == true){
            $(this).closest('td').find('#delete').submit();
        }
    });

    $('.content-table').DataTable({
        'searching': true,
        'info': false,
        'pagingType': 'first_last_numbers',
        'lengthMenu': [20, 50, 100]
    });


</script>
@endsection