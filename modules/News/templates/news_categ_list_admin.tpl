<div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="index.php?model=Home">Votre espace</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?module=News&amp;model=Newscateg&amp;action=showlist&amp;admin">Gestion des catégories d'actualités</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<h3 class="page_title">Gestion des catégories d'actualités</h3>

<div class="top_bottom_btns">
    <a style="float:left;margin-right:7px;" class="boutonW" href="index.php?module=News&amp;model=Newscateg&amp;action=Createform&amp;admin" title="Créer une catégorie">Créer une catégorie</a>    
    {include file='core/templates/multipage.tpl' data=$data.multipage}
    <a style="float:right;" class="boutonW" href="{$smarty.server.HTTP_REFERER|default: "index.php?module=News&amp;model=Newscateg&amp;action=showlist&amp;admin"}" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>

<table class="admin_table">
    <thead>
        <tr>
            <th style="width:40px;" class="triable" onclick="order_by($(this),'news_categ_id');"># {if isset($smarty.get.tri) and $smarty.get.tri == 'news_categ_id'}<span class="tri_{$smarty.get.ord|default: 'asc'}"></span>{/if}</th>
            <th style="width:150px;" class="triable" onclick="order_by($(this),'news_categ_title');">Titre {if isset($smarty.get.tri) and $smarty.get.tri == 'news_categ_title'}<span class="tri_{$smarty.get.ord|default: 'asc'}"></span>{/if}</th>
            <th class="triable" onclick="order_by($(this),'news_categ_description');">Catégorie {if isset($smarty.get.tri) and $smarty.get.tri == 'news_categ_description'}<span class="tri_{$smarty.get.ord|default: 'asc'}"></span>{/if}</th>
            <th style="width:70px;">Actions</th>
        </tr>
    </thead>
    <tbody>
    {foreach $data.news_categs as $news_categ}
        {assign var='id' value=$news_categ.news_categ_id}
        <tr {if $news_categ@iteration is even}class="odd" {/if}>
            <td>{$id}</td>
            <td><p>{$news_categ.news_categ_title}</p></td>
            <td><p>{$news_categ.news_categ_description}</p></td>
            <td class="commands">
                <a href="index.php?module=News&amp;model=Newscateg&amp;action=Editform&amp;pk={$id}&amp;admin" title="Editer" class="btn_edit"></a>
                <div onclick="delet($(this), 'News','Newscateg',{$id});" title="Supprimer" class="btn_delete"></div>
            </td>
        </tr>
    {/foreach}   
    </tbody>
</table>

<div class="top_bottom_btns">
    <a style="float:left;margin-right:7px;" class="boutonW" href="index.php?module=News&amp;model=Newscateg&amp;action=Createform&amp;admin" title="Créer une catégorie">Créer une catégorie</a>    
    {include file='core/templates/multipage.tpl' data=$data.multipage}
    <a style="float:right;" class="boutonW" href="{$smarty.server.HTTP_REFERER|default: "index.php?module=News&amp;model=Newscateg&amp;action=showlist&amp;admin"}" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>