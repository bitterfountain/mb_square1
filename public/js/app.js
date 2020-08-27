
$(document).ready(function () {


    // ---------------  savePost ------------------------------------
    $('.savePost').on('click', function (e)
    {
        e.preventDefault();

        var obj_id          = $(this).attr('id');
        var route_post      = $(this).attr('data-route');
        var my_data         = new FormData( $('#editForm')[0] );
        var loader          = "<img class='ajax_loader' src='/img/ajax_loading_peque.gif' alt='' />";

        // debugger;
        $('#ajaxresponsebox').html('');
        $('.alert-info').hide();

        $('#'+obj_id).children('.ajax_loader').remove();
        $('#'+obj_id).append(loader);

        $.ajax({
            type: "POST",
            url:route_post,
            data: my_data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (data) {
                
                $('#'+obj_id).children('.ajax_loader').remove();

                $('#ajaxresponsebox').removeClass('green');

                $('.alert-info').show();

                if(data.error == 1 && data.validator==1)
                {
                    $('#ajaxresponsebox').removeClass('hidden');
                    $('#ajaxresponsebox').html('');
                    $.each(data.response, function (index, value) {
                        $('#ajaxresponsebox').append( '<span class="red">'+value+'</span><br />'  );
                    });
                } else if (data.error == 1) {
                    $('#ajaxresponsebox').removeClass('hidden');
                    $('#ajaxresponsebox').append(data.response);
                } else if (data.error == 0) {

                    $('#editForm')[0].reset();

                    $('#ajaxresponsebox').addClass('green');
                    $('#ajaxresponsebox').removeClass('hidden');
                    $('#ajaxresponsebox').append(data.response);

                }
            },
            error: function (data) {
                $('#ajaxresponsebox').addClass('error').html(data.response);
            }
        });
    });

    // ---------------  register ------------------------------------
    $('.saveForm').on('click', function (e)
    {
        e.preventDefault();

        var obj_id          = $(this).attr('id');
        var route_post      = $(this).attr('data-route');
        var my_data         = new FormData( $('#editForm')[0] );
        var loader          = "<img class='ajax_loader' src='/img/ajax_loading_peque.gif' alt='' />";

        // debugger;
        $('#ajaxresponsebox').html('');
        $('.alert-info').hide();

        $('#'+obj_id).children('.ajax_loader').remove();
        $('#'+obj_id).append(loader);

        $.ajax({
            type: "POST",
            url:route_post,
            data: my_data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (data) {
                
                $('#'+obj_id).children('.ajax_loader').remove();

                $('#ajaxresponsebox').removeClass('green');

                $('.alert-info').show();

                if(data.error == 1 && data.validator==1)
                {
                    $('#ajaxresponsebox').removeClass('hidden');
                    $('#ajaxresponsebox').html('');
                    $.each(data.response, function (index, value) {
                        $('#ajaxresponsebox').append( '<span class="red">'+value+'</span><br />'  );
                    });
                } else if (data.error == 1) {
                    $('#ajaxresponsebox').removeClass('hidden');
                    $('#ajaxresponsebox').append(data.response);
                } else if (data.error == 0) {

                    $('#editForm')[0].reset();

                    $('#ajaxresponsebox').addClass('green');
                    $('#ajaxresponsebox').removeClass('hidden');
                    $('#ajaxresponsebox').append(data.response);
                }
            },
            error: function (data) {
                $('#ajaxresponsebox').addClass('error').html(data.response);
            }
        });
    });

    // ---------------  login ------------------------------------
    $('.loginUser').on('click', function (e)
    {
        e.preventDefault();

        var obj_id          = $(this).attr('id');
        var route_post      = $(this).attr('data-route');
        var my_data         = new FormData( $('#loginForm')[0] );
        var loader          = "<img class='ajax_loader' src='/img/ajax_loading_peque.gif' alt='' />";

        // debugger;
        $('#ajaxresponsebox').html('');
        $('.alert-info').hide();

        $('#'+obj_id).children('.ajax_loader').remove();
        $('#'+obj_id).append(loader);

        $.ajax({
            type: "POST",
            url:route_post,
            data: my_data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (data) {
                
                $('#'+obj_id).children('.ajax_loader').remove();

                $('#ajaxresponsebox').removeClass('green');
                $('#ajaxresponsebox').removeClass('red');

                $('.alert-info').show();

                if(data.error == 1 && data.validator==1)
                {
                    $('#ajaxresponsebox').removeClass('hidden');
                    $('#ajaxresponsebox').html('');
                    $.each(data.response, function (index, value) {
                        $('#ajaxresponsebox').append( '<span class="red">'+value+'</span><br />'  );
                    });
                } else if (data.error == 1) {
                    $('#ajaxresponsebox').addClass('red');
                    $('#ajaxresponsebox').removeClass('hidden');
                    $('#ajaxresponsebox').append(data.response);
                } else if (data.error == 0) {

                    $('#loginForm')[0].reset();

                    $('#ajaxresponsebox').addClass('green');
                    $('#ajaxresponsebox').removeClass('hidden');
                    $('#ajaxresponsebox').append(data.response);

                    window.location.href = "/";
                }
            },
            error: function (data) {
                $('#ajaxresponsebox').addClass('error').html(data.response);
            }
        });
    });


    // ---------------  logout  ------------------------------------
    $('.logOut').on('click', function (e)
    {
        e.preventDefault();

        var obj_id          = $(this).attr('id');
        var loader          = "<img class='ajax_loader' src='/img/ajax_loading_peque.gif' alt='' />";

        $('#ajaxresponsebox').html('');
        $('.alert-info').hide();

        $('#'+obj_id).children('.ajax_loader').remove();
        $('#'+obj_id).append(loader);

        $.ajax({
            type: "POST",
            url:'logout',
            data: "",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (data) {
                
                $('#'+obj_id).children('.ajax_loader').remove();

                window.location.href = "/";
            },
            error: function (data) {
                $('#ajaxresponsebox').addClass('error').html(data.response);
            }
        });
    });

});









