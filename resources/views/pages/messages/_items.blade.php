

<div class="messages">
    @if(!$message->isEmpty())
        @foreach($message as $msg)

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                <span>
                    {!! $msg->id !!}
                    @unless(empty($msg->email))
                        <a href="mailto:{{$msg->email}}">{{$msg->name}}</a>
                    @else
                        {!! $msg->name !!}
                    @endunless

                </span>
                <span class="pull-right label label-info">
                    {{--17:15:00 / 03.07.2016--}}
                    {{$msg->created_at}}
                </span>
            </h3>
        </div>
        <div class="panel-body">
            {!! $msg->message !!}
            <hr/>
            <div class="pull-right">
                <a class="btn btn-info" href="#">
                    <i class="glyphicon glyphicon-pencil"></i>
                </a>
                <button class="btn btn-danger">
                    <i class="glyphicon glyphicon-trash"></i>
                </button>
            </div>
        </div>
    </div>
        @endforeach
        <div class="text-center">
            {!! $message->render() !!}
        </div>
    @endif
</div>

