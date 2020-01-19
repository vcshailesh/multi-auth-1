$("#permissionForm").validate({
    submitHandler: function (form) {
        $("#permissionButtonLoader").prop('disabled', true);
        $("#permissionButtonLoader").html('<i class="fa fa-spinner fa-spin"></i> Processing');
        form.submit();
    },
    rules: {
        name:{
            noSpace: true
        }
    }
});