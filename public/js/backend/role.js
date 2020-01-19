$("#roleForm").validate({
    submitHandler: function (form) {
        $("#roleButtonLoader").prop('disabled', true);
        $("#roleButtonLoader").html('<i class="fa fa-spinner fa-spin"></i> Processing');
        form.submit();
    },
    rules: {
        name:{
            noSpace: true
        }
    }
});

$('.checkAll').on('change', function() {
    $('.checkbox').prop('checked', $(this).prop("checked"));
});

$('.checkAll').change(function(){ //".checkbox" change
    if($('.checkbox:checked').length == $('.checkbox').length){
        $('.checkbox').prop('checked',true);
    }else{
        $('.checkbox').prop('checked',false);
    }
});