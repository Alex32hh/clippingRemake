<?php session_start(); 
 ?>
<html>
<!-- <meta http-equiv="refresh" content="2"> -->
<head>
    <title>Manifexto - Agregador de Notícias 100% Angolano</title>
    <meta data-n-head="ssr" charset="utf-8">
    <meta data-n-head="ssr" name="viewport" content="width=device-width, initial-scale=1">
    <meta data-n-head="ssr" data-hid="description" name="description"
        content="O Manifexto é um agregador de notícias 100% angolano, independente e livre.">
    <meta data-n-head="ssr" data-hid="og:title" property="og:title"
        content="Manifexto - Agregador de Notícias 100% Angolano">
    <meta data-n-head="ssr" data-hid="og:description" property="og:description"
        content="O Manifexto é um agregador de notícias 100% angolano, independente e livre.">
    <meta data-n-head="ssr" data-hid="og:url" property="og:url" content="http://localhost:3000">
    <meta data-n-head="ssr" data-hid="og:image" property="og:image"
        content="http://localhost:3000/img/placeholder_image.png">
    <meta data-n-head="ssr" data-hid="og::image:secure_url" property="og:image:secure_url"
        content="http://localhost:3000/img/placeholder_image.png">
    <meta data-n-head="ssr" data-hid="twitter:title" name="twitter:title"
        content="Manifexto - Agregador de Notícias 100% Angolano">
    <meta data-n-head="ssr" data-hid="twitter:description" name="twitter:description"
        content="O Manifexto é um agregador de notícias 100% angolano, independente e livre.">
    <meta data-n-head="ssr" data-hid="twitter:image" name="twitter:image"
        content="http://localhost:3000/img/placeholder_image.png">
    <meta data-n-head="ssr" name="theme-color" content="#52D18D">
    <meta data-n-head="ssr" name="msapplication-navbutton-color" content="#52D18D">
    <meta data-n-head="ssr" name="apple-mobile-web-app-capable" content="yes">
    <meta data-n-head="ssr" name="apple-mobile-web-app-status-bar-style" content="#52D18D">
    <meta data-n-head="ssr" property="keywords" content="Notícias">
    <meta data-n-head="ssr" property="og:locale" content="pt_AO">
    <meta data-n-head="ssr" property="og:type" content="website">
    <meta data-n-head="ssr" property="og:site_name" content="Manifexto - Agregador de Notícias 100% Angolano">
    <meta data-n-head="ssr" property="article:publisher" content="https://www.facebook.com/manifexto">
    <meta data-n-head="ssr" name="twitter:creator" content="@manifexto">
    <meta data-n-head="ssr" name="twitter:site" content="@manifexto">
    <meta data-n-head="ssr" name="twitter:card" content="summary_large_image">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <link rel='stylesheet' href=''>
    <style>
    <?php 
        include "src/App.css";
        include "src/mainpage.css";
        include "src/reload.css";
    ?>
    </style>

    <!-- <link rel='stylesheet' href='src/mainpage.css'> -->
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
</head>

<body>
    <?php
    include 'config.php';
   

    $request =  str_replace('+', '%', $_SERVER['REQUEST_URI']);
    //depos mudar o resultado dos casos quando fazer deploy do site

    $p = explode("?p=", $request)[1];
    $pident = explode("?ident=", $request)[1];
    $campanha = explode("?cp=", $request)[1];

    $ps = str_replace('+', '%', $p);
    $psident = str_replace('+', '%', $pident);
    $psident = str_replace('+', '%', $pident);

    $pscampanha = str_replace('+', '%', $campanha);

     if ($request != "/clippinRemake/" && isset($_SESSION['email']) && $_SESSION['senha']){
        include 'Public/header.php';
        require 'src/server.php';
    }

    switch ($request) {
        case '/clippinRemake/':
            if (!isset($_SESSION['email']) && !$_SESSION['senha']) {
                echo "<script>window.location.href='/clippinRemake/login/';</script>";
            } else
                include __DIR__ . '/Public/pages/homeSerch.php';
            break;
        case '':
            if (!isset($_SESSION['email']) && !$_SESSION['senha']) {
                echo "<script>window.location.href='/clippinRemake/login/';</script>";
            } else
                require __DIR__ . '/views/index.php';
            break;
        case '/clippinRemake/result/?p=' . $ps . '':
            if (!isset($_SESSION['email']) && !$_SESSION['senha']) {
                echo "<script>window.location.href='/clippinRemake/login/';</script>";
            } else
                require __DIR__ . '/Public/pages/results.php';
            break;
        case '/clipping/dashboard/?cp=' . $pscampanha . '':
            require __DIR__ . '/views/dashboard.php';
            break;
        case '/clipping/alertas/':
            if (!isset($_SESSION['email']) && !$_SESSION['senha']) {
                echo "<script>window.location.href='/clippinRemake/login/';</script>";
            } else
                require __DIR__ . '/views/alertas.php';
            break;
        case '/clipping/edit/?ident=' . ($psident) . '':
            if (!isset($_SESSION['email']) && !$_SESSION['senha']) {
                echo "<script>window.location.href='/clippinRemake/login/';</script>";
            } else
                require __DIR__ . '/views/edit.php';
            break;
        case '/clippinRemake/login/':
            require __DIR__ . '/Public/pages/login.php';
            break;
        case '/clipping/cron-jobs/':
            require __DIR__ . '/cron-jobs/index.php';
            break;

        case '/clipping/Newalert/?p=' . ($ps) . '':
            if (!isset($_SESSION['email']) && !$_SESSION['senha']) {
                echo "<script>window.location.href='/clippinRemake/login/';</script>";
            } else
                require __DIR__ . '/views/Newalert.php';
            break;

        default:
            http_response_code(404);
            echo  str_replace('+', '%', $request);
            // require __DIR__ . '/views/404.php';
    }

    ?>
</body>

<script type="text/javascript">

window.onload = function () {
    var loadTime = window.performance.timing.domContentLoadedEventEnd-window.performance.timing.navigationStart; 
    // alert(loadTime/ 1000);
    $('.seconds-title-time').html(loadTime/ 1000);
    $('.totalResults').html( <?php echo $resul;?>);
   
}

var lastCont = 0;
var gridCont = (<?php echo $resul;?>);
document.onreadystatechange = function() {
lastCont=+10;
var boxes = document.querySelectorAll(".news-box");
for (i = 0; i < boxes.length; i++) {
    if (document.readyState !== "complete" && i > 10) {
        //boxes[i].style.display = "none";
        $('#b'+i).hide();
    }
}
};


function showMore(){
        var boxes = document.querySelectorAll(".news-box");
        lastCont+=10;
        var soma = (lastCont / 2);
        for (i =soma ; i < lastCont; i++) {
            $('#b'+i).show();
    }
    // alert(lastCont);
}

$(window).scroll(function() {
   if($(window).scrollTop() + window.innerHeight == $(document).height()) {
        if(lastCont >= gridCont){
            $('.noMoreResult').show();
            $('.spinner').hide();
        }else
            setTimeout(function() {showMore();}, 500);
   }
});

</script>

</html>