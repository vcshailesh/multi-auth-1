@extends('backend.layouts.master')

@section('after-styles')
@endsection

@section('title')
    <title>{{ app_name().' | Permission'}}</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Permission</h1>
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
                                <h3 class="card-title">Permission List</h3>
                                <div class="card-tools"
                                     style="position: relative;right: 1rem;top: .5rem;display: inline-flex;float: right;margin-top: -34px;">
                                    {{ Form::select('action',['1'=>'Active','0'=>'In-Active','3' => 'Delete'],null,['class' => 'form-control','style' => 'margin-right:15px','id' => 'bulk-action','placeholder' => 'Select Action']) }}
                                    <a href="javascript:void(0);"
                                       onclick="return deleteAction('permission/bulk-action', 'permission');"
                                       class="btn btn-primary" style="margin-right: 15px;">Submit</a>
                                    @if(auth()->user()->is_superadmin == 1 || auth()->user()->can('Create Permission'))
                                        <a href="{{ route('admin.permission.create') }}" title="Create Permission"
                                           class="btn btn-primary"><i class="fa fa-plus-circle"></i></a>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="permission-table" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox" id="parent"/></th>
                                            <th>No</th>
                                            <th>Name</th>
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
            var oTable = $('#permission-table').DataTable({
                processing: false,
                serverSide: true,
                pageLength: 10,
                stateSave: true,
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route("admin.permission.lists") }}',
                    type: 'GET',
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
                        sortable: false,
                        searchable: false
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        sortable: true,
                    },
                    {
                        data: 'name',
                        name: 'name',
                        sortable: true,
                        searchable: true
                    },
                    {
                        data: 'status',
                        name: 'status',
                        sortable: true,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        sortable: false,
                    },
                ],
            });

            $('#permission-table').on('click', "#parent", function () {
                $('.child').not(this).prop('checked', this.checked);
            });

            $('#permission-table').on('click', '.child', function () {
                if ($('.child:checked').length == $('.child').length) {
                    $('#parent').prop('checked', true);
                } else {
                    $('#parent').prop('checked', false);
                }
            });

            $('#permission-table').on('click', '.status', function () {
                var ID = $(this).data('id');
                $.confirm({
                    title: 'Confirm!',
                    content: 'Are you sure to change status?',
                    buttons: {
                        confirm: function () {
                            $.ajax({
                                url: '{{route('admin.permission.change-status')}}',
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

            $('#permission-table').on('click', '.deleteConfirmation', function () {
                var ID = $(this).data('id');
                $.confirm({
                    title: 'Confirm!',
                    content: 'Are you sure to delete this.?',
                    buttons: {
                        confirm: function () {
                            $.ajax({
                                url: '{{route('admin.permission.destroy')}}',
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
        });
    </script>
@endsection
