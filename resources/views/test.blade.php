@extends('master')

@section('content')
    <p id="power">0</p>
@stop

@section('footer')

    <script src="{{ asset('js/socket.io.js') }}"></script>

    <script>
    var socket = io('http://localhost:6379');
    socket.on("test-channel:App\\Events\\MyEventNameHere", function(message){
         $('#power').text(parseInt($('#power').text()) + parseInt(message.data.power));
     });
    </script>


@stop
