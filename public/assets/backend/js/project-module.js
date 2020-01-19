


$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
});
$(function () {
    ClassicEditor
        .create(document.querySelector('#textarea'))
        .then(function (editor) {
        })
        .catch(function (error) {
        })
    $('.textarea').wysihtml5({
        toolbar: { fa: true }
    })
})

$("#clone-project").click(function () {
    var project_count = $('#project-count').val();
    var htmlData = '<div class="col-md-12 project_'+project_count+'">\n' +
        '    <!-- project detail start -->\n' +
        '    <div class="form-section">\n' +
        '        <div class="form-section-header">\n' +
        '            <h5>Project Detail </h5>\n' +
        '            <div class="card-header">\n' +
        '                <div class="card-tools">\n' +
        '                    <a title="add more projects" onclick="removeProject('+project_count+')" class="btn btn-primary"><i class="fa fa-minus-circle"></i></a>\n' +
        '                </div>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '        <div class="form-section-body">\n' +
        '            <div class="row">\n' +
        '                <div class="row">\n' +
        '                    <div class="col-md-4">\n' +
        '                        <div class="form-group">\n' +
        '                            <label for="lable-name">Project Type</label>\n' +
        '                            <select id="project_type" onchange="addMoreProjectType('+project_count+')" class="form-control project_type_'+project_count+' select2" data-placeholder="Select Project Type" data-id="project_type_'+project_count+'" name="project_type[]">\n' +
        '                            </select>\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                    <div class="col-md-4">\n' +
        '                        <div class="form-group">\n' +
        '                            <label for="lable-name">Type</label>\n' +
        '                            <select id="project_type_id" class="form-control project_type_id_'+project_count+' select2" data-placeholder="Select Project Type" data-id="project_type_id_'+project_count+'" name="project_type_id[]"></select>\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                    <div class="col-md-4" id="washroom_div_'+project_count+'" >\n' +
        '                        <div class="form-group">\n' +
        '                            <label for="lable-name">washroom</label>\n' +
        '                            <select id="washroom" class="form-control washroom_'+project_count+' select2" data-placeholder="Select Washroom"  data-id="washroom_'+project_count+'" name="washroom[]">\n' +
        '                            </select>\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                    <div class="col-md-4" id="pantry_div_'+project_count+'" >\n' +
        '                        <div class="form-group">\n' +
        '                            <label for="lable-name">Pantry</label>\n' +
        '                            <select data-placeholder="Select Status Option" class="form-control pantry_'+project_count+' select2" data-id="pantry_'+project_count+'" name="pantry[]">\n' +
        '                            </select>\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                    <div class="col-md-4" id="configuration_div_'+project_count+'" >\n' +
        '                        <div class="form-group">\n' +
        '                            <label for="lable-name">Configuration</label>\n' +
        '                            <select data-placeholder="Select Configuration Option" class="form-control configuration_'+project_count+' select2" data-id="configuration_'+project_count+'" name="configuration[]">\n' +
        '                            </select>\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                    <div class="col-md-4" id="total_bathrooms_div_'+project_count+'" >\n' +
        '                        <div class="form-group">\n' +
        '                            <label for="lable-name">Total Bathrooms</label>\n' +
        '                            <select data-placeholder="Select Total Bathrooms" class="form-control total_bathrooms_'+project_count+' select2" data-id="total_bathrooms_'+project_count+'" name="total_bathrooms[]">\n' +
        '                            </select>\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                    <div class="col-md-4" id="total_balconies_div_'+project_count+'" >\n' +
        '                        <div class="form-group">\n' +
        '                            <label for="lable-name">Total Balconies</label>\n' +
        '                            <select data-placeholder="Select Total Balconies" class="form-control total_balconies_'+project_count+' select2" data-id="total_balconies_'+project_count+'" name="total_balconies[]">\n' +
        '                                <option value="" selected="selected">Select Total Balconies</option>\n' +
        '                            </select>\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                    <div class="col-md-4" id="is_compound_div_'+project_count+'" >\n' +
        '                        <div class="form-group">\n' +
        '                            <label for="lable-name">Is Compound Wall Made?</label>\n' +
        '                            <select data-placeholder="Select Is Compound Wall Made Option" class="form-control is_compound_'+project_count+' select2" data-id="is_compound_'+project_count+'" name="is_compound[]">\n' +
        '                            </select>\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                    <div class="col-md-4" id="unit_area">\n' +
        '                        <div class="form-group">\n' +
        '                            <label for="lable-name">Unit Area</label>\n' +
        '                            <input id="available_unit" class="form-control unit_area_'+project_count+'" data-placeholder="Enter Total Available Unit" data-id="unit_area_'+project_count+'" name="unit_area[]" type="text" placeholder="Enter Unit Area">\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                    <div class="col-md-4">\n' +
        '                        <div class="form-group">\n' +
        '                            <label for="lable-name">Area Unit</label>\n' +
        '                            <select id="area_unit" class="form-control area_unit_'+project_count+' select2" data-placeholder="Select Area Unit" data-id="area_unit_'+project_count+'" name="area_unit_new[]">\n' +
        '                            </select>\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                    <div class="col-md-4">\n' +
        '                        <div class="form-group">\n' +
        '                            <label for="lable-name">Total Available Unit</label>\n' +
        '                            <input id="available_unit" class="form-control available_unit_'+project_count+'" data-placeholder="Enter Total Available Unit" data-id="available_unit_'+project_count+'" name="available_unit_new[]" type="text" placeholder="Enter Total Available Unit">\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                    <div class="col-md-4">\n' +
        '                        <div class="form-group">\n' +
        '                            <label for="lable-name">Hide Price</label>\n' +
        '                            <input id="hide_price" class="form-control hide_price_'+project_count+'" data-id="hide_price_'+project_count+'" name="hide_price_new[]" type="checkbox" value="1" placeholder="Enter Hide Price">\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                    <div class="col-md-4">\n' +
        '                        <div class="form-group">\n' +
        '                            <label for="lable-name">Price </label>\n' +
        '                            <input id="price" class="form-control price_'+project_count+'" data-placeholder="Price"  data-id="price_'+project_count+'" name="price_new[]" type="text" placeholder="Enter Price * ">\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                    <div class="col-md-4">\n' +
        '                        <div class="form-group">\n' +
        '                            <label for="lable-name">Furnished Status</label>\n' +
        '                            <select id="furnished_status" class="form-control furnished_status_'+project_count+' select2" data-placeholder="Select Furnished Status"  data-id="furnished_status_'+project_count+'" name="furnished_status[]">\n' +
        '                            </select>\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                    <div class="col-md-4">\n' +
        '                        <div class="form-group">\n' +
        '                            <label for="lable-name">Status</label>\n' +
        '                            <select data-placeholder="Select Status Option" class="form-control status_'+project_count+' select2" data-id="status_'+project_count+'" name="status_new[]">\n' +
        '                            </select>\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                    <div class="col-md-4">\n' +
        '                        <div class="form-group">\n' +
        '                            <label for="lable-name">Project Specialist Image</label>\n' +
        '                            <input multiple class="form-control project_special_image_'+project_count+'" data-id="project_special_image_'+project_count+'" name="project_special_image1[]" type="file" placeholder="Enter Project Specialist Image">\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                </div>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '    </div>\n' +
        '    <!--project Detail End -->\n' +
        '</div>';
    $('.project-clone-data').append(htmlData);
    addConfigValue('project_type_',project_module_type);
    addConfigValue('washroom_',washroom);
    addConfigValue('area_unit_',area_unit);
    addConfigValue('configuration_',property_configuration);
    addConfigValue('total_bathrooms_',total_bathrooms);
    addConfigValue('total_balconies_',total_balconies);
    addConfigValue('furnished_status_',furnished_status);
    $.each(yes_no, function (index, value) {
        var option = new Option(value, index, false, false);
        $('.status_'+project_count+',.is_compound_'+project_count+',.pantry_'+project_count).append(option).trigger('change');
    });
    $('#configuration_div_'+project_count+',#total_bathrooms_div_'+project_count+',#total_balconies_div_'+project_count+',#washroom_div_'+project_count+',#pantry_div_'+project_count+',#is_compound_div_'+project_count+'').hide();
    $('#project-count').val((parseInt(project_count)+1));
    $('.select2').select2();
});
function addConfigValue(className,configValue){
    var option = new Option('', '', false, false);
    var project_count = $('#project-count').val();
    $('.'+className+project_count).append(option).trigger('change');
    $.each(configValue, function (index, value) {
        var option = new Option(value, index, false, false);
        $('.'+className+project_count).append(option).trigger('change');
    });
}
function addMoreProjectType(projectId) {
    var projectTypeValue = $(".project_type_"+projectId).val();
    if(projectTypeValue){
        changeProjectDetail(projectTypeValue,projectId)
    }
}
function removeProject(id){
    $('.project_'+id).remove();
}
$("#state_id").change(function () {
    $("#city_id").empty().val(null).trigger('change');
    var stateId = $(this).val();
    if(stateId) {
        var option = new Option('', '', false, false);
        $("#city_id").append(option).trigger('change');

        $.get(getCityList, {stateId: stateId}, function (data) {
            $.each(data.cities, function (index, value) {
                var option = new Option(value, index, false, false);
                $("#city_id").append(option).trigger('change');
            });
        });
    }
});
$("#city_id").change(function () {
    $("#area_id").empty().val(null).trigger('change');
    var cityId = $(this).val();
    if(cityId){
        var option = new Option('', '', false, false);
        $("#area_id").append(option).trigger('change');

        $.get(getAreaList, {cityId: cityId}, function (data) {
            $.each(data.area, function (index, value) {
                var option = new Option(value, index, false, false);
                $("#area_id").append(option).trigger('change');
            });
        });
    }

});

