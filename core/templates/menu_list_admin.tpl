<div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="index.php?model=Home">Votre espace</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?model=Menu&amp;action=showlist&amp;admin">Gestion du menu</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<h3 class="page_title">Gestion du menu</h3>

<div class="top_bottom_btns">
    <a style="float:left;margin-right:7px;" class="boutonW" href="index.php?model=Menu&amp;action=Createform&amp;admin" title="Ajouter un élément au menu">Ajouter un élément au menu</a>    
    {include file='core/templates/multipage.tpl' data=$data.multipage}
    <a style="float:right;" class="boutonW" href="{$smarty.server.HTTP_REFERER|default: "index.php?model=Menu&amp;action=showlist&amp;admin"}" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>

<table class="admin_table">
    <thead>
        <tr>
            <th style="width:40px;" class="triable" onclick="order_by($(this),'menu_block_id');"># {if isset($smarty.get.tri) and $smarty.get.tri == 'menu_block_id'}<span class="tri_{$smarty.get.ord|default: 'asc'}"></span>{/if}</th>
            <th class="triable" onclick="order_by($(this),'menu_block_title');">Titre {if isset($smarty.get.tri) and $smarty.get.tri == 'menu_block_title'}<span class="tri_{$smarty.get.ord|default: 'asc'}"></span>{/if}</th>
            <th>Destination</th>
            <th style="width:70px;">Actions</th>
        </tr>
    </thead>
    <tbody>
    {foreach $data.menus as $menu}
        {assign var='id' value=$menu.menu_block_id}
        <tr {if $menu@iteration is even}class="odd" {/if}>
            <td>{$id}</td>
            <td><p>{$menu.menu_block_title}</p></td>
            <td><a href="{$menu.menu_block_link}" title="Voir la cible">Voir la cible</a></td>
            <td class="commands">
                <a href="index.php?model=Menu&amp;action=Editform&amp;pk={$id}&amp;admin" title="Editer" class="btn_edit"></a>
                <div onclick="delet($(this), 'Core','Menu',{$id});" title="Supprimer" class="btn_delete"></div>
            </td>
        </tr>
    {/foreach}   
    </tbody>
</table>
    
<div class="top_bottom_btns">
    <a style="float:left;margin-right:7px;" class="boutonW" href="index.php?model=Menu&amp;action=Createform&amp;admin" title="Ajouter un élément au menu">Ajouter un élément au menu</a>    
    {include file='core/templates/multipage.tpl' data=$data.multipage}
    <a style="float:right;" class="boutonW" href="{$smarty.server.HTTP_REFERER|default: "index.php?model=Menu&amp;action=showlist&amp;admin"}" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>