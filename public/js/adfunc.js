function check() {
    if ($('input#login').val() != '' && $('input#password').val() != '') {

        $('#button').removeAttr('disabled');

        document.addEventListener("keypress", function onEvent(event) {
            if (event.key === "Enter") {
                sendData();
            }
        });
    }

    else
        $('#button').attr('disabled', 'disable');
}


function sendData() {
    var request = {
        "user": $('input#login').val(),
        "pass": $('input#password').val()
    };

    clearUserData();

    $.ajax({
        url: 'admin',
        type: 'POST',
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        data: {'data': JSON.stringify(request)},
        success: function (data) {
            if (data === '1') {
                window.location = location.origin + '/mail';
            }
        },
        dataType: "html"
    });


}

function Logout() {
    var request = {
        "logout": true
    };

    $.ajax({
        url: 'logout',
        type: 'POST',
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        data: {'data': JSON.stringify(request)},
        success: function (data) {
            if (data === '1') {
               /* window.location = location.origin + '/users';*/
            }
        },
        dataType: "html"
    });


}

function clearUserData() {
    $('input#login').val('');
    $('input#password').val('');
}







function editUserData() {
    $('td.edit').click(function () {

        $('.ajax').html($('.ajax input').val());

        $('.ajax').removeClass('ajax');

        $(this).addClass('ajax');
        $(this).html('<input id="editbox" size="' + $(this).text().length + '" type="text" value="' + $(this).text() + '" />');
        $('#editbox').focus();
    });

    $('td.edit').keydown(function (event) {

        if (event.which == 13) {

            arr = $(this).attr('class').split(" ");

            var request = {
                "value": $('.ajax input').val(),
                "id": arr[2],
                "field": arr[1],
                "table": window.location.pathname.slice(1)
            };


            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                url: window.location.pathname,
                data: {'change': JSON.stringify(request)},
                success: function (data) {
                    $('.ajax').html($('.ajax input').val());
                    $('.ajax').removeClass('ajax');

                    if (data === '1') {
                        window.location.reload();
                    }
                }
            });
        }
    });


    $(document).on('blur', '#editbox', function () {
        $('.ajax').html($('.ajax input').val());
        $('.ajax').removeClass('ajax');
    });


}

function checkIp() {

    var pattern = "^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$";
    var str = $('#ipv4').val();
    var ip = new RegExp(pattern);
    var result = ip.test(str);

    if (result) {
        showLogin(true);
    } else {
        showLogin(false);
    }

}

function showLogin(value) {
    if(value) {
        $('#span').removeClass('hidden').addClass('input-group-addon');
        $('#login').removeClass('hidden').addClass('form-control');
    } else {
        $('#span').addClass('hidden');
        $('#login').addClass('hidden');

    }

}

function showLoginRoot() {
    if($('#login').val() != '') {
        $('#passw').removeClass('hidden').addClass('input-group-addon');
        $('#pass').removeClass('hidden').addClass('form-control');
    } else {
        $('#passw').addClass('hidden');
        $('#pass').addClass('hidden');
    }
}

function showSelect() {
    if ($('#login').val() != '' ){
        $('#spanSelect').removeClass('hidden').addClass('input-group-addon');
        $('#select').removeClass('hidden').addClass('form-control');
    } else {
        $('#spanSelect').addClass('hidden');
        $('#select').addClass('hidden');
    }
}

function showSelectRoot() {
    if ($('#pass').val() != '' ){
        $('#spanSelect').removeClass('hidden').addClass('input-group-addon');
        $('#select').removeClass('hidden').addClass('form-control');
    } else {
        $('#spanSelect').addClass('hidden');
        $('#select').addClass('hidden');
    }
}

function checkIpPoint() {

    var pattern = "^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$";
    var str = $('#ipv4').val();
    var ip = new RegExp(pattern);
    var result = ip.test(str);

    if (result) {
        showShortNamePoint(true);
    } else {
        showShortNamePoint(false);
    }

}

function showShortNamePoint(value) {
    if(value) {
        $('#short_names').removeClass('hidden').addClass('input-group-addon');
        $('#short_name').removeClass('hidden').addClass('form-control');
    } else {
        $('#short_names').addClass('hidden');
        $('#short_name').addClass('hidden');

    }

}

function showSelectPoint() {
    if ($('#short_name').val() != '' ){
        $('#logins').removeClass('hidden').addClass('input-group-addon');
        $('#login').removeClass('hidden').addClass('form-control');
    } else {
        $('#logins').addClass('hidden');
        $('#login').addClass('hidden');
    }
}






function keyEnter() {

    document.addEventListener("keypress", function onEvent(event) {
        if (event.key === "Enter") {
            insertData();
        }
    });
}

function keyEnterRoot() {

    document.addEventListener("keypress", function onEvent(event) {
        if (event.key === "Enter") {
            insertDataRoot();
        }
    });
}


function insertData() {
    if ($('#ipv4').val() != '' && $('#login').val() != '') {

        var request = {
            "ip": $('#ipv4').val(),
            "login": $('#login').val(),
            "enable":$('#select').val(),
            "table":window.location.pathname.slice(1)
        };

        if(window.location.pathname.slice(1) == 'point') {
            request.short_name = $('#short_name').val();
        }
        if(window.location.pathname.slice(1) == 'root') {
            request.pass = $('#pass').val();
        }

        $.ajax({
            url: window.location.pathname,
            type: 'POST',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: {'data': JSON.stringify(request)},
            success: function (data) {
                if (data === '1') {
                    window.location.reload();
                }

            },
            dataType: "html"
        });

    }
}


function insertDataRoot() {
    if ($('#login').val() != '' && $('#pass').val() != '') {

        var request = {
            "login": $('#login').val(),
            "pass": $('#pass').val(),
            "enable":$('#select').val(),
            "table":window.location.pathname.slice(1)
        };

        $.ajax({
            url: window.location.pathname,
            type: 'POST',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: {'data': JSON.stringify(request)},
            success: function (data) {
                if (data === '1') {
                    window.location.reload();
                }

            },
            dataType: "html"
        });

    }
}

function getCheckBoxValue()
{

    var request = {
        "checked": $('input:checkbox:checked').map(function(){return this.value;}).get(),
        "table":window.location.pathname.slice(1)
    };

    $.ajax({
        url: window.location.pathname,
        type: 'POST',
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        data:{'delete':JSON.stringify(request)},
        success: function(data){
            if (data === '1') {
                window.location.reload();
            }
        },
        dataType: "html"
    });
}

