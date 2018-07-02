<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="MobileOptimized" content="width">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/accordeon.css">
    <title>Статистика автообмена точек</title>
    </head>
    <div id = "text-block" > </div >
    <body>

    <div class="admin">
        <a href="http://{{$_SERVER['SERVER_ADDR']}}/admin" target="_blank" >Admin Panel</a>
    </div>

    <div class="accordion">
    <ul>
        <li>
            <h3>Options</h3>


           <table class="limiter">

            <tr>
                <td class="cell">
                    <input class="cbMail" id="sw" type="checkbox" onclick="addMail()">
                    <label for="sw">Send email</label>
                    <input class="eMail" type="email" hidden onclick="delClass()" placeholder="Enter your email address" autofocus >
                    <input  class="sendMail" type="button" name="save" hidden onclick="setMail()" value="save"  >
                    <input  class="delMail" type="button" name="del" hidden onclick="unsetMail()" value="del"  >
                </td>

                <td class="tdViewLog" rowspan="2">
                        <textarea class="viewLog" hidden onclick="delClass()"></textarea>
                </td>

            </tr>

              <tr>
                  <td class="cell">
                    <input id="log" class="checkLog" type="checkbox" onclick="getLog()">
                    <label for="log">Show logs</label>
                </td>
            </tr>
            </table>
        </li>
    </ul>
</div>

<div class="List">
    <select class="Select" onchange="hideTable()">
        <option value="allPoint">Все точки</option>
        <option value="Центральный ⇒ Точки">Центральный ⇒ Точки</option>
        <option value="Точки ⇒ Центральный">Точки ⇒ Центральный</option>
        <option value="Нет автообмена">Нет автообмена < {{$hours_limit}} часов</option>
        <option value="Нет интернета">Нет интернета</option>
        {{asort($points_list)}}
        @foreach($points_list as $value)
            <option value="{{$value}}">{{$value}}</option>
        @endforeach
    </select>

</div>


<div class="container">
    <table class="table table-striped table-bordered table-hover table-condensed" border="2" width="50%">
        <th>№</th> <th>FileName</th>  <th>Last modif date</th> <th>FileSize</th> <th>Internet</th>

        <?php $i = 1; $ar_chart = []; ?>
            @foreach($files_list as $value)
                <tr class="{{$value['file']}}" id="{{$value['attr']}}" {{($value['diff'] >= $hours_limit) ? 'name=old' : ''}}>
                    <td>{{$i++}}</td>

                    <td align="left">{{$value['file']}}
                        <?php if ($value['diff'] >= $hours_limit): ?>
                    <td class="blink" bgcolor="#c5d8e5">
                        <?php else: ?>
                    <td>
                    <?php endif; ?>
                        {{$value['lastdate']}}
                    </td>

                    <td> {{$value['fsize']}}</td>

                    <?php if (($value['status_point'] === $value['status']['offline']) || ($value['status_point'] === $value['status']['undefined']) ): ?>
                    <td  align="center" class="blink" {{--bgcolor="#c5d8e5"--}} id="blink" {{--name="{{$value['status']['offline']}}"--}}>  <img src="../image/Stop.png">
                    <?php else: ?>
                    <td align="center"> <img src="../image/Select.png">
                    <?php endif; ?>
                    {{--{{$value['status_point']}}--}}

                    </td>

                 </tr>

                <?php $ar_chart[$value['file']] = substr($value['fsize'], 0,-3); ?>

            @endforeach

    </table>


</div>
    <script type="text/javascript" src="../js/functions.js"></script>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <div class="response_status" align="center"></div>


<script type="text/javascript">
    setMenu();
   /* getDate();*/
    buttonUp();
    hideMenu('{{$mac}}');
    loadMail('{{isset($email[0]['address']) ? $email[0]['address'] : '' }}');
   /* flashing();*/

</script>

</body>
</html>



