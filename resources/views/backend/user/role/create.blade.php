@extends('backend.layouts.master')

@section('title')
    <title>{{ app_name().' | Create Role'}}</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Role</h1>
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
                                <h3 class="card-title">Create Role</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            {!! Form::open(['route' => 'admin.user.role.store', 'method' => 'post','id' => 'roleForm']) !!}
                            <div class="card-body">
                                @include('backend.user.role.partials.form')
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="{{route('admin.user.role.index')}}"
                                   class="btn btn-default float-left">Cancel</a>
                                <button class="btn btn-primary pull-right" id="roleButtonLoader"
                                        data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing"
                                        type="submit">{{__('buttons.general.crud.create')}}</button>
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
    {{ Html::script('js/backend/role.js') }}
@endsection
