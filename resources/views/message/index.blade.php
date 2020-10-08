@extends('layouts.app')
@section('content')
<section  class="mbox">
    <div class="tab-content">
                    @foreach($sentMessages as $message){
                    <div class="container send btn btn-primary" type="button" data-toggle="collapse" data-target="#mess{{$message->id}}">
                    {{$message->message}}<strong><i class='fa fa-user-circle'>$sender</i></strong>
                    <br><span class="time-right">{{$message->created_at}}</span>
                        </div>
                        <div id="mess{{$message->id}}" class="collapse" style="float:right; margin: 10px 0;">
                        <button class="btn btn-warning btn-sm" data-toggle="collapse" data-target="#edit{{$message->id}}">Edit</button>

                        <form action="#" method="POST" id="edit{{$message->id}}" class="collapse">
                            <input type="hidden" name="idSender" value="{{$message->id}}" />
                            <input type="hidden" name="idReceiver" value="{{$message->id}}" />
                            <input type="hidden" name="nameReceiver" value="{{$message->id}}" />
                            <input type="hidden" name="idEdit" value="{{$message->id}}" />
                            <textarea rows="3" id="messageEdit" name="messageEdit" style="width: 100%;"></textarea><br>
                            <button type="submit" class="btn btn-primary btn-sm" style="margin-top: 1%; margin-bottom: 1%;">Submit</button>
                        </form>
                        <a style="color: white;" href="#">
                        <button onclick="return  confirm('Do you want to delete this message?')" class="btn btn-danger btn-sm">Delete</button>
                        </a>
                        </div>
                        <br>
                    @endforeach

                    {{-- @if ($idReceiver == $row['idSender'])
                        <div class="container receive">
                        <strong><i class='fa fa-user-circle'>$receiver</i></strong>:" . " " .$row['message'];
                        <br><span class="time-left">' . $row['created'] .'</span>
                        </div>
                        <br>
                @endif --}}
                   <div class="container box-message">


                    {{-- <form action="#" method="POST">
                        <input type="hidden" name="idSender" style="margin-top: 1%; margin-bottom: 1%;" value="{{$message->id}}" />
                        <input type="hidden" name="idReceiver" style="margin-top: 1%; margin-bottom: 1%;" value="{{$message->id}}" />
                        <textarea rows="3" id="message" name="message" style="width: 100%;"></textarea><br>
                        <button type="submit" class="btn btn-primary" name="btnSubmit" style="margin-top: 1%; margin-bottom: 1%;">Send</button>
                    </form> --}}
                    </div>
        </div>
    </section>
    @endsection
