function MakeCall (CallButton){

    function createMediaView(stream) {

		let mediaView = document.createElement("div");
		let video = document.createElement("video");
		video.autoplay = true;
		video.srcObject = stream;
        video.setAttribute('webkit-playsinline', 'webkit-playsinline');
        video.setAttribute('playsinline', 'playsinline');

        video.onloadedmetadata = function() {
            let tracks = stream.getVideoTracks();

            for (let i = 0; i < tracks.length; ++i) {
                tracks[i].enabled = true;
            }
        };


		if (stream.local == true) {
			video.muted = true;
		}


		mediaView.appendChild(video);
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


            let minutesLabel = document.getElementById("minutes");
            let secondsLabel = document.getElementById("seconds");
            let totalSeconds = 0;
            setInterval(setTime, 1000);

            function setTime() {
            ++totalSeconds;
            secondsLabel.innerHTML = pad(totalSeconds % 60);
            minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
            }

            function pad(val) {
            let valString = val + "";
            if (valString.length < 2) {
                return "0" + valString;
            } else {
                return valString;
            }
            }

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
                document.getElementById("minutes").value = "00";
                document.getElementById("seconds").value = "00";

            }
        });


        window.onunload = function() { if (phone) { phone.disconnect(); } };

        phone.connect();
        ConnectStatue = "Connecting";
}
