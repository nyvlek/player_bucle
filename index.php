<?php 
/**
 * REPRODUCTOR DE VIDEOS (CON BUCLE)
 * @author Aris Kelvyn (admin@nyvlek.com)
 * @version 1.0
 */
$url = "http://brightcove.vo.llnwd.net/e1/uds/pd/1084781208001/1084781208001_2621464910001_2013-08-19-1-ANO-EDUCACION-WEB.mp4"; ?>
<h2>Bucle Video</h2>
<style type="text/css">
    #lista_videos { float: left; }
    #lista_videos li { cursor: pointer; }
    #lista_videos li:hover { text-decoration: underline; }
</style>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        /* Selectores de la aplicacion */
        video = document.getElementById("videoplayer"); /* Seleccionar el video player */
        boton_plause = document.getElementById("play");

        /* Variables de la aplicacion */
        final = video.duration; /* Llenar la variable con el tiempo total del video */
        str_pausa = "Pausar";
        str_play = "Reproducir";

        jQuery("#lista_videos li").hover(
                function() {
                    /* Con un paso activo */
                    inicio = jQuery(this).attr("inicio");
                    final = jQuery(this).attr("final");
                    video.currentTime = inicio;
                    video.play();

                }, function() {
            /* Cuando no hay un paso activo */
            inicio = 0;
            final = video.duration;
        }
        );

        /* Ejecuciones cuando el video comienze a reproducirse */
        document.getElementById('videoplayer').addEventListener('timeupdate', function() {
            /* Si esta haciendo buffering mostar la imagen de cargando */
            if (this.buffered.end(0) < this.currentTime) {
                jQuery("#cargando").fadeIn("fast");
            } else {
                jQuery("#cargando").fadeOut("fast");
            }

            /* Cambiar el boton de Play / Pause */
            if (video.paused) {
                boton_plause.textContent = str_play;
            } else {
                boton_plause.textContent = str_pausa;
            }

            /* Si la reproduccion llega al máximo repetir */
            if (final !== undefined && this.currentTime >= final) {
                this.currentTime = inicio;
                this.play();
            }
        }, false);
    });

    /*  Acción en el boton de reproducir y pausar */
    function videoplayer() {
        if (video.paused) {
            video.play();
            boton_plause.textContent = str_play;
        } else {
            video.pause();
            boton_plause.textContent = str_pausa;
        }
    }
</script>
</head>
<body>        
    <div style="float:left;">
        <video width="640" height="360" preload="auto" id="videoplayer" >
            <source src="<?php echo $url; ?>" type="video/mp4" />
            Este reproductor requiere HTML 5 - Puedes usar <a href="https://www.google.com/intl/es/chrome/browser/">Google Chrome</a><br />
            <a href="<?php echo $url; ?>">Descargar este video</a>
        </video>
        <br />
        <button id="play" onclick="videoplayer()">&gt;</button>
    </div>

    <div id="lista_videos">
        <ul>
            <li inicio="0" final="5">Paso 1</li>
            <li inicio="5" final="10">Paso 2</li>
            <li inicio="10" final="15">Paso 3</li>
            <li inicio="15" final="20">Paso 4</li>
            <li inicio="20" final="25">Paso 5</li>
            <li inicio="30" final="35">Paso 6</li>
            <li inicio="35" final="40">Paso 7</li>
        </ul>
    </div>

    <div style="clear:both;"></div>

    <img id="cargando" src="imgs/cargando.gif" />