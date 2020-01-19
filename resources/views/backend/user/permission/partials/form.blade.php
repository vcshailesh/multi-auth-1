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