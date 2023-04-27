<div id="CallSupplierDiv">
    <div style="max-width: 280px;">

        <iframe id="myframe" frameborder="0" allowtransparency="true"></iframe>
        <div class="overlayButton"></div>

    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    function SetUpCall(phone_number){

        document.getElementById('CallSupplierDiv').style.display = "block";
        document.getElementById('myframe').src = window.location.protocol + "//" + window.location.host + "/Phone/index.php?number=" + phone_number;

        $('.overlayButton').click(function(){

            document.getElementById('CallSupplierDiv').style.display = "none";
            document.getElementById('myframe').src = "about:blank";


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
    }
    .overlayButton{
        bottom: 6px;
        left: 48px;
        position: absolute;
        width: 38%;
        height: 45px;
        background: transparent;
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
