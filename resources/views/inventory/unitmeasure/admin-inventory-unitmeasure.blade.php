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
            <li><a href="/inventory/categories"><i class="fa fa-circle-o"></i><span>Categories</span></a></li>
            <li class="active"><a href="/inventory/unit-measures"><i class="fa fa-circle-o"></i><span>Unit Measure</span></a></li>
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
                        Unit Measure
                    </h1>
                    <a href="/inventory/unit-measures/create" class="btn bg-purple">Create</a>
                    <a href="#" class="btn btn-danger action-delete" data-csrf="{{csrf_token()}}" style="display: none;">Delete</a>
                </div>
            </div>
        </section>


        <section class="content">
        	<div class="row">
                <div class="col-lg-12">
                    @if(count($units) != 0)
                    <table class="table table-bordered content-table table-hover table-responsive">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="check-all"></th>
                                <th>Unit Name</th>
                                <th class="hidden-xs">Unit Abbreviation</th>
                                <th class="hidden-xs">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($units as $unit)
                            <tr>
                                <td><input type="checkbox" class="checker" data-id="{{$unit->id}}"></td>
                                <td><a href="/inventory/unit-measures/{{$unit->id}}">{{$unit->name}}</a></td>
                                <td class="hidden-xs">{{$unit->abbrev}}</td>
                                <td class="hidden-xs"><a href="/inventory/unit-measures/{{$unit->id}}/edit" class="btn btn-primary btn-flat">Edit</a><input type="button" class="btn bg-red btn-flat delete" value="Delete">
                                <form action="{{ action('UnitMeasureController@destroy', $unit->id) }}" method="post" id="delete">
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
                            Press to create new unit measure
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
                    url: '/inventory/unit-measures/ajax/'+id,
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

    // $('#search-input').keyup(function(){
    //     if($(this).val() != ""){
    //         var text = $(this).val();
    //         var csrf = "{{csrf_token()}}";
    //         $('.table:not(.hidden-search)').hide();
    //         $('.pagination').hide();
    //         $('table.hidden-search').show();

    //         $.ajax({
    //             url: '/inventory/unit-measures/livesearch/'+text,
    //             type: 'get',
    //             data: {_token: csrf, method: 'get' },
    //             success: function(data){
    //                 $('table.hidden-search tbody tr').remove();
    //                 $('.table.hidden-search').find('tbody').append(data);
    //             },
    //             error: function(err){
    //                 console.log(err);
    //             }
    //         });

    //     }else{
    //         $('.table:not(.hidden-search)').show();
    //         $('.pagination').show();
    //         $('table.hidden-search tbody tr').remove();
    //         $('table.hidden-search').hide();
    //     }
    // });

    $('.content-table').DataTable({
        'searching': true,
        'info': false,
        'pagingType': 'first_last_numbers',
        'lengthMenu': [20, 50, 100]
    });


</script>
@endsection