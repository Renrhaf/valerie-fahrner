<div id="error">
    <h2>Vous n'êtes pas autorisé à accèder à ce fichier !</h2>

    <p id="error_sol">Pour des raisons de sécurité, l'accès à cette ressource est strictement interdit.<br/> Merci de votre compréhension.</p>
</div>

<div class="top_bottom_btns">    
    <a style="float:right;" class="boutonW" href="{$smarty.server.HTTP_REFERER|default: "index.php"}" title="Retour à la page précédente">Retour à la page précédente</a>
    <div style="clear:both;"></div>
</div>
    
{literal}
<script type="text/javascript">
    var music = new Audio('core/sounds/WoopWoop.wav');
    music.volume = 0.1;
    music.play();
    
    var i = true;
    $(document).ready(function(){
            setTimeout(switchBackground,1000);
    });
        
    function switchBackground(){
        if(i){
            $('#error').css('background-image','url(\'core/images/exclamation2.gif\')');
            i = false;
         } else {
            $('#error').css('background-image','url(\'core/images/exclamation.gif\')');
            i = true;
         }
         setTimeout(switchBackground,1000);
    }
</script>
{/literal}