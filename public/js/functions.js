

function buttonUp() {

    $(document).ready(function(){
        $('body').append('<a href="#" id="go-top" title="Вверх">Вверх</a>');
    });

    $(function() {
        $.fn.scrollToTop = function() {
            $(this).hide().removeAttr("href");
            if ($(window).scrollTop() >= "250") $(this).fadeIn("slow")
            var scrollDiv = $(this);
            $(window).scroll(function() {
                if ($(window).scrollTop() <= "250") $(scrollDiv).fadeOut("slow")
                else $(scrollDiv).fadeIn("slow")
            });
            $(this).click(function() {
                $("html, body").animate({scrollTop: 0}, "slow")
            })
        }
    });

    $(function() {
        $("#go-top").scrollToTop();
    });

}

function reloadPage() {
   setTimeout(function() {window.location.reload();}, 3600000);

}

function getDate() {
    $('#toTop').text(new Date());
}

function chart(array) {
    var ar_chart = JSON.parse(array);
    // Load the Visualization API and the corechart package.

    google.charts.load('current', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {
        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows(Object.entries(ar_chart));

        // Set chart options
        var options = {'title':'Percentage of file size',
            'width':500,
            'height':200};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
}




function chartDonut(array){
    var ar_chart = JSON.parse(array);

    var add = Object.entries(ar_chart);

    add.unshift(["Hello","MyFriend"]);

    google.charts.load("current", {packages:["corechart"]});

    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable(add);

        var options = {
            title: 'Percentage of file size',
            pieHole: 0.3,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
    }

}

    function setMenu() {

        var div = $('.accordion>ul>li');
        div.click(function(){
            div.not($(this).toggleClass('active')).removeClass('active')
        });

    }

    function delClass() {

        var div = $('.accordion>ul>li');
        div.toggleClass('active').removeClass('active')

    }
    
    function addMail() {

        delClass();

        var cb = $('.cbMail');
        var mail = $('.eMail');
        var save = $('.sendMail');
        var del = $('.delMail');




        if($(cb).is(":checked")) {
            mail.show();
            save.show();
            del.show();
        } else {
            mail.hide();
            save.hide();
            del.hide();
        }
    }


    function loadMail(email){
        var mail = $('.eMail');
        mail.val(email);
    }

    function saveMail(select,text)
    {

        var request = [
            select,
            text
        ];

        $.ajax({
            url: 'mail',
            type: 'POST',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data:{'save':JSON.stringify(request)},
            success: function(data){
                $('.response_status').html(data);
            },
            dataType: "html"
        });
    }

function delMail(select,text)
{

    var request = [
        select,
        text
    ];

    $.ajax({
        url: 'mail',
        type: 'POST',
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        data:{'delete':JSON.stringify(request)},
        success: function(data){
            $('.response_status').html(data);
        },
        dataType: "html"
    });
}

    function setMail() {
        var mail = $('.eMail');
        saveMail(1,mail.val());
    }

    function unsetMail() {

        var mail = $('.eMail');
        delMail(1,mail.val(),"delete");
        mail.val('');
    }


    function getLog() {
        delClass();
        var area = $('.viewLog');
        var cb = $('.checkLog');

        if($(cb).is(":checked")) {
            area.show();
            interval = CicleTimeOut();
        } else {
            area.hide();
            clearInterval(interval);
        }

    }



    function CicleTimeOut() {
        $(document).ready(function(){
            getLogTransport();
           interval = setInterval('getLogTransport()', 5000);
        });

    }





    function getLogTransport() {

        $.ajax({
            url: 'log',
            cache: false,
            type: 'POST',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data:{'checked':JSON.stringify('GiveMeLog-)')},
            success: function(data){
                $('.viewLog').val(data);
            },
            dataType: "html"
        });
    }

    



function hideMenu(sign) {
    if(sign == false){
       $('.accordion').hide();
    }
}

function hideTable() {

     var select = $('.Select').val();
   var all =  $('.container>table>tbody>tr').not(':first');
   var point = $('.container>table>tbody>tr.'+select);
   var pointn = $('.container>table>tbody>tr').not(':first').not( '.'+select);
   var inPoint = $('.container>table>tbody>tr[id=1]');
   var outPoint = $('.container>table>tbody>tr[id=0]');
   var autoExhange = $('.container>table>tbody>tr[name=old]');
  // var notInternet = $('.container>table>tbody>tr>td[name=offline]').parents('tr');
    var notInternet = $('.container>table>tbody>tr>td[id=blink]').parents('tr');



    switch (select) {
        case 'Точки ⇒ Центральный':
            inPoint.hide();
            outPoint.show();
            break;
        case 'Центральный ⇒ Точки':
            outPoint.hide();
            inPoint.show();
            break;
        case 'Нет интернета':
            all.hide();
            notInternet.show();
            break;
        case 'Нет автообмена':
            all.hide();
            autoExhange.show();
            break;
        case 'allPoint':
            all.show();
            break;
        default:
            if(point.is(":hidden")) {
                point.show();
            } else {pointn.hide();}

    }

}





