$("#createUserForm,#updateUserForm").validate({
    submitHandler: function (form) {
        $("#userButtonLoader").prop('disabled',true);
        $("#userButtonLoader").html('<i class="fa fa-spinner fa-spin"></i> Processing');
        form.submit();
    },
    rules: {
        password_confirmation: {
            equalTo: "#password"
        },
        description:{
            maxlength: 100
        }
    },
    messages: {
        password_confirmation: {
            equalTo: 'Confirm password doesn\'t match'
        }
    }
});

$('#create-profile-image').fileinput({
    theme: 'fa',
    uploadUrl: uploadRoute,
    showUpload: false,
    showRemove: false,
    allowedFileExtensions: ['JPEG','JPG','PNG','GIF','TIIF',' PSD','PDF','EPS','AI','INDD','RAW'],
    overwriteInitial: true,
    browseOnZoneClick: true,
    dropZoneEnabled: false,
    dropZoneTitle: '',
    mainClass: "input-group-md",
    dropZoneClickTitle: 'Click here to select {files}',
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("#update-profile-image").fileinput({
    theme: 'fa',
    uploadUrl: uploadRoute,
    showUpload: false, // hide upload button
    showRemove: false, // hide remove button
    required: true,
    overwriteInitial: true,
    initialPreviewAsData: true,
    initialPreview: JSON.parse(profileImage.replace(/&quot;/g, '"')),
    initialPreviewConfig: JSON.parse(ImgConfig.replace(/&quot;/g, '"')),
    allowedFileExtensions: ['JPEG','JPG','PNG','GIF','TIIF',' PSD','PDF','EPS','AI','INDD','RAW'],
});

$("#update-profile-image").on("filepredelete", function (event, key, jqXHR, data) {
    var abort = true;

    if (confirm("Are you sure you want to delete this image?")) {
        abort = false;
    }
    return abort;
});