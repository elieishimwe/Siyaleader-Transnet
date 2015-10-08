<!-- Chat -->
<div class="chat">

    <!-- Chat List -->
    <div class="pull-left chat-list">
        <div class="listview narrow">
            <div class="media">
                <img class="pull-left" src="img/profile-pics/1.jpg" width="30" alt="">
                <div class="media-body p-t-5">
                    Alex Bendit
                </div>
            </div>
            <div class="media">
                <img class="pull-left" src="img/profile-pics/2.jpg" width="30" alt="">
                <div class="media-body">
                    <span class="t-overflow p-t-5">David Volla Watkinson</span>
                </div>
            </div>
            <div class="media">
                <img class="pull-left" src="img/profile-pics/3.jpg" width="30" alt="">
                <div class="media-body">
                    <span class="t-overflow p-t-5">Mitchell Christein</span>
                </div>
            </div>
            <div class="media">
                <img class="pull-left" src="img/profile-pics/4.jpg" width="30" alt="">
                <div class="media-body">
                    <span class="t-overflow p-t-5">Wayne Parnell</span>
                </div>
            </div>
            <div class="media">
                <img class="pull-left" src="img/profile-pics/5.jpg" width="30" alt="">
                <div class="media-body">
                    <span class="t-overflow p-t-5">Melina April</span>
                </div>
            </div>
            <div class="media">
                <img class="pull-left" src="img/profile-pics/6.jpg" width="30" alt="">
                <div class="media-body">
                    <span class="t-overflow p-t-5">Ford Harnson</span>
                </div>
            </div>

            <div class="media">
                <img class="pull-left" src="img/profile-pics/4.jpg" width="30" alt="">
                <div class="media-body">
                    <span class="t-overflow p-t-5">Wayne Parnell</span>
                </div>
            </div>
            <div class="media">
                <img class="pull-left" src="img/profile-pics/5.jpg" width="30" alt="">
                <div class="media-body">
                    <span class="t-overflow p-t-5">Melina April</span>
                </div>
            </div>
            <div class="media">
                <img class="pull-left" src="img/profile-pics/6.jpg" width="30" alt="">
                <div class="media-body">
                    <span class="t-overflow p-t-5">Ford Harnson</span>
                </div>
            </div>

        </div>
    </div>

    <!-- Chat Area -->
    <div class="media-body">
        <div class="chat-header">
            <a class="btn btn-sm" href="">
                <i class="fa fa-circle-o status m-r-5"></i> Chat with Colleagues
            </a>
        </div>

        <div class="chat-body" id="chat-body">


        </div>

        <div class="chat-footer media">
            <i class="chat-list-toggle pull-left fa fa-bars"></i>
            {!! Form::open(['url' => 'chat', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"chatForm" ]) !!}
            <a type="#" id='submitChat'><i class="pull-right fa fa-picture-o"></i></a>
            <div class="media-body">
                    <textarea class="form-control" name="message" id="message" placeholder="Type something..." onkeydown="pressed(event)"></textarea>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
