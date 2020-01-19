<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="lable-icon">Role<span class="required">*</span></label>
            {!! Form::select('user_type[]',$roles,!empty($adminUser->roles[0]['id']) ? $adminUser->roles[0]['id'] : null,['id'=> 'user_type','class' => 'form-control select2','placeholder' => 'Select Role','required']) !!}
            <label id="user_type-error" class="error" for="user_type"></label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="lable-name">Name<span class="required">*</span></label>
            {!! Form::text('name',null, ['class' => 'form-control','placeholder'=>'Enter Name','required']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="lable-name">Email<span class="required">*</span></label>
            {!! Form::text('email',null, ['class' => 'form-control','placeholder'=>'Enter Email','required']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="lable-name">Mobile Number<span class="required">*</span></label>
            {!! Form::text('mobile_number',null, ['class' => 'form-control','placeholder'=>'Enter Mobile Number','required']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="lable-type">Password<span class="required">*</span></label>
            {!! Form::text('password',!empty($adminUser->show_password) ? $adminUser->show_password : null,['id' => 'password','class' => 'form-control','placeholder'=>'Enter Password','required']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="lable-type">Confirm Password<span class="required">*</span></label>
            {!! Form::text('password_confirmation',null,['class' => 'form-control','placeholder'=>'Enter Confirm Password','required']) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="lable-type">Status<span class="required">*</span></label>
            {!! Form::select('status',[''=>'']+config('backend.backend.status'), null , ['class' => 'form-control select2','id'=>'type','data-placeholder'=>'Select Status']) !!}
        </div>
    </div>
</div>