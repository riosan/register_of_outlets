<!doctype html>
<html lang="en">


<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="MobileOptimized" content="width">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Администраторы</title>
</head>

<body>

<div class="container">
    <table id="users" class="table table-striped table-bordered table-hover table-condensed" border="2" width="50%">
        <th>№</th> <th>Login</th> <th>Password</th>  <th>Last modif date</th> <th>Enable</th> <th>Switch</th>
        <?php $i = 1;  ?>
        @foreach($files_list as $num => $value)
            <tr>
                <td>{{$i++}}</td>
                <td class="edit login {{$value['id']}}">{{$value['login']}}</td>
                <td class="edit pass {{$value['id']}}">{{$value['pass']}}</td>
                <td>{{$value['date']}}</td>
                <td class="edit enable {{$value['id']}}">{{$value['enable']}}</td>
                <td> <input type="checkbox" value="{{$value['id']}}"> </td>
            </tr>

        @endforeach

    </table>

</div>

@include('admin.templates.menu')

<div class="modal fade" id="basicModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><button class="close" type="button" data-dismiss="modal">x</button>
                <h4 class="modal-title" id="myModalLabel">Adding a record</h4>
            </div>
            <div class="modal-body">
                <h4>
                    <table class="table table-striped table-bordered table-hover table-condensed" border="2" width="50%">
                        <div class="input-group" >

                            <tr>
                                <td>
                                    <span class="input-group-addon"  id="span">Login</span>
                                    <input type="text" id="login" class="form-control" placeholder="Enter login" aria-describedby="login" onkeypress="keyEnterRoot()" onkeyup="showLoginRoot()" autofocus>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <span class="input-group-addon hidden" id="passw">Password</span>
                                    <input type="password" id="pass" class="form-control hidden" placeholder="Enter password" aria-describedby="pass"  onkeyup="showSelectRoot()"  onkeypress="keyEnterRoot()" >
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <span class="input-group-addon hidden"  id="spanSelect">Enable</span>
                                    <select name="select" class="form-control hidden" id="select" size="1" hidden>
                                        <option selected value="1">1</option>
                                        <option value="0">0</option>
                                    </select>
                                </td>
                            </tr>
                        </div>
                    </table>
                </h4>
            </div>
            <div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="button" data-dismiss="modal" onclick="insertData()">Save</button></div>
        </div>
    </div>
</div>


<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/adfunc.js"></script>
<div class="response_status" align="center"></div>

<script>
    editUserData();

</script>


</body>
</html>




