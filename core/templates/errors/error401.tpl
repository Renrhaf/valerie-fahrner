<div id="error">
    <h2>Vous n'êtes pas autorisé à accèder à cette page !</h2>

    <p id="error_sol">Cette page nécessite des privilèges dont vous ne disposez pas actuellement.<br/> Si vous pensez que ce n'est pas le comportement normal, <a href="{$config.realpath}contactez-nous">contactez-nous</a>.</p>
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