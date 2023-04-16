function MakeCall (CallButton){
    let phone;
    let ConnectStatue = "Connect";
    let CallButtonStatue = document.getElementById(CallButton);

    CallButtonStatue.disabled = true;

    phone = new CyberMegaPhone("2001", "2001", "b03dbe258ea7eeb", "youmats.andeverywhere.net", true);


        if (ConnectStatue == "Disconnect") {
            CallButtonStatue.disabled = true;
            ConnectStatue = "Disconnecting";
            phone.disconnect();
            return;
        }

        phone.handle("connected", function () {
            if (ConnectStatue != "Disconnect") {
                ConnectStatue = "Registering";
            } else {
                ConnectStatue = "Disconnect";
                CallButtonStatue.disabled = false;
            }
        });

        phone.handle("disconnected", function () {
            ConnectStatue = "Connect";
            CallButtonStatue.disabled = true;
        });

        phone.handle("registered", function () {
            ConnectStatue = "Disconnect";
            CallButtonStatue.disabled = false;
        });

        phone.handle("registrationFailed", function () {
            phone.disconnect();
        });

        phone.handle("failed", function (reason) {
            CallButtonStatue.disabled = false;
        });

        phone.handle("ended", function (reason) {
            ConnectStatue == "Connect";
        });

        phone.handle("streamAdded", function (stream) {
            document.getElementById("media-views").appendChild(createMediaView(stream));

            document.getElementById(CallButton).classList.remove('btn-primary');
            document.getElementById(CallButton).classList.add('btn-danger');
            document.getElementById(CallButton).value = "Hangup";
            CallButtonStatue.disabled = false;

        });

        phone.handle("streamRemoved", function (stream) {
            removeMediaView(document.getElementById("media-views"), stream);
        });

        CallButtonStatue.addEventListener("click", function() {
            if (CallButtonStatue.value == "Call") {
                phone.call(document.getElementById("extension").value);
                CallButtonStatue.classList.remove('btn-danger');
                CallButtonStatue.classList.add('btn-primary');
                CallButtonStatue.disabled = true;
                CallButtonStatue.value = "Ringing";
            } else if (CallButtonStatue.value == "Answer") {
                CallButtonStatue.disabled = true;
                CallButtonStatue.classList.remove('btn-primary');
                CallButtonStatue.classList.add('btn-danger');
                CallButtonStatue.value = "Hangup";
            } else {
                CallButtonStatue.classList.remove('btn-danger');
                CallButtonStatue.classList.add('btn-primary');
                CallButtonStatue.value = "Call";
                phone.terminate();
                document.getElementById("CallSupplierDiv").style.display = "none";
            }
        });


        window.onunload = function() { if (phone) { phone.disconnect(); } };

        phone.connect();
        ConnectStatue = "Connecting";

        FullScreen.prototype.request = function() {
			if (this.is()) {
				return;
			}

			if (this._obj.requestFullscreen) {
				this._obj.requestFullscreen();
			} else if (this._obj.mozRequestFullScreen) {
				this._obj.mozRequestFullScreen();
			} else if (this._obj.webkitRequestFullScreen) {
				this._obj.webkitRequestFullScreen();
			} else if (this._obj.msRequestFullscreen) {
				this._obj.msRequestFullscreen();
			}

			this.setData(true);
		};
}


function createMediaView(stream) {
let mediaView       = document.createElement("div");
mediaView.className = "media-view";
mediaView.id        = stream.id; // Makes it easy to find later

let videoView    = document.createElement("div");
let videoOverlay = document.createElement("div");
videoOverlay.classname = "media-overlay";

if (stream.local == false) {
    let audioTracks = stream.getAudioTracks();
    let videoTracks = stream.getVideoTracks();
    let videoText   = document.createTextNode("No Media Available");
    if (audioTracks.length > 0) {
        videoText = document.createTextNode("Audio Only");
    } else if (videoTracks.length > 0) {
        videoText = document.createTextNode("Waiting For Video");
    }
    videoOverlay.appendChild(videoText);

    function checkForVideo() {
        if (video.videoWidth < 10 || video.videoHeight < 10) {
            videoView.style.display = 'none';
            return;
        }

        videoOverlay.removeChild(videoText);
        videoText = document.createTextNode("Remote Video");
        videoOverlay.appendChild(videoText);

        videoView.style.display = 'inline';
    }

    setInterval(checkForVideo, 1000);
}


let video = document.createElement("video");
video.autoplay = true;
video.srcObject = stream;
video.onloadedmetadata = function() {
    let tracks = stream.getVideoTracks();

    for (let i = 0; i < tracks.length; ++i) {
        tracks[i].enabled = true;
    }
};


videoView.appendChild(video);
mediaView.appendChild(videoView);

return mediaView;
}

function findMediaView(parent, stream) {
    let nodes = parent.childNodes;

    for (let i = 0; i < nodes.length; ++i) {
        if (nodes[i].id == stream.id) {
            return nodes[i];
        }
    }

    return null;
}
function removeMediaView(parent, stream) {
    let node = findMediaView(parent, stream);
    if (node) {
        parent.removeChild(node);
    }
}


window.onload = function() { MakeCall('call'); };
