<!DOCTYPE html>
<html>
<head>
    <title>Jogo</title>
    <link rel="shortcut icon" type="image/x-icon" href="../img/icon/favicon.ico"/>

    <!--Ter todos os simbolos -->
    <meta charset="utf-8">


    <!--Zoom em tablets/mobile-->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="viewport"
          content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, shrink-to-fit=no">


    <!--Boostrap 4.0 CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
          integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <!--Site CSS -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <!-- Jogo CSS -->
    <link rel="stylesheet" type="text/css" href="../css/jogo.css">


    <!-- Phaser -->
    <script src="https://cdn.jsdelivr.net/npm/phaser-ce@2.8.3/build/phaser.js"></script>
    <script src="../js/functions.js"></script>
    <script type="text/javascript" src="jogo.js"></script>

    <!--Icones do google -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <style>
        html, body, #ct, #ct > div {
            height: 100%;
        }

        #ct > div {
            float: left;
        }

        .carta {

        }

        #ct-cartas {
            overflow: scroll;
            height: 40%;
        }
        .carta > img{
            width: 33%;
        }
        #left > button, #right {
            display: block;
            margin: auto;
            width: 40%;
            height: auto;
        }
    </style>
</head>


<body>
<div id="ct">
    <div id="left" style="background-color: red;width: 10%;">
        <button class="btn btn-warning" href="javascript:void(0)" onclick="toggleFullScreen()">
            <i class="material-icons" id="btn-fullscreen">fullscreen</i>
        </button>
    </div>
    <div style="background-color: blue;width: 60%" id="center"></div>
    <div style="background-color: green;width: 30%" id="right">
        <div id="ct-cartas">
            <div class="carta">
                <img src="https://pbs.twimg.com/profile_images/1233627159/TibiaIcon_400x400.png">
            </div>
            <div class="carta">
                <img src="https://pbs.twimg.com/profile_images/1233627159/TibiaIcon_400x400.png">
            </div>
            <div class="carta">
                <img src="https://pbs.twimg.com/profile_images/1233627159/TibiaIcon_400x400.png">
            </div>
            <div class="carta">
                <img src="https://pbs.twimg.com/profile_images/1233627159/TibiaIcon_400x400.png">
            </div>
            <div class="carta">
                <img src="https://pbs.twimg.com/profile_images/1233627159/TibiaIcon_400x400.png">
            </div>

        </div>
    </div>
</div>

<script>
    document.body.addEventListener
    (
        'touchmove',
        function (e) {
            e.preventDefault();
        }
    );
</script>
<!--JQuery, Javascript para Bootstrap -->
<script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
        integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
        crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
        crossorigin="anonymous"></script>
</body>
<!-- Fullscreen script -->
<script type="text/javascript" src="../js/fullscreen.js"></script>


</html>