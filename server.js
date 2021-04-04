var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http, {
    cors: {
        extraHeaders: {
            'Access-Control-Allow-Origin': '*'
        }
    }
});
var Redis = require('ioredis');
var redis = new Redis();
var users = [];

http.listen(8005, () => {
    console.log('listening on *:8005');
});

redis.subscribe('private-channel', function () {
    console.log('Subscribed to Private channel');
})

redis.on('message', function (channel, message) {
    console.log(channel);
    console.log(message);
})

io.on('connection', function (socket) {
    socket.on("user_connected", function (user_id) {
        users[user_id] = socket.id;
        io.emit('updateUserStatus', users);
        console.log("user connected " + user_id);
    });

    socket.on('disconnect', function () {
        var i = users.indexOf(socket.id);
        users.splice(i, 1, 0);
        io.emit('updateUserStatus', users);
        console.log(users);
    });
});
