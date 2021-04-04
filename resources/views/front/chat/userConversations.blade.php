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
                        @if(count($users))
                        @foreach($users as $user)
                        <li @if($user->id == $vendor->id) class="active" @endif>
                            <a href="{{route('chat.user.conversations', [$user->id])}}">
                                <div class="online_sdtu user-status-icon user-icon-{{$user->id}}" id="userStatusHead{{$user->id}}"></div>
                                <img width="55px" height="55px" src="{{$user->getFirstMediaUrlOrDefault(USER_PROFILE)['url']}}" alt="{{$user->getFirstMediaUrlOrDefault(USER_PROFILE)['alt']}}" title="{{$user->getFirstMediaUrlOrDefault(USER_PROFILE)['title']}}">
                                <div>
                                    <h2>{{$user->name}}</h2>
                                    <span class="time_send">
                                        <b>11:00 AM</b>
                                        <small>10</small>
                                    </span>
                                    <h3>
                                        <span class="status">
                                            <i class="fa fa-check color_seen" aria-hidden="true"></i>
                                        </span>
                                        Lorem ipsum, or lipsum as it is sometimes known
                                    </h3>
                                </div>
                            </a>
                        </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="main_chat">
                    <header>
                        <div class="online_sdtu_head user-status-icon user-icon-{{$vendor->id}}" id="userStatusHead{{$vendor->id}}"></div>
                        <img width="55px" height="55px" src="{{$vendor->getFirstMediaUrlOrDefault(USER_PROFILE)['url']}}" alt="{{$vendor->getFirstMediaUrlOrDefault(USER_PROFILE)['alt']}}" title="{{$vendor->getFirstMediaUrlOrDefault(USER_PROFILE)['title']}}">
                        <div>
                            <h2>{{$vendor->name}}</h2>
                            <h3>already 1902 messages</h3>
                        </div>
                    </header>
                    <ul id="chat">
                        <li class="you">
                            <div class="entete">
                                <span class="status status_peaple">
                                    <img width="30px" height="30px" src="{{$vendor->getFirstMediaUrlOrDefault(USER_PROFILE)['url']}}" alt="{{$vendor->getFirstMediaUrlOrDefault(USER_PROFILE)['alt']}}" title="{{$vendor->getFirstMediaUrlOrDefault(USER_PROFILE)['title']}}">
                                </span>
                                <h2 class="ml-3">{{$vendor->name}}</h2>
                                <h3 title="2020-05-06 10:12 AM">10:12AM, Today</h3>
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
                        <textarea placeholder="Type your message" class="chat-input"></textarea>
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

            let chatInput = $(".chat-input");
            let chatInputToolbar = $(".chat-input-toolbar");
            let chatBody = $(".chat-body");

            let user_id = "{{$auth_user->id}}";
            let ip_address = '127.0.0.1';
            let socket_port = '8005';
            let socket = io(ip_address + ':' + socket_port);
            let vendor = "{{ $vendor->id }}";


            socket.on('connect', function () {
                // alert('connect');
                socket.emit('user_connected', user_id);
            });

            socket.on('updateUserStatus', (data) => {
                let userStatusIcon = $('.user-status-icon');
                userStatusIcon.addClass('d-none');
                $.each(data, function (key, val) {
                    if(val !== null && val !== 0) {
                        let userIcon = $(".user-icon-"+key);
                        userIcon.removeClass('d-none');
                    }
                })
            });

            chatInput.keypress(function (e) {
                let message = $(this).val();
                if(e.which === 13 && !e.shiftKey) {
                    chatInput.val('');
                    sendMessage(message);
                    return false;
                }
            });

            function sendMessage(message) {
                let url = "{{ route('chat.send_message') }}";
                let form = $(this);
                let formData = new FormData();
                let token = "{{csrf_token()}}";

                formData.append('message', message);
                formData.append('_token', token);
                formData.append('receiver_id', vendor);

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    success: function (response) {
                        if (response.success) {
                            console.log(response.data);
                        }
                    }
                });
            }
        });
    </script>
@endpush
