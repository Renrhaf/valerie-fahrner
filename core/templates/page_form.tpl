<div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="index.php?model=Home">Votre espace</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?model=page&amp;action=showlist&amp;admin">Gestion des pages</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?model=page&amp;admin{if isset($data.page_id)}&amp;action=Editform&amp;pk={$data.page_id}{else}&amp;action=Createform{/if}">{if isset($data.page_id)}Modification d'une page{else}Création d'une page{/if}</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<form action="index.php?model=page&amp;action={if isset($data.page_id)}update{else}create{/if}&amp;admin" method="POST" class="formulaire" id="formulaire">
    {if isset($data.page_id)}
        <h3>Modification d'une page</h3>
        <input type="hidden" id="page_id" name="page_id" value="{$data.page_id}" />
    {else}
        <h3>Création d'une page</h3>
    {/if}
    
    <label for="page_title" required="required">Titre :</label>
    <input type="text" id="page_title" name="page_title" maxlength="64" class="validate[required]" value="{$data.page_title|default: ''}" />
    
    <label for="page_content" required="required">Contenu :</label>
    <textarea id="page_content" name="page_content" class="validate[required] tinyMCE_hidden_textarea mceEditor" data-prompt-position="topRight:0,120">
        {$data.page_content|default: ''}
    </textarea>
    
    <input type="submit" value="Valider" />
    <a class="reset" href="{$smarty.server.HTTP_REFERER|default: "index.php?model=Page&amp;action=showlist&amp;admin"}" title="Annuler">Annuler</a>
    <div style="clear:both;"></div>
</form>	