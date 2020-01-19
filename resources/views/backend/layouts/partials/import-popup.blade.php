{{-- Import Data Model Popup --}}
<div id="importModel" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        {{ Form::open(['route'=>$routeName,'method'=>'post','file'=>'true','enctype'=>'multipart/form-data','id'=>$formId]) }}
                <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Import {{$moduleName}}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="form-group">
                        <label for="exampleInputFile">Upload Import File</label>
                        <input type="file" name="importfile" required extension="csv|xls"/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Import"/>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>