@extends('backend.layouts.master')

@section('title')
<title>{{ app_name().' | Edit Amenity'}}</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage User</h1>
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
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit User</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            {!! Form::model($adminUser,['route' => ['admin.admin-user.update',$adminUser], 'method' => 'patch','files'=>true,'enctype'=>'multipart/form-data','id' => 'adminUserForm']) !!}
                            <div class="card-body">
                                @include('backend.admin-user.partials.form')
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="{{route('admin.admin-user.index')}}" class="btn btn-default float-left">Cancel</a>
                                <button class="btn btn-primary pull-right" id="adminUserButtonLoader"
                                        data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing"
                                        type="submit">{{__('buttons.general.crud.update')}}</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                </div>
            </div>
        </section>
    </div>
@endsection

@section('after-scripts')
    {{ Html::script('js/backend/admin-user.js') }}
@endsection
