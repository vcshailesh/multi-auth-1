<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="lable-icon">User Type</label>
            {!! Form::select('user_type',[''=>'']+config('backend.backend.package_user_type'),null,['id' => 'user_type','class' => 'form-control select2','data-placeholder' => '-- Select User Type --','required']) !!}
            <label id="user_type-error" for="user_type" class="error" generate="true"></label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="lable-icon">Package</label>
            {!! Form::select('package_id[]',!empty($packageLists) ? $packageLists : [''=>''] , !empty($frontUser->package_id) ? explode(',',$frontUser->package_id): null ,['class' => 'form-control select2','data-placeholder' => '-- Select Package --','multiple'=>'multiple','required']) !!}
            <label id="package_id[]-error" for="package_id[]" class="error" generate="true"></label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="lable-name">Name</label>
            {!! Form::text('name',null, ['class' => 'form-control','placeholder'=>'Enter Name','required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lable-name">Email</label>
            {!! Form::text('email',null, ['class' => 'form-control','placeholder'=>'Enter Email']) !!}
            @if ($errors->has('email'))
                <div class="error">{{ $errors->first('email') }}</div>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lable-name">Alternate Email</label>
            {!! Form::text('alternate_email',null,['class' => 'form-control','placeholder'=>'Enter Alternate Email']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lable-name">Mobile Number</label>
            {!! Form::text('mobile_number',null, ['class' => 'form-control','placeholder'=>'Enter Mobile Number','required','onkeypress' => 'return isNumberKey(event);']) !!}
            @if ($errors->has('mobile_number'))
                <div class="error">{{ $errors->first('mobile_number') }}</div>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lable-name">Alternate Mobile Number</label>
            {!! Form::text('alternate_mobile_number',null, ['class' => 'form-control','placeholder'=>'Enter Alternate Mobile Number','onkeypress' => 'return isNumberKey(event);']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lable-type">Password</label>
            {!! Form::text('password',!empty($frontUser->show_password) ? $frontUser->show_password : null,['id' => 'password','class' => 'form-control','placeholder'=>'Enter Password']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lable-type">Confirm Password</label>
            {!! Form::text('password_confirmation',!empty($frontUser->show_password) ? $frontUser->show_password : null,['class' => 'form-control','placeholder'=>'Enter Confirm Password']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lable-name">Description</label>
            {!! Form::textarea('description',null, ['class' => 'form-control','placeholder'=>'Enter description','rows' => '2','maxlength'=>'100']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lable-profile-image">Select Profile Image</label>
            {!! Form::file('profile_image', ['class' => 'form-control file','id'=> \Request::route()->getName() == 'admin.front-user.edit' ? 'update-profile-image' : 'create-profile-image']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="lable-type">Status</label>
            {!! Form::select('status',[''=>'']+config('backend.backend.status'),1, ['class' => 'form-control select2','id'=>'type','data-placeholder'=>'-- Select Status --']) !!}
        </div>
    </div>
</div>