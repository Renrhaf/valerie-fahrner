<?php
// On lis les configurations de la maintenance
$config = Array();
$xml = new XMLReader();
if(!@$xml->open('config.xml')){
    // Si le fichier de config est introuvable, on ne se trouve pas en maintenance
    // et on redirige donc vers l'index du site
    header('Location: ../index.php'); exit;
}
$node = '';
while($xml->read()){
    switch($xml->nodeType){
        case XMLReader::ELEMENT:
            $node = $xml->name;
            if($xml->isEmptyElement) $config[$node] = '';
            break;
        case XMLReader::TEXT:
            $config[$node] = $xml->value;
            break;
        default:
            break;
    }
}

// On indique aux robots que c'est une page de maintenance
header('HTTP/1.1 503 Service Temporarily Unavailable');
header('Status: 503 Service Temporarily Unavailable');
// On leur dit de repasser dans 1h
header('Retry-After: 3600');
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" dir="ltr" lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <link rel="shortcut icon" href="favicon.png" />
        <title>Maintenance - Valérie Fahrner, potière/céramiste</title>
        
        <style type="text/css">
            body{
                background:url('matrixAnim.gif') repeat top center; 
            }

            /* Bloc principal centré contenant tout le site */
            #mainWrapper{
                width:1000px;
                margin:20px auto 20px auto;
                text-shadow: 0px 1px 1px #fff;
                font-family: Tahoma, Geneva, Kalimati, sans-serif; 
                color:#333333;
            }

            /* contenu du site */
            #content {
               -moz-box-shadow: 0 0 5px #888;
                -webkit-box-shadow: 0 0 5px#888;
                box-shadow: 0 0 5px #888;
                -webkit-border-radius: 15px;
                -moz-border-radius: 15px;
                border-radius: 15px;
                border:1px solid black;
                background-color:#F5F5F5;
            }

            /* Bloc d'entête du site */
            #header{
                text-align:center;
                font-size:xx-large;
                height:158px;
                background:url('logo.jpg') no-repeat top center;
                -webkit-border-top-left-radius: 15px;
                -webkit-border-top-right-radius: 15px;
                -moz-border-radius-topleft: 15px;
                -moz-border-radius-topright: 15px;
                border-top-left-radius: 15px;
                border-top-right-radius: 15px;
                border-bottom: 1px solid black;
            }

            /* Bloc de pied de page */
            #footer{
                clear:both;
                margin-top:20px;
                font-size:0.8em;
                text-align:center;
                font-style:italic;
                margin-bottom:4px;
            }
            
            h1{
                text-align:center;
                padding:4px;
                margin:20px 0 0 0;
                color:#4C1B1B;
                text-shadow: 0px 1px 1px #000;
            }
            
            #startDate{
                font-size:0.8em;
                padding:4px;
                text-align:center;
                margin:0 0 10px 0;
            }
            
            #desc{
                margin:20px;
                text-align:center;
            }
        </style>
    </head>
    <body>
        <div id="mainWrapper">
            <div id="content">
                <div id="header"></div>

                <div id="page">
                    <h1>Site en maintenance</h1>
                    <p id="startDate">
                        Début : <?php echo($config['start_date']); ?> à <?php echo($config['start_hour']); ?><br/>
                        Durée estimée : <?php echo($config['estimated_duration']); ?>
                    </p>
                    
                    <img src="techserver.jpg" width="720" height="470" style="display:block;margin:auto;width:720px;border:1px solid black;border-radius:10px;" alt="Site en maintenance"/>
                    <p id="desc">
                        Le site est <b>temporairement indisponible</b> pour cause de maintenance. Veuillez nous excuser pour la gène occasionnée.
                    </p>
                </div>
                
                <div id="footer">
                    Copyright - Contenu et images protégés par le droit d'auteur - Réalisation <a rel="nofollow" href="http://www.renrhaf.fr" title="Fils de valérie, étudiant en informatique">Quentin Fahrner</a>    
                </div>
            </div>
        </div>
        
        <script type="text/javascript">
            var music = new Audio('scifiSound.ogg');
            music.volume = 1;
            music.loop = true;
            music.play();
        </script>
    </body>
</html>