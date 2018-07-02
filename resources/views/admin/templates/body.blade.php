<div class="container">
    <table id="users" class="table table-striped table-bordered table-hover table-condensed" border="2" width="50%">
        <th>№</th> <th>Ip</th> <th>Login</th>  <th>Last modif date</th> <th>Enable</th> <th>Switch</th>
        <?php $i = 1;  ?>
        @foreach($files_list as $num => $value)
            <tr>
                <td>{{$i++}}</td>
                <td class="edit ip {{$value['id']}}">{{$value['ip']}}</td>
                <td class="edit login {{$value['id']}}">{{$value['login']}}</td>
                <td>{{$value['date']}}</td>
                <td class="edit enable {{$value['id']}}">{{$value['enable']}}</td>
                <td> <input type="checkbox" value="{{$value['id']}}"> </td>
            </tr>

        @endforeach

    </table>

</div>