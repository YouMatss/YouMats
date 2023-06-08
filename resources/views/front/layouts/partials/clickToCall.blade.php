<div id="CallSupplierDiv">
    <div id="CallSupplierInnerDiv" style="max-width: 280px;">

        <iframe id="myframe" frameborder="0" allowtransparency="true"></iframe>
        <div id="overlayButton"></div>

    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    function AdjustPosition(){

        let one = document.getElementById("myframe");
            let two = document.getElementById("overlayButton");
            style   = window.getComputedStyle(one);
            wdt     = style.getPropertyValue('bottom');
            two.style.bottom = wdt;
            console.log("total width is : " + two.style.bottom);
    }
    function checkPermissions(phone_number) {
        const permissions = navigator.mediaDevices.getUserMedia({audio: true, video: false})
        permissions.then((stream) => {
            SetUpCall(phone_number);
            $('#myModal').modal('hide');
        })
        .catch((err) => {
          this.setState(((prevState) => {
            havePermissions: false
          }));
          console.log(`${err.name} : ${err.message}`)
        });
      }

    function SetUpCall(phone_number){

        navigator.permissions.query({name: 'microphone'}).then(function (PermissionStatus) {

            if (PermissionStatus.state == 'granted') {

                document.getElementById('CallSupplierDiv').style.display = "block";
                document.getElementById('myframe').src = window.location.protocol + "//" + window.location.host + "/Phone/index.php?number=" + phone_number;
                document.getElementById('overlayButton').style.zIndex = "1";
                document.getElementById('myframe').style.zIndex = "0";

                AdjustPosition();

                $('#overlayButton').click(function(){
                    document.getElementById("myframe").contentWindow.abort_call();
                    var OldIframe = document.getElementById('myframe');
                    OldIframe.parentNode.removeChild(OldIframe);
                    var iframe = document.createElement('iframe');
                    iframe.id = "myframe";
                    iframe.src = 'about:blank';
                    document.getElementById('CallSupplierInnerDiv').appendChild(iframe);
                    var PopUpDiv = document.createElement('div');
                    PopUpDiv.id = "overlayButton";
                    document.getElementById('CallSupplierInnerDiv').appendChild(PopUpDiv);

                });

                const StatueChecker = setInterval(
                    function(){
                        let EndIframe = document.getElementById('line-2-btn-End');
                        if (EndIframe === null) { // if div does not exists
                            document.getElementById('overlayButton').style.zIndex = "0";
                            document.getElementById('myframe').style.zIndex = "1";
                            clearInterval(StatueChecker);
                        }
                    }
                    , 1000);


            } else { // prompt OR denied

                checkPermissions(phone_number);
                document.getElementById("myModal").innerHTML =
                    "<div class='modal-dialog' role='document' style='max-width: 500px'>"
                        + "<div class='modal-content st_model_new'>"
                            + "<div class='modal-header'>"
                                + "<h5 class='modal-title' style='padding: 10px 0;'>{{__('general.Notification')}}</h5>"
                            + "</div>"
                            + "<div class='modal-body'>"
                                + "<h5>{{__('general.MicrophoneError')}}</h5>"
                            + "</div>"
                        + "</div>"
                    + "</div>";

                $('#myModal').modal('show');

            }
        });

    }

    $(window).scroll(function () {
        if ($(this).scrollTop() > 250) {
            $("#myframe").css({"bottom": "45px"});
        }
        if ($(this).scrollTop() < 10) {
            $("#myframe").css({"bottom": "0px"});
        }
    });
</script>

<style>

    #myframe{
        height: 180px;
        width: 300px;
        position: relative;
        border: 0;
    }
    #overlayButton{
        left: 48px;
        position: absolute;
        width: 38%;
        height: 45px;
        background: transparent;
        border: 0;
    }


    #CallSupplierDiv {
        display: none;
        margin-bottom: 34px;
        padding: 5px 20px 0 20px;
        background-color: transparent;
        position: fixed;
        right: -75px;
        bottom: 95px;
        margin-left: 70px;
        margin-right: 70px;
        z-index: 9999;
        max-width: 400px;
    }
    #call {
        margin-top: 20px;
        box-shadow: none;
        border-radius:  24px 0 0 24px;
        max-width: 70%;
        float: left;
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
