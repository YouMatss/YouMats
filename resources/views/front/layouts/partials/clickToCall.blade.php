<div id="CallSupplierDiv">
    <div style="max-width: 280px;">

        <iframe id="myframe" frameborder="0" allowtransparency="true"></iframe>
        <div class="overlayButton"></div>

    </div>
</div>

<script>
    function SetUpCall(phone_number){

        document.getElementById('CallSupplierDiv').style.display = "block";
        document.getElementById('myframe').src = window.location.protocol + "//" + window.location.host + "/Phone/index.php?number=" + phone_number;

        $('.overlayButton').click(function(){

            document.getElementById('CallSupplierDiv').style.display = "none";
            iframe = document.getElementById('myframe');
            iframe.parentNode.removeChild(iframe);
        });

    }

</script>

<style>

    #myframe{
        height: 150px;
        width: 270px;
        position:relative;
        float:left;
    }
    .overlayButton{
        top: 10px;
        left: 36px;
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
