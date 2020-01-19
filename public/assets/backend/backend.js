/**
 * Created by nproperty on 8/8/18.
 */


function deleteData(base_url, return_url) {

    if (confirm('Are you sure you want to delete this.?')) {
        var arr = [];
        $('input.child:checkbox:checked').each(function () {
            arr.push($(this).val());
        });

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: base_url,
            async: false,
            dataType: 'json',
            data: {data: arr},
            success: function (data) {
                if (data.success == 1) {
                    window.location = return_url;
                } else {
                    //show your error message in your div or span
                }
            },
            error: function (data) {

            }
        });
    } else {

    }
}

function deleteAction(base_url, return_url) {

    $.confirm({
        title: 'Confirm!',
        content: 'Are you sure to this action.?',
        buttons: {
            confirm: function () {
                var arr = [];
                var actionType = $('#bulk-action').val();
                $('input.child:checkbox:checked').each(function () {
                    arr.push($(this).val());
                });

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: base_url,
                    async: false,
                    dataType: 'json',
                    data: {data: arr, action_type: actionType},
                    success: function (data) {
                        if (data.success == true) {
                            window.location = return_url;
                        } else {
                            //show your error message in your div or span
                        }
                    },
                    error: function (data) {

                    }
                });
            },
            cancel: function () {
            },
        }
    });
}

function changeStatus(base_url, return_url) {
    var arr = [];
    $('input.child:checkbox:checked').each(function () {
        arr.push($(this).val());
    });

    var status = $('#change-status').val();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: base_url,
        async: false,
        dataType: 'json',
        data: {data: arr, status: status},
        success: function (data) {
            if (data.success == 1) {
                window.location = return_url;
            } else {
                //show your error message in your div or span
            }
        },
        error: function (data) {

        }
    });
}

//Set placeholder
$("input").each(function (index, value) {
    var el = $(this);
    var ph = 'Enter ' + el.prev().text();
    el.attr('placeholder', ph);
});

