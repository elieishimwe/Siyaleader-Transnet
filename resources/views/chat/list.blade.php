<!-- Chat -->
<div class="chat">

    <!-- Chat List -->
    <div class="pull-left chat-list">
        <div class="listview narrow" style="overflow-y:auto; height:320px">

            @foreach ( $loggedInUsers as $loggedInUser)
                <div class="media">
                    <a href="#" class="chatWith" data-userid = "{{ $loggedInUser->id }}" data-names = "{{ $loggedInUser->name}} {{ $loggedInUser->surname}}"> <img class="pull-left" src="img/profile-pics/7.png" width="30" alt=""></a>
                    <div class="media-body">
                        <span class="t-overflow p-t-5">{{ $loggedInUser->name }} {{ $loggedInUser->surname }}</span>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <!-- Chat Area -->
    <div class="media-body">
        <div class="chat-header">
            <a class="btn btn-sm" href="">
                <i class="fa fa-circle-o status m-r-5"></i> Chat with <label id="colleague">Colleagues<label>
            </a>
        </div>

        <div class="chat-body" id="chat-body">


        </div>

        <div class="chat-footer media">
            <i class="chat-list-toggle pull-left fa fa-bars"></i>
            {!! Form::open(['url' => 'chat', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"chatForm" ]) !!}
            {!! Form::hidden('to',0,['id' => 'to']) !!}
            <a type="#" id='submitChat'><i class="pull-right fa fa-picture-o"></i></a>
            <div class="media-body">
                    <textarea class="form-control" name="messageChat" id="messageChat" placeholder="Type something..." onkeydown="pressed(event)"></textarea>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
