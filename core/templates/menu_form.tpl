<div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="index.php?model=Home">Votre espace</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?model=Menu&amp;action=showlist&amp;admin">Gestion du menu</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?model=Menu&amp;admin{if isset($data.menu_block_id)}&amp;action=Editform&amp;pk={$data.menu_block_id}{else}&amp;action=Createform{/if}">{if isset($data.page_id)}Modification d'un élément du menu{else}Ajout d'un élément au menu{/if}</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<form action="index.php?model=Menu&amp;action={if isset($data.menu_block_id)}Update{else}Create{/if}&amp;admin" method="POST" class="formulaire" id="formulaire">
    {if isset($data.menu_block_id)}
        <h3>Modification d'un élément du menu</h3>
        <input type="hidden" id="menu_block_id" name="menu_block_id" value="{$data.menu_block_id}" />
    {else}
        <h3>Ajout d'un élément au menu</h3>
    {/if}
    
    <label for="menu_block_title" required="required">Titre :</label>
    <input type="text" id="menu_block_title" name="menu_block_title" maxlength="64" class="validate[required]" value="{$data.menu_block_title|default: ''}" />
    
    <label for="menu_block_link" required="required">Destination :</label>
    <input type="text" id="menu_block_link" name="menu_block_link" maxlength="64" class="validate[required]" value="{$data.menu_block_link|default: ''}" />
    
    <input type="submit" value="Valider" />
    <a class="reset" href="{$smarty.server.HTTP_REFERER|default: "index.php?model=Menu&amp;action=showlist&amp;admin"}" title="Annuler">Annuler</a>
    <div style="clear:both;"></div>
</form>   


		