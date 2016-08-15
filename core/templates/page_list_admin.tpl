<div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="index.php?model=Home">Votre espace</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?model=page&amp;action=showlist&amp;admin">Gestion des pages</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<h3 class="page_title">Gestion des pages</h3>

<div class="top_bottom_btns">
    <a style="float:left;margin-right:7px;" class="boutonW" href="index.php?model=page&amp;action=Createform&amp;admin" title="Créer une page">Créer une page</a>    
    {include file='core/templates/multipage.tpl' data=$data.multipage}
    <a style="float:right;" class="boutonW" href="{$smarty.server.HTTP_REFERER|default: "index.php?model=page&amp;action=showlist&amp;admin"}" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>

<table class="admin_table">
    <thead>
        <tr>
            <th style="width:40px;" class="triable" onclick="order_by($(this),'page_id');"># {if isset($smarty.get.tri) and $smarty.get.tri == 'page_id'}<span class="tri_{$smarty.get.ord|default: 'asc'}"></span>{/if}</th>
            <th class="triable" onclick="order_by($(this),'page_title');">Titre {if isset($smarty.get.tri) and $smarty.get.tri == 'page_title'}<span class="tri_{$smarty.get.ord|default: 'asc'}"></span>{/if}</th>
            <th style="width:70px;">Actions</th>
        </tr>
    </thead>
    <tbody>
    {foreach $data.pages as $page}
        {assign var='id' value=$page.page_id}
        <tr {if $page@iteration is even}class="odd" {/if}>
            <td>{$id}</td>
            <td><p>{$page.page_title}</p></td>
            <td class="commands">
                <a href="index.php?model=page&amp;action=Editform&amp;pk={$id}&amp;admin" title="Editer" class="btn_edit"></a>
                <div onclick="delet($(this), 'Core','page',{$id});" title="Supprimer" class="btn_delete"></div>
            </td>
        </tr>
    {/foreach}   
    </tbody>
</table>

<div class="top_bottom_btns">
    <a style="float:left;margin-right:7px;" class="boutonW" href="index.php?model=page&amp;action=Createform&amp;admin" title="Créer une page">Créer une page</a>    
    {include file='core/templates/multipage.tpl' data=$data.multipage}
    <a style="float:right;" class="boutonW" href="{$smarty.server.HTTP_REFERER|default: "index.php?model=page&amp;action=showlist&amp;admin"}" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>