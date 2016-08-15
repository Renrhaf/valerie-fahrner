<div id="error">
    <h2>Une erreur interne au serveur s'est produite.</h2>

    <p id="error_sol">Notre système rencontre actuellement des problèmes.<br/>Nous faisons notre possible pour rétablir son bon fonctionnement au plus vite.</p>
</div>

<div class="top_bottom_btns">    
    <a style="float:right;" class="boutonW" href="{$smarty.server.HTTP_REFERER|default: "index.php"}" title="Retour à la page précédente">Retour à la page précédente</a>
    <div style="clear:both;"></div>
</div>

<script type="text/javascript">
    var music = new Audio('core/sounds/SadTrombone.wav');
    music.volume = 0.1;
    music.play();
</script>