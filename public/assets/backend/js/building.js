$("#create-building,#edit-building").validate({
    submitHandler: function (form) {
        $("#buildingButtonLoader").prop('disabled', true);
        $("#buildingButtonLoader").html('<i class="fa fa-spinner fa-spin"></i> Processing');
        form.submit();
    },
    rules: {
        name: {
            noSpace: true
        },
        pincode: {
            number: true
        },
        total_floor: {
            number: true
        },
        total_units: {
            number: true
        },
        no_of_tower:{
            number: true
        }
    }
});

$('#name').focusout(function () {
    generateBuildingSlug();
});

$('#area').change(function () {
    generateBuildingSlug();
});

function generateBuildingSlug() {
    var buildingName = $('#name').val();
    var areaName = $("#area").val();
    var buildingSlug = '';

    if (buildingName != '' && buildingName != undefined) {
        buildingSlug += buildingName.replace(' ', '-')
    }

    if (areaName != '' && areaName != undefined) {
        buildingSlug += '-' + areaName
    }

    $("#buildingSlug").val(buildingSlug.replace(/\s+/g, "-").toLowerCase());
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("#create-building-images").fileinput({
    theme: 'fa',
    uploadUrl: uploadRoute,
    showUpload: false, // hide upload button
    showRemove: false, // hide remove button
    showBrowse: true,
    dropZoneTitle: '',
    dropZoneClickTitle: 'Click here to select {files}',
    browseOnZoneClick: true,
    allowedFileExtensions: ['JPEG','JPG','PNG','GIF','TIIF',' PSD','PDF','EPS','AI','INDD','RAW'],
});

$("#update-building-images").fileinput({
    theme: 'fa',
    uploadUrl: uploadRoute,
    showUpload: false, // hide upload button
    showRemove: false, // hide remove button
    showBrowse: true,
    dropZoneTitle: '',
    dropZoneClickTitle: 'Click here to select {files}',
    browseOnZoneClick: true,
    allowedFileExtensions: ['JPEG','JPG','PNG','GIF','TIIF',' PSD','PDF','EPS','AI','INDD','RAW'],
    overwriteInitial: false,
    initialPreviewAsData: true,
    initialPreview: JSON.parse(buildingImage.replace(/&quot;/g, '"')),
    initialPreviewConfig: JSON.parse(ImgConfig.replace(/&quot;/g, '"')),
});

$("#update-building-images").on("filepredelete", function (event, key, jqXHR, data) {
    var abort = true;

    if (confirm("Are you sure you want to delete this image?")) {
        abort = false;
    }

    return abort;
});

$("#createNewBuilding").validate({
    submitHandler: function (form) {
        $("#buildingButtonLoader").prop('disabled', true);
        $("#buildingButtonLoader").html('<i class="fa fa-spinner fa-spin"></i> Processing');
        console.log('form-->',$(form).serialize());
        $.ajax({
            url: form.action,
            type: form.method,
            data: $(form).serialize(),
            success: function(response) {
                if(response.error == true){
                    toastr.warning(response.message);
                }

                if(response.success == true){
                    toastr.success(response.message);
                    location.reload();
                }

            }
        });
        // form.submit();
    },
    rules: {
        name: {
            noSpace: true
        },
        pincode: {
            number: true
        },
        total_floor: {
            number: true
        },
        total_units: {
            number: true
        },
        no_of_tower:{
            number: true
        }
    }
});

