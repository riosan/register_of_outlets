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
                window.location = location.origin + '/users';
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
                "field": arr[1]
            };

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                url: "users",
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

function showSelect() {
   if ($('#login').val() != ''){
       $('#spanSelect').removeClass('hidden').addClass('input-group-addon');
       $('#select').removeClass('hidden').addClass('form-control');
   } else {
       $('#spanSelect').addClass('hidden');
       $('#select').addClass('hidden');
   }

}

function keyEnter() {

    document.addEventListener("keypress", function onEvent(event) {
        if (event.key === "Enter") {
            insertData();
        }
    });
}


function insertData() {
    if ($('#ipv4').val() != '' && $('#login').val() != '') {

        var request = {
            "ip": $('#ipv4').val(),
            "login": $('#login').val(),
            "enable":$('#select').val()
        };

        $.ajax({
            url: 'users',
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

    $.ajax({
        url: 'users',
        type: 'POST',
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        data:{'delete':JSON.stringify($('input:checkbox:checked').map(function(){return this.value;}).get())},
        success: function(data){
            if (data === '1') {
                window.location.reload();
            }
        },
        dataType: "html"
    });
}

