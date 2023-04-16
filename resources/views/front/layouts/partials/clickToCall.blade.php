<div id="CallSupplierDiv">
    <div>
        <div class="vendor_name">YouMats</div>
        <div id="TimerZone" style="text-align: center;/*display:none;*/" >
            <label id="minutes" style="margin: 0;">00</label>:<label id="seconds" style="margin: 0;">00</label>
        </div>
        <div class="connection">
            <input type="hidden" id="extension">
            <input type="button" id="call" class="btn btn-primary btn-block" />
        </div>
        <div id="calling"></div>
        <div id="media-views"></div>
    </div>
</div>
<script src="{{front_url()}}/assets/js/lib/sdp-interop-sl-1.4.0.js"></script>
<script src="{{front_url()}}/assets/js/lib/jssip-3.0.13.js"></script>
<script src="{{front_url()}}/assets/js/utils.js"></script>
<script src="{{front_url()}}/assets/js/cyber_mega_phone.js"></script>
<script src="{{front_url()}}/assets/js/phone_call.js"></script>

<script>
    function SetUpCall(phone_number){
        document.getElementById('extension').value = phone_number;
        document.getElementById('CallSupplierDiv').style.display = "block";
        document.getElementById('call').click();
    }
</script>

<style>
    #CallSupplierDiv {
        display: none;
        margin-bottom: 24px;
        padding: 32px;
        background-color: #FFF;
        position: fixed;
        right: 0;
        bottom: 0;
        box-sizing: border-box;
        align-items: center;
        border-radius: 24px;
        margin-left: 70px;
        margin-right: 70px;
        z-index: 9999;
        max-width: 350px;
        box-shadow: rgba(0, 0, 0, 0.1) 0 1px 20px 0;
        transition: all 0.3s ease-in-out 0s;
        transform: translateY(0px);
    }
    #call {
        margin-top: 20px;
        box-shadow: none;
        border-radius: 24px;
    }
    #CallSupplierDiv .vendor_name {
        font-size: 30px;
        font-weight: bold;
        text-align: center;
    }
</style>
