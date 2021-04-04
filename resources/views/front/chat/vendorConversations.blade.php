@extends('front.layouts.master')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="aside_chat">
                    <header>
                        <input type="text" placeholder="search">
                    </header>
                    <ul>
                        <li>
                            <div class="online_sdtu"></div>
                            <img src="{{front_url()}}/assets/img/chat_avatar_01.jpg" alt="">
                            <div>
                                <h2>Prénom Nom</h2>
                                <span class="time_send">
							<b>11:00 AM</b>
							<small>10</small>
						  </span>
                                <h3>
                                    <span class="status"><i class="fa fa-check color_seen" aria-hidden="true"></i></span>
                                    Lorem ipsum, or lipsum as it is sometimes known
                                </h3>
                            </div>
                        </li>
                        <li>
                            <img src="{{front_url()}}/assets/img/chat_avatar_01.jpg" alt="">
                            <div>
                                <h2>Prénom Nom</h2>

                                <h3>
                                    <span class="status"><i class="fa fa-check color_seen" aria-hidden="true"></i></span>
                                    Lorem ipsum, or lipsum as it is sometimes known
                                </h3>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="main_chat">
                    <header>
                        <img src="{{front_url()}}/assets/img/chat_avatar_01.jpg" alt="">
                        <div>
                            <h2>Chat with Vincent Porter</h2>
                            <h3>already 1902 messages</h3>
                        </div>
                    </header>
                    <ul id="chat">
                        <li class="you">
                            <div class="entete">
                                <span class="status status_peaple"><img src="{{front_url()}}/assets/img/chat_avatar_01.jpg" alt=""></span>
                                <h2 class="ml-3">Vincent</h2>
                                <h3>10:12AM, Today</h3>
                            </div>
                            <div class="triangle"></div>
                            <div class="message">
                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                            </div>
                        </li>
                        <li class="me">
                            <div class="entete">
                                <h3>10:12AM, Today</h3>
                                <h2>Vincent</h2>
                                <span class="status status_peaple"><img src="{{front_url()}}/assets/img/chat_avatar_01.jpg" alt=""></span>
                            </div>
                            <div class="triangle"></div>
                            <div class="message">
                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                            </div>
                        </li>
                    </ul>
                    <footer>
                        <textarea placeholder="Type your message"></textarea>
                        <a href="#">Send</a>
                    </footer>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('chat')
    <script>
        $(function () {
            let user_id = "{{$auth_user->id}}";
            let ip_address = '127.0.0.1';
            let socket_port = '8005';
            let socket = io(ip_address + ':' + socket_port);

            socket.on('connect', function () {
                alert('connect');
                socket.emit('user_connected', user_id);
            });

            socket.on('updateUserStatus', (data) => {
                let userStatusIcon = $('.user-status-icon');
                userStatusIcon.removeClass('text-success');
                userStatusIcon.attr('title', 'Away');
                // console.log(data);

                $.each(data, function (key, val) {
                    if(val !== null && val !== 0) {
                        // console.log(key);
                        let userIcon = $(".user-icon-"+key);
                        userIcon.addClass('text-success');
                        userIcon.attr('title', 'online');
                    }
                })
            });


        });
    </script>
@endpush
