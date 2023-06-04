<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no"/>

        <!-- Progressive Web App (PWA) -->
        <meta name="HandheldFriendly" content="true">
        <meta name="format-detection" content="telephone=no"/>
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes"/>

        <!-- Cache -->
        <meta http-equiv="Pragma" content="no-cache"/>
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"/>
        <meta http-equiv="Expires" content="0"/>

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="https://dtd6jl0d42sve.cloudfront.net/lib/Normalize/normalize-v8.0.1.css"/>
        <link rel="stylesheet preload prefetch" type="text/css" as="style" href="https://dtd6jl0d42sve.cloudfront.net/lib/fonts/font_roboto/roboto.css"/>
        <link rel="stylesheet preload prefetch" type="text/css" as="style" href="https://dtd6jl0d42sve.cloudfront.net/lib/fonts/font_awesome/css/font-awesome.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://dtd6jl0d42sve.cloudfront.net/lib/jquery/jquery-ui-1.13.2.min.css"/>
        <link rel="stylesheet" type="text/css" href="phone.css?rand=<?php echo rand(); ?>"/>

    </head>

    <body>

        <div id="TheMobilePlaceHolder" class="cleanScroller" style="position: absolute; bottom: 0px; right: 0px;">
            <div class="CallControlContainer">
                <button id="line-1-btn-End" class="roundButtons dialButtons inCallButtons hangupButton" title="End Call" style="margin-right: -10px;">
                    <i class="fa fa-phone" style="transform: rotate(135deg);font-size: xx-large;"></i>
                    <div id="line-1-timer" style="font-size: 10px;margin-top: -5px;width: 100%;">00:00</div>
                </button>
                <button id="line-1-btn-Mute" style="margin-right: -9px;background-color: rgb(0, 63, 145);border-radius: 0px;border-left: 1px solid rgb(1, 49, 110);" class="roundButtons dialButtons inCallButtons" title="Mute">
                    <i class="fa fa-microphone-slash"></i>
                </button>
                <button id="line-1-btn-Hold" class="roundButtons dialButtons inCallButtons" style="background-color: rgb(0, 63, 145); border-radius: 0px; border-left: 1px solid rgb(1, 49, 110); margin-right: -5px;" title="Hold Call">
                    <i class="fa fa-pause-circle"></i>
                </button>
                <button id="line-1-btn-settings" class="roundButtons dialButtons inCallButtons" style="border-radius: 0 30px 30px 0;background: #003f91;border-left: 1px solid #01316e;margin: 0;" title="Device Settings">
                    <i class="fa fa-volume-up"></i>
                </button>
            </div>
        </div>

        <!-- The Phone -->
        <div id=Phone></div>
        <input id="dialText" type="hidden" value="<?php echo $_GET['number']  ?>" >

    </body>

    <!-- Loadable Scripts -->
    <script type="text/javascript" src="https://dtd6jl0d42sve.cloudfront.net/lib/jquery/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="https://dtd6jl0d42sve.cloudfront.net/lib/jquery/jquery-ui-1.13.2.min.js"></script>
    <script type="text/javascript" src="phone.js?rand=<?php echo rand(); ?>"></script>

    <!-- Deferred Scripts -->
    <script type="text/javascript" src="https://dtd6jl0d42sve.cloudfront.net/lib/jquery/jquery.md5-min.js" defer="true"></script>
    <script type="text/javascript" src="https://dtd6jl0d42sve.cloudfront.net/lib/Chart/Chart.bundle-2.7.2.min.js" defer="true"></script>
    <script type="text/javascript" src="https://dtd6jl0d42sve.cloudfront.net/lib/SipJS/sip-0.20.0.min.js" defer="true"></script>
    <script type="text/javascript" src="https://dtd6jl0d42sve.cloudfront.net/lib/FabricJS/fabric-2.4.6.min.js" defer="true"></script>
    <script type="text/javascript" src="https://dtd6jl0d42sve.cloudfront.net/lib/Moment/moment-with-locales-2.24.0.min.js" defer="true"></script>
    <script type="text/javascript" src="https://dtd6jl0d42sve.cloudfront.net/lib/XMPP/strophe-1.4.1.umd.min.js" defer="true"></script>

    <script type="text/javascript" >
        const StatueChecker = setInterval(
            function(){
                let MyCallDiv = document.getElementById('line-2-ActiveCall');
                if (MyCallDiv === null) { // if div does not exists
                    console.log('waiting for response');
                }else{
                    if(MyCallDiv.style.display = "block"){
                        console.log('respond found');
                        document.getElementById('TheMobilePlaceHolder').style.display = "none";
                        clearInterval(StatueChecker);
                    }
                }
            }
            , 1000);


    </script>
</html>