<!DOCTYPE html>
<html>
    <head>
        <title>Browser Phone</title>
        <meta name="description" content="Browser Phone is a fully featured browser based WebRTC SIP phone for Asterisk. Designed to work with Asterisk PBX. It will connect to Asterisk PBX via web socket, and register an extension.  Calls are made between contacts, and a full call detail is saved. Audio and Video Calls can be recorded locally.">

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no"/>

        <!-- Progressive Web App (PWA) -->
        <meta name="HandheldFriendly" content="true">
        <meta name="format-detection" content="telephone=no"/>
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="theme-color" media="(prefers-color-scheme: light)" content="#f6f6f6">
        <meta name="theme-color" media="(prefers-color-scheme: dark)"  content="#292929">
        <link rel="apple-touch-icon" href="icons/512.png">

        <!-- Cache -->
        <meta http-equiv="Pragma" content="no-cache"/>
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"/>
        <meta http-equiv="Expires" content="0"/>


        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="lib/Normalize/normalize-v8.0.1.css"/>
        <link rel="stylesheet preload prefetch" type="text/css" as="style" href="lib/fonts/font_roboto/roboto.css"/>
        <link rel="stylesheet preload prefetch" type="text/css" as="style" href="lib/fonts/font_awesome/css/font-awesome.min.css"/>

        <!-- <link rel="stylesheet" type="text/css" href="lib/jquery/jquery-ui-1.13.2.min.css"/> -->
        <link rel="stylesheet" type="text/css" href="lib/Croppie/croppie.css"/>
        <link rel="stylesheet" type="text/css" href="phone.css?rand=<?php echo rand(); ?>"/>
  
    </head>
    <body>
        <div id=Phone></div>
        <input id="dialText" type="hidden" value="<?php echo $_GET['number']  ?>" >
    </body>

    <!-- Loadable Scripts -->
    <script type="text/javascript" src="lib/jquery/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="lib/jquery/jquery-ui-1.13.2.min.js"></script>
    <script type="text/javascript" src="phone.js?rand=<?php echo rand(); ?>"></script>

    <!-- Deferred Scripts -->
    <link type="text/javascript" href="lib/Chart/Chart.bundle-2.7.2.min.js"/>
    <script type="text/javascript" src="lib/jquery/jquery.md5-min.js" defer="true"></script>
    <script type="text/javascript" src="lib/SipJS/sip-0.20.0.min.js" defer="true"></script>
    <script type="text/javascript" src="lib/FabricJS/fabric-2.4.6.min.js" defer="true"></script>
    <script type="text/javascript" src="lib/Moment/moment-with-locales-2.24.0.min.js" defer="true"></script>
    <script type="text/javascript" src="lib/Croppie/Croppie-2.6.4/croppie.min.js" defer="true"></script>
    <script  src="lib/XMPP/strophe-1.4.1.umd.min.js" defer="true"></script>

</html>