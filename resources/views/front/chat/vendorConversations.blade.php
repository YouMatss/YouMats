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
                            @foreach($users as $loop_user)
                                <li @if($loop_user->id == $user->id) class="active" @endif>
                                    <a href="{{route('chat.user.conversations', [$loop_user->id])}}">
                                        <div class="online_sdtu user-status-icon user-icon-user_{{$loop_user->id}}" id="userStatusHead{{$loop_user->id}}"></div>
                                        <img width="55px" height="55px" src="{{$loop_user->getFirstMediaUrlOrDefault(USER_PROFILE)['url']}}" alt="{{$loop_user->getFirstMediaUrlOrDefault(USER_PROFILE)['alt']}}" title="{{$loop_user->getFirstMediaUrlOrDefault(USER_PROFILE)['title']}}">
                                        <div>
                                            <h2>{{$loop_user->name}}</h2>
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
                        <div class="online_sdtu_head user-status-icon user-icon-user_{{$user->id}}" id="userStatusHead{{$user->id}}"></div>
                        <img width="55px" height="55px" src="{{$user->getFirstMediaUrlOrDefault(USER_PROFILE)['url']}}" alt="{{$user->getFirstMediaUrlOrDefault(USER_PROFILE)['alt']}}" title="{{$user->getFirstMediaUrlOrDefault(USER_PROFILE)['title']}}">
                        <div>
                            <h2>{{$user->name}}</h2>
                        </div>
                    </header>
                    <ul id="chat"></ul>
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
            let chatContainer = $("#chat");

            let user_id = "vendor_{{$auth_vendor->id}}";
            let ip_address = '127.0.0.1';
            let socket_port = '8005';
            let socket = io(ip_address + ':' + socket_port);
            let receiver_id = "{{ $user->id }}";

            socket.on('connect', function () {
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
                formData.append('receiver_id', receiver_id);
                formData.append('sender_type', 'user');
                formData.append('receiver_type', 'vendor');

                appendMessageToSender(message);

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

            function appendMessageToSender(message) {
                let name = '{{ $auth_vendor->name }}';
                let image = '{!! $auth_vendor->getFirstMediaUrlOrDefault(VENDOR_LOGO)['url'] !!}';
                let newMessage =
                    `<li class="me">
                            <div class="entete">
                                <h3 title="`+ getCurrentDateTime() +`">` + getCurrentTime() + `</h3>
                                <h2>` + name + `</h2>
                                <span class="status status_peaple">
                                    <img src="` + image + `">
                                </span>
                            </div>
                            <div class="triangle"></div>
                            <div class="message">` + message + `</div>
                        </li>`;
                chatContainer.append(newMessage);
            }
            function appendMessageToReceiver(message) {
                let name = '{{ $user->name }}';
                let image = '{!! $user->getFirstMediaUrlOrDefault(USER_PROFILE)['url'] !!}';
                let newMessage =
                    `<li class="you">
                        <div class="entete">
                            <span class="status status_peaple">
                                <img width="30px" height="30px" src="` + image + `">
                            </span>
                            <h2 class="ml-3">` + name + `</h2>
                            <h3 title="` + dateFormat(message.created_at) + `">` + timeFormat(message.created_at) + `</h3>
                        </div>
                        <div class="triangle"></div>
                        <div class="message">` + message.content + `</div>
                    </li>`;
                chatContainer.append(newMessage);
            }

            socket.on("private-channel:App\\Events\\PrivateMessageEvent", function (message) {
                appendMessageToReceiver(message);
            });
        });
    </script>
@endpush
