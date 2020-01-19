$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
 
$("#amenity-images").fileinput({
    theme: 'fa',
    uploadUrl: uploadRoute,
    showUpload: false, // hide upload button
    showRemove: false, // hide remove button
    showBrowse: true,
    dropZoneTitle: '',
    dropZoneClickTitle: 'Click here to select {files}',
    browseOnZoneClick: true,
    initialPreview: JSON.parse(amenityImage.replace(/&quot;/g, '"')),
    initialPreviewAsData: true,
    initialPreviewFileType: 'image',
    initialPreviewConfig: JSON.parse(ImgConfig.replace(/&quot;/g, '"')),
    allowedFileExtensions: ['JPEG','JPG','PNG','GIF','TIIF',' PSD','PDF','EPS','AI','INDD','RAW'],
    overwriteInitial: false,
});

$("#amenity-images").on("filepredelete", function (event, key, jqXHR, data) {
    var abort = true;

    if (confirm("Are you sure you want to delete this image?")) {
        abort = false;
    }
    return abort;
});

$("#create-amenity,#update-amenity").validate({
    submitHandler: function (form) {
        $("#amenityButtonLoader").prop('disabled',true);
        $("#amenityButtonLoader").html('<i class="fa fa-spinner fa-spin"></i> Processing');
        form.submit();
    },
    rules: {
        name: {
            noSpace: true
        },
    }
});

