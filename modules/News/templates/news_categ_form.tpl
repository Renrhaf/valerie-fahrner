<div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="index.php?model=Home">Votre espace</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?module=News&amp;model=Newscateg&amp;action=showlist&amp;admin">Gestion des catégories d'actualités</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?module=News&amp;model=Newscateg&amp;admin{if isset($data.news_categ_id)}&amp;action=Editform&amp;pk={$data.news_categ_id}{else}&amp;action=Createform{/if}">{if isset($data.news_categ_id)}Modification d'une catégorie d'actualité{else}Création d'une catégorie d'actualité{/if}</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<form enctype="multipart/form-data" action="index.php?module=News&amp;model=Newscateg&amp;action={if isset($data.news_categ_id)}update{else}create{/if}&amp;admin" method="POST" class="formulaire" id="formulaire">
    {if isset($data.news_categ_id)}
        <h3>Modification d'une catégorie d'actualité</h3>
        <input type="hidden" id="news_categ_id" name="news_categ_id" value="{$data.news_categ_id}" />
    {else}
        <h3>Création d'une catégorie d'actualité</h3>
    {/if}
    
    <label for="news_categ_title" required="required">Titre :</label>
    <input type="text" id="news_categ_title" name="news_categ_title" maxlength="64" class="validate[required]" value="{$data.news_categ_title|default: ''}" />
    
    <label for="news_categ_description" required="required">Description :</label>
    <textarea id="news_categ_description" name="news_categ_description" maxlength="255" class="validate[required]">{$data.news_categ_description|default: ''}</textarea>

    <input type="submit" value="Valider" />
    <a class="reset" href="{$smarty.server.HTTP_REFERER|default: "index.php?module=News&amp;model=Newscateg&amp;action=showlist&amp;admin"}" title="Annuler">Annuler</a>
    <div style="clear:both;"></div>
</form>   