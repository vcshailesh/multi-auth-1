/**
 * Created by Developer on 24-Mar-19.
 */

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("#property-type-images").fileinput({
    theme: 'fa',
    uploadUrl: uploadRoute,
    showUpload: false, // hide upload button
    showRemove: false, // hide remove button
    showBrowse: true,
    dropZoneTitle: '',
    dropZoneClickTitle: 'Click here to select {files}',
    browseOnZoneClick: true,
    initialPreview: JSON.parse(propertyTypeImage.replace(/&quot;/g, '"')),
    initialPreviewAsData: true,
    initialPreviewFileType: 'image',
    initialPreviewConfig: JSON.parse(ImgConfig.replace(/&quot;/g, '"')),
    allowedFileExtensions: ['jpg', 'png', 'gif'],
    overwriteInitial: false,
});

$("#property-type-images").on("filepredelete", function (event, key, jqXHR, data) {
    var abort = true;

    if (confirm("Are you sure you want to delete this image?")) {
        abort = false;
    }
    return abort;
});

$("#update-property-type,#create-property-type").validate({
    submitHandler: function (form) {
        $("#propertyTypeButtonLoader").prop('disabled',true);
        $("#propertyTypeButtonLoader").html('<i class="fa fa-spinner fa-spin"></i> Processing');
        form.submit();
    },
    rules: {
        name: {
            noSpace: true
        },
    }
});
