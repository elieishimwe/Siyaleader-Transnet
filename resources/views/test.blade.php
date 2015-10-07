@extends('master')

@section('content')
    <p id="power">0</p>
@stop

@section('footer')

    <script src="{{ asset('js/socket.io.js') }}"></script>

    <script>
    var socket = io('http://127.0.0.1:6379');
    socket.on("test-channel:App\\Events\\MyEventNameHere", function(message){
        alert(elie);
        alert(message);
        $('#power').text(parseInt($('#power').text()) + parseInt(message.data.power));
     });
    </script>


@stop