$("#configuration_div_1,#total_bathrooms_div_1,#total_balconies_div_1,#washroom_div_1,#pantry_div_1,#is_compound_div_1").hide();
function changeProjectDetail(projectId,divCount){
    if(projectId==1){
        $("#washroom_div_"+divCount+",#pantry_div_"+divCount).show();
        $("#configuration_div_"+divCount+",#total_bathrooms_div_"+divCount+",#total_balconies_div_"+divCount+",#is_compound_div_"+divCount+"").hide();
    } else if(projectId==2){
        $("#washroom_div_"+divCount+",#pantry_div_"+divCount+",#is_compound_div_"+divCount+"").hide();
        $("#configuration_div_"+divCount+",#total_bathrooms_div_"+divCount+",#total_balconies_div_"+divCount+"").show();
    } else {
        $("#is_compound_div_"+divCount+"").show();
        $("#configuration_div_"+divCount+",#total_bathrooms_div_"+divCount+",#total_balconies_div_"+divCount+",#washroom_div_"+divCount+",#pantry_div_"+divCount+"").hide();
    }

    var option = new Option('', '', false, false);
    $(".project_type_id_"+divCount).append(option).trigger('change');
    $.get('{{ route("admin.project-module.project-type.list-json") }}', {projectId: projectId}, function (data) {
        $.each(data.projectTypeData, function (index, value) {
            var option = new Option(value, index, false, false);
            $(".project_type_id_"+divCount).append(option).trigger('change');
        });
    });

}
$("#project_type").change(function () {
    var projectId = $(this).val();
    if(projectId){
        changeProjectDetail(projectId,1)
    }
});