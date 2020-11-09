{{-- @extends('layouts.master')
@section('content')
<section class="mbox">
    <div class="tab-content">
        @foreach($messages as $message)
        @if ($sender->id == $message->sender_id)
        <div class="container send btn btn-primary" type="button" data-toggle="collapse" data-target="#mess{{$message->id}}">
            {{$message->message}}
            <strong> :{{$sender->fullname}}<i class='fa fa-user-circle'></i></strong>
            <br>
            <span class="time-right">{{$message->updated_at}}</span>
        </div>
        <div id="mess{{$message->id}}" class="collapse" style="float:right;">
            <button style="color: white;" class="btn btn-warning btn-sm" data-toggle="collapse" data-target="#edit{{$message->id}}">Edit</button>

            <form action="/messagebox/update/{{$message->id}}" method="POST" id="edit{{$message->id}}" class="collapse position-absolute">
                @csrf
                <input type="hidden" name="sender_id" value="{{$sender->id}}" />
                <input type="hidden" name="receiver_id" value="{{$receiver->id}}" />
                <textarea rows="3" id="message" name="message" style="width: 100%;"></textarea><br>
                <button type="submit" class="btn btn-primary btn-sm" style="margin-top: 1%; margin-bottom: 1%;">Submit</button>
            </form>
            <a href="/messagebox/delete/{{$message->id}}" method="post">
                <button onclick="return confirm('Do you want to delete this message?')" class="btn btn-danger btn-sm">
                  Delete
                </button>
            </a>
        </div>
        <br>
        @endif

        @if ($receiver->id == $message->sender_id)
            <div class="container receive">
            <strong><i class='fa fa-user-circle'>{{$receiver->fullname}}</i></strong>: {{$message->message}}
            <br>
            <span class="time-left">{{$message->updated_at}}</span>
            </div>
            <br>
        @endif
        @endforeach
        <div class="container box-message">
        <form action="/messagebox/send" method="POST">
            @csrf
            <input type="hidden" name="sender_id" id="sender_id" style="margin-top: 1%; margin-bottom: 1%;" value="{{$sender->id}}" />
            <input type="hidden" name="receiver_id" id="receiver_id" style="margin-top: 1%; margin-bottom: 1%;" value="{{$receiver->id}}" />
            <textarea rows="3" id="message" name="message" style="width: 100%;" autofocus></textarea><br>
            <button type="submit" class="btn btn-primary" style="margin-top: 1%; margin-bottom: 1%;">Send</button>
        </form>
        </div>
        <a href="/messagebox/delete/1">
            <button class="btn btn-sm btn-warning">
                Delete
              </button>
        </a>
    </div>
</section>
@endsection --}}
