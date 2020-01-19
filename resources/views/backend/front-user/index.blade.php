@extends('backend.layouts.master')

@section('after-styles')
@endsection

@section('title')
    <title>{{ app_name().' | Users'}}</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Users</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {!! Breadcrumbs::render() !!}
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Users Filter</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" id="filter-form">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="lable-name">User Type</label>
                                                {!! Form::select('user_type',[''=>'']+config('backend.backend.package_user_type'), null , ['id'=>'user_type','class' => 'form-control select2','data-placeholder'=>'Select User Type']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="lable-type">Package</label>
                                                {!! Form::select('user_package',[''=>''],null, ['class' => 'form-control select2','id'=>'user_package','data-placeholder'=>'-- Select Package --']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="lable-type">Status</label>
                                                {!! Form::select('status',[''=>'']+config('backend.backend.status'),null, ['class' => 'form-control select2','id'=>'status','data-placeholder'=>'-- Select Status --']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ Form::submit('Filter',['class' => 'btn btn-primary','style' => 'margin-top:30px']) }}
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Users List</h3>
                                <div class="card-tools"
                                     style="position: relative;right: 1rem;top: .5rem;display: inline-flex;float: right;margin-top: -34px;">
                                    {{ Form::select('action',['1'=>'Active','0'=>'In-Active','3' => 'Delete'],null,['class' => 'form-control','style' => 'margin-right:15px','id' => 'bulk-action','placeholder' => 'Select Action']) }}
                                    <a href="javascript:void(0);"
                                       onclick="return deleteAction('front-user/bulk-action', 'front-user');"
                                       class="btn btn-primary" style="margin-right: 15px;">Submit</a>
                                    @can('Create User')
                                        <a href="{{ route('admin.front-user.create') }}" title="Create User"
                                           class="btn btn-primary" style="margin-right: -20px"><i
                                                    class="fa fa-plus-circle"></i></a>
                                    @endcan
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="users-table" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox" id="parent"/></th>
                                            <th>No</th>
                                            <th>User Type</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile No</th>
                                            <th>Live Property</th>
                                            <th>Response</th>
                                            <th>Created By</th>
                                            <th>Created Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>
    </div>
@endsection

@section('after-scripts')
    <script src="{{asset('assets/backend/backend.js')}}" type="application/javascript"></script>
    <script>
        $(function () {
            var oTable = $('#users-table').DataTable({
                processing: false,
                serverSide: true,
                pageLength: 10,
                stateSave: true,
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route("admin.front-user.lists") }}',
                    type: 'post',
                    data: function (d) {
                        d.user_type = $('select[name=user_type]').val();
                        d.user_status = $('select[name=status]').val();
                        d.user_package = $('select[name=user_package]').val()
                    },
                    error: function (xhr, err) {
                        if (err === 'parsererror')
                            location.reload();
                    }
                },
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                        render: function (data, type, full, meta) {
                            return '<input type="checkbox" class="child" name="id[]" value="' + data + '">';
                        },
                        sortable: true,
                        searchable: false
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        sortable: false,
                    },
                    {
                        data: 'user_type',
                        name: 'user_type',
                        sortable: true,
                        searchable: true
                    },
                    {
                        data: 'name',
                        name: 'name',
                        sortable: true,
                        searchable: true
                    },
                    {
                        data: 'email',
                        name: 'email',
                        sortable: true,
                        searchable: true
                    },
                    {
                        data: 'mobile_number',
                        name: 'mobile_number',
                        sortable: true,
                        searchable: true
                    },
                    {
                        data: 'live_property',
                        name: 'live_property',
                        sortable: true,
                        searchable: true
                    },
                    {
                        data: 'response',
                        name: 'response',
                        sortable: true,
                        searchable: true
                    },
                    {
                        data: 'created_by',
                        name: 'created_by',
                        sortable: true,
                        searchable: true
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        sortable: true,
                        searchable: true
                    },
                    {
                        data: 'status',
                        name: 'status',
                        sortable: true,
                        searchable: true
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        sortable: false,
                    },
                ],
            });

            $('#filter-form').on('submit', function (e) {
                oTable.draw();
                e.preventDefault();
            });

            $('#users-table').on('click', "#parent", function () {
                $('.child').not(this).prop('checked', this.checked);
            });

            $('#users-table').on('click', '.child', function () {
                if ($('.child:checked').length == $('.child').length) {
                    $('#parent').prop('checked', true);
                } else {
                    $('#parent').prop('checked', false);
                }
            });

            $('#users-table').on('click', '.status', function () {
                var ID = $(this).data('id');
                $.confirm({
                    title: 'Confirm!',
                    content: 'Are you sure to change status?',
                    buttons: {
                        confirm: function () {
                            $.ajax({
                                url: '{{route('admin.front-user.change-status')}}',
                                data: {'id': ID, _token: '{{ csrf_token() }}'},
                                type: "POST",
                                success: function (data) {
                                    if (data.success == true) {
                                        oTable.draw();
                                    }
                                },
                                error: function (error) {
                                }
                            });
                        },
                        cancel: function () {
                        },
                    }
                });
            });

            $('#users-table').on('click', '.deleteConfirmation', function () {
                var ID = $(this).data('id');
                $.confirm({
                    title: 'Confirm!',
                    content: 'Are you sure to delete this.?',
                    buttons: {
                        confirm: function () {
                            $.ajax({
                                url: '{{route('admin.front-user.destroy')}}',
                                data: {'id': ID, _token: '{{ csrf_token() }}'},
                                type: "DELETE",
                                success: function (data) {
                                    if (data.success == true) {
                                        oTable.draw();
                                    }
                                },
                                error: function (error) {
                                }
                            });
                        },
                        cancel: function () {
                        },
                    }
                });
            });

            $('#user_type').change(function () {
                var userType = $(this).val();
                $.ajax({
                    url: '{{route('admin.getPackageListBasedOnUserType')}}',
                    data: {'user_type': userType, _token: '{{ csrf_token() }}'},
                    type: "POST",
                    success: function (data) {
                        if (data.success == true) {
                            $('#user_package').empty().val(null).trigger('change');
                            var newOption = new Option('', '', false, false);
                            $('#user_package').append(newOption).trigger('change');
                            $.each(data.package_list,function (index,value) {
                                var newOption = new Option(value, index, false, false);
                                $('#user_package').append(newOption).trigger('change');
                            });
                        }
                    },
                    error: function (error) {
                    }
                });
            })
        });
    </script>
@endsection
