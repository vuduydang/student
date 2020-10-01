<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>

<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
    <title>Chat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/boxchat.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://js.pusher.com/4.3/pusher.min.js"></script>
</head>
<!--Coded With Love By Mutiullah Samim-->
<body>
<div class="container-fluid h-100">
    <div class="row message-wrapper justify-content-center h-100">
        <div class="col-md-4 col-xl-3 chat">
            <div class="card mb-sm-3 mb-md-0 contacts_card">
                <div class="card-header">
                    <div class="input-group">
                        <input type="text" placeholder="Search..." name="" class="form-control search">
                        <div class="input-group-prepend">
                            <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                </div>
                <div class="card-body scrollbar contacts_body">
                    <ul class="contacts messages">
                        <li class="active">
                            <div class="d-flex bd-highlight">
                                <div class="img_cont">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcR-1YtFqTGuv2CN70a4sCnQJG-ZRuBfUE4D0Q&usqp=CAU" class="rounded-circle user_img">
                                    <span class="online_icon"></span>
                                </div>
                                <div class="user_info">
                                    <span>Khalid</span>
                                    <p>Kalid is online</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
        <div class="col-md-8 col-xl-6 chat">
            <div class="card">
                <div class="card-header msg_head">
                    <div class="d-flex bd-highlight">
                        <div class="img_cont">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcR-1YtFqTGuv2CN70a4sCnQJG-ZRuBfUE4D0Q&usqp=CAU" class="rounded-circle user_img">
                            <span class="online_icon"></span>
                        </div>
                        <div class="user_info">
                            <span>Chat with Khalid</span>
                            <p>1767 Messages</p>
                        </div>
                        <div class="video_cam">
                            <span><i class="fas fa-video"></i></span>
                            <span><i class="fas fa-phone"></i></span>
                        </div>
                    </div>
                    <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
                    <div class="action_menu">
                        <ul>
                            <li><i class="fas fa-user-circle"></i> View profile</li>
                            <li><i class="fas fa-users"></i> Add to close friends</li>
                            <li><i class="fas fa-plus"></i> Add to group</li>
                            <li><i class="fas fa-ban"></i> Block</li>
                        </ul>
                    </div>
                </div>
                <div class="card-body detail-message scrollbar msg_card_body">
                    <!-- message -->
                </div>
                <div class="card-footer">
                    {{Form::open(['method'=>'post','id'=>'formChat'])}}
                        {{Form::hidden('student','2197',['class'=>'student'])}}
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                            </div>
                            {{Form::textarea('message','',['class'=>'form-control type_msg','placeholder'=>'Type your message...'])}}
                            <div class="input-group-append">
                                <button class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></button>
                            </div>
                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/boxchat.js')}}" student="{!! Auth::id() !!}"></script>
</body>
</html>
