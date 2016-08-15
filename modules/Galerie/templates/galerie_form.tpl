<div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="index.php?model=Home">Votre espace</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?module=Galerie&amp;model=Galerie&amp;action=showlist&amp;admin">Gestion des galeries</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?module=Galerie&amp;model=Galerie&amp;admin{if isset($data.galerie_id)}&amp;action=Editform&amp;pk={$data.galerie_id}{else}&amp;action=Createform{/if}">{if isset($data.galerie_id)}Modification de la galerie : {$data.galerie_title}{else}Création d'une galerie{/if}</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<form action="index.php?module=Galerie&amp;model=Galerie&amp;action={if isset($data.galerie_id)}update{else}create{/if}&amp;admin" method="POST" class="formulaire" id="formulaire">
    {if isset($data.galerie_id)}
        <h3>Modification d'une galerie</h3>
        <input type="hidden" id="galerie_id" name="galerie_id" value="{$data.galerie_id}" />
    {else}
        <h3>Création d'une galerie</h3>
    {/if}
    
    <label for="galerie_title" required="required">Titre :</label>
    <input type="text" id="galerie_title" name="galerie_title" maxlength="64" class="validate[required]" value="{$data.galerie_title|default: ''}" />
    
    <label for="galerie_description">Description :</label>
    <textarea id="galerie_description" name="galerie_description" maxlength="255">{$data.galerie_description|default: ''}</textarea>
    
    <div style="clear:both;"></div>
    <label for="new_keyword">Ajout de mot clé :</label>
    <div id="autocompleter">
    <input type="text" id="new_keyword" name="new_keyword" maxlength="32" autocomplete="off" />
    <ul id="suggestions"></ul>
    </div>
    
    <h5 style="clear:both;">Mots clés utilisés</h5>
    <ul id="used_keyword_list">
    {if isset($data.used_keywords)}
        {foreach $data.used_keywords as $id => $word}
            <li id="k_{$id}"><input type="hidden" name="keywords[]" value="{$id}"/>{$word}</li>
        {/foreach}
    {/if}
    </ul>
    <div id="manageKeywords">
        <a class="boutonW" style="float:left;line-height:26px;">Supprimer</a>
    </div>
    
    <input type="submit" value="Valider" />
    <a class="reset" href="{$smarty.server.HTTP_REFERER|default: "index.php?module=Galerie&amp;admin"}" title="Annuler">Annuler</a>
    <div style="clear:both;"></div>
</form>