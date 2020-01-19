<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="lable-name">Name<span class="required">*</span></label>
            {!! Form::text('name',null, ['class' => 'form-control','placeholder'=>__('lables.backend.global_modules.property_type.table.name'),'required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lable-name">Status<span class="required">*</span></label>
            {!! Form::select('status',[''=>'']+config('backend.backend.status'), null , ['class' => 'form-control select2','id'=>'status','data-placeholder'=>'Select Status','required']) !!}
            <label id="status" class="error" for="status"></label>
        </div>
    </div>
</div>

@if(\Request::route()->getName() == 'admin.user.role.create')
    <div class="row">
        <div class="col-md-12">
            <fieldset>
                <legend>Permissions :</legend>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input name="check_all" type="checkbox" class="form-check-input checkAll"> Check ALL
                    </label>
                </div>
                @foreach ($permissions as $permission)
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input name="permissions[]" type="checkbox"
                                   class="form-check-input checkbox"
                                   value="{{$permission->id}}">{{$permission->name}}
                        </label>
                    </div>
                @endforeach
            </fieldset>
        </div>
    </div>
@endif

@if(\Request::route()->getName() == 'admin.user.role.edit')
    <div class="row">
        <div class="col-md-12">
            <fieldset>
                <legend>Permissions :</legend>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input name="check_all" type="checkbox" class="form-check-input checkAll"> Check ALL
                    </label>
                </div>
                @foreach ($permissions as $key => $value)
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="checkbox" name="permissions[]" class="checkbox"
                                   value="{{$value->id}}" {{in_array($value->id,$roleAssignedPermission) ? 'checked' : ''}}/>
                            {{$value->name}}
                        </label>
                    </div>
                @endforeach
            </fieldset>
        </div>
    </div>
@endif