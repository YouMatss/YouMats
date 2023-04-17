<div id="CallSupplierDiv">
    <div>
        <div class="vendor_name">YouMats</div>
        <div id="TimerZone" style="text-align: center;/*display:none;*/" >
            <label id="minutes" style="margin: 0;">00</label>:<label id="seconds" style="margin: 0;">00</label>
        </div>
        <div class="connection">
            <input type="hidden" id="extension">
            <input type="button" id="call" value="call" class="btn btn-primary btn-block" />
            <button id="ChangeSpearker" class="btn btn-block">
                 <i class="fa fa-volume-down" style="font-size: 17px;"></i>
            </button>
            <label for="audioOutput">Audio output destination: </label><select id="audioOutput"></select>


        </div>
        <div id="calling"></div>
        <div id="media-views"></div>
    </div>
</div>
<script src="{{front_url()}}/assets/js/lib/sdp-interop-sl-1.4.0.js?rand={{rand('0','5000')}}"></script>
<script src="{{front_url()}}/assets/js/lib/jssip-3.0.13.js?rand={{rand('0','5000')}}"></script>
<script src="{{front_url()}}/assets/js/utils.js?rand={{rand('0','5000')}}"></script>
<script src="{{front_url()}}/assets/js/cyber_mega_phone.js?rand={{rand('0','5000')}}"></script>
<script src="{{front_url()}}/assets/js/phone_call.js?rand={{rand('0','5000')}}"></script>

<script>
    function SetUpCall(phone_number){

        MakeCall('call');
        document.getElementById('CallSupplierDiv').style.display = "block";
        document.getElementById('extension').value = phone_number;

        setTimeout(function() {
            document.getElementById('call').click();
        }, "1000");

    }

</script>

<style>
    #CallSupplierDiv {
        display: none;
        margin-bottom: 24px;
        padding: 20px;
        background-color: #FFF;
        position: fixed;
        right: -58px;
        bottom: 95px;
        box-sizing: border-box;
        align-items: center;
        border-radius: 24px;
        margin-left: 70px;
        margin-right: 70px;
        z-index: 9999;
        max-width: 400px;
        box-shadow: rgba(0, 0, 0, 0.1) 0 1px 20px 0;
        transition: all 0.3s ease-in-out 0s;
        transform: translateY(0px);
    }
    #call {
        margin-top: 20px;
        box-shadow: none;
        border-radius:  24px 0 0 24px;
        max-width: 70%;
        float: left;
    }
    #CallSupplierDiv .vendor_name {
        font-size: 30px;
        font-weight: bold;
        text-align: center;
    }
    #ChangeSpearker {
        margin-top: 20px;
        max-width: 30%;
        float: right;
        border-radius: 0 24px 24px 0;
        background: #00224e;
        color: white;
    }
    .connection{
        width: 180px;
    }
</style>
