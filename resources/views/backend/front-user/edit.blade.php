@extends('backend.layouts.master')

@section('title')
<title>{{ app_name().' | Edit User'}}</title>
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
                            {!! Form::model($frontUser,['route' => ['admin.front-user.update',$frontUser], 'method' => 'patch','files'=>true,'enctype'=>'multipart/form-data','id' => 'updateUserForm']) !!}
                            <div class="card-body">
                                @include('backend.front-user.partials.form')
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button class="btn btn-default float-left">Cancel</button>
                                <button class="btn btn-primary pull-right" id="userButtonLoader"
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
    <script type="text/javascript">
        var uploadRoute = '#';
        var profileImage = '[]';
        var ImgConfig = '[]';
    </script>
    {{ Html::script('js/backend/frontend-user.js') }}
@endsection
