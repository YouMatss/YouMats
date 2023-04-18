<div id="CallSupplierDiv">
    <div class="connection">
        <input type="hidden" id="extension" />
        <input type="button" id="call" value="Call" class="btn btn-primary btn-block" />
        <div id="TimerZone" style="/*display:none;*/" >
            <label id="minutes" style="margin: 0;">00</label>:<label id="seconds" style="margin: 0;">00</label>
        </div>
        <div class="options">
            <button id="speaker" type="button" onclick="speakerToggle()" class="btn btn-primary"><i class="fa fa-volume-up"></i></button>
            <button id="mute" type="button" onclick="muteToggle()" class="btn btn-primary"><i class="fa fa-microphone-slash"></i></button>
        </div>
    </div>
</div>
<div id="calling"></div>
<div id="media-views"></div>

<script src="{{front_url()}}/assets/js/lib/sdp-interop-sl-1.4.0.js"></script>
<script src="{{front_url()}}/assets/js/lib/jssip-3.0.13.js"></script>
<script src="{{front_url()}}/assets/js/utils.js"></script>
<script src="{{front_url()}}/assets/js/cyber_mega_phone.js?rand={{rand('0','5000')}}"></script>
<script src="{{front_url()}}/assets/js/phone_call.js?rand={{rand('0','5000')}}"></script>

<script>
    function SetUpCall(phone_number){
        MakeCall('call');
        document.getElementById('extension').value = phone_number;
        document.getElementById('CallSupplierDiv').style.display = "block";

        setTimeout(function() {
            document.getElementById('call').click();
        }, 1000);
    }
    function muteToggle() {
        // mute();
        $('#mute').toggleClass('active');
    }
    function speakerToggle() {
        $('#speaker').toggleClass('active');
    }
</script>

<style>
    #CallSupplierDiv {
        display: none;
        margin-bottom: 15px;
        padding: 20px;
        background-color: #FFF;
        position: fixed;
        right: 0;
        bottom: 0;
        box-sizing: border-box;
        border-radius: 24px;
        margin-left: 70px;
        margin-right: 70px;
        z-index: 9999;
        max-width: 400px;
        box-shadow: rgba(0, 0, 0, 0.1) 0 1px 20px 0;
        transition: all 0.3s ease-in-out 0s;
        transform: translateY(0px);
    }
    #CallSupplierDiv #call{
        border-radius: 24px;
        margin-bottom: 8px;
        box-shadow: none;
    }

    #CallSupplierDiv #TimerZone {
        text-align: center;
        font-size: 16px;
        direction: ltr;
    }

    #CallSupplierDiv .options {
        margin-top: 8px;
        text-align: center;
        padding-top: 5px;
    }

    #CallSupplierDiv #speaker, #CallSupplierDiv #mute {
        border-radius: 50%;
        display: inline-block;
        vertical-align: middle;
        font-size: 16px;
        cursor: pointer;
        background-color: #FFF;
        border-color: #FFF;
        color: #000;
        margin: 0 4px;
    }

    #CallSupplierDiv #speaker.active, #CallSupplierDiv #mute.active {
        background-color: #003f91;
        border-color: #003f91;
        color: #FFF;
    }

    #CallSupplierDiv .connection{
        width: 180px;
    }
</style>
