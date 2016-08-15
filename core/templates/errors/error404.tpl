<div id="error">
    <h2>Désolé, la page que vous demandez est introuvable.</h2>

    <p id="error_sol">Vous pouvez retourner à la page précédente, utiliser le menu<br/> ou lancer une recherche par mots clé pour continuer à naviguer sur le site.</p>
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