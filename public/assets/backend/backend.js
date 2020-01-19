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

//get state of country
$('body').on('change', '.country-select', function () {
    var stateEl = $(".state-select");
    $('.state-select').html('').select2();
    $('.city-select').html('').select2();
    $('.area-select').html('').select2();
    stateEl.append('<option value=""></option>');
    $.get(stateListRoute, {countryId: $(this).val()}, function (resp) {
        $.each(resp.states, function (index, value) {
            stateEl.append('<option value=' + index + '>' + value + '</option>');
        });
    });
});


//get city of state
$('body').on('change', '.state-select', function () {
    var cityEl = $(".city-select");
    $('.city-select').html('').select2();
    $('.area-select').html('').select2();
    cityEl.append('<option value=""></option>');
    $.get(cityListRoute, {stateId: $(this).val()}, function (resp) {
        $.each(resp.cities, function (index, value) {
            cityEl.append('<option value=' + index + '>' + value + '</option>');
        });
    });
});


//get area of city
$('body').on('change', '.city-select', function () {
    var areaEl = $(".area-select");
    $('.area-select').html('').select2();
    areaEl.append('<option value=""></option>');
    $.get(areaListRoute, {cityId: $(this).val()}, function (resp) {
        $.each(resp.area, function (index, value) {
            areaEl.append('<option value=' + index + '>' + value + '</option>');
        });
    });
});

//get user list
$(".user-list-select").select2({
    ajax: {
        url: userListRoute,
        data: function (params) {
            var query = {
                search: params.term,
                type: 'public'
            }
            return query;
        },
        processResults: function (data) {
            return {
                results: data.results
            };
        }
    },
    placeholder: "Select User"
});

//get amenities list
function amenities() {
    $(".amenities-select").select2({
        ajax: {
            url: amenityRoute,
            data: function (params) {
                var query = {
                    search: params.term,
                    type: 'public'
                }
                return query;
            },
            processResults: function (data) {
                return {
                    results: data.results
                };
            }
        },
        placeholder: "Select Amenity"
    });
}