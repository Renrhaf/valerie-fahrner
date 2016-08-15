<div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="index.php?model=Home">Votre espace</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?module=News&amp;model=News&amp;action=showlist&amp;admin">Gestion des actualités</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<h3 class="page_title">Gestion des actualités</h3>

<div class="top_bottom_btns">
    <a style="float:left;margin-right:7px;" class="boutonW" href="index.php?module=News&amp;model=News&amp;action=Createform&amp;admin" title="Créer une actualité">Créer une actualité</a>    
    {include file='core/templates/multipage.tpl' data=$data.multipage}
    <a style="float:right;" class="boutonW" href="{$smarty.server.HTTP_REFERER|default: "index.php?module=News&amp;model=News&amp;action=showlist&amp;admin"}" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>

<table class="admin_table">
    <thead>
        <tr>
            <th style="width:40px;" class="triable" onclick="order_by($(this),'news_id');"># {if isset($smarty.get.tri) and $smarty.get.tri == 'news_id'}<span class="tri_{$smarty.get.ord|default: 'asc'}"></span>{/if}</th>
            <th class="triable" onclick="order_by($(this),'news_title');">Titre {if isset($smarty.get.tri) and $smarty.get.tri == 'news_title'}<span class="tri_{$smarty.get.ord|default: 'asc'}"></span>{/if}</th>
            <th style="width:150px;" class="triable" onclick="order_by($(this),'news_categ_title');">Catégorie {if isset($smarty.get.tri) and $smarty.get.tri == 'news_categ_title'}<span class="tri_{$smarty.get.ord|default: 'asc'}"></span>{/if}</th>
            <th style="width:{$config.news.thumb_width}px;">Image</th>
            <th style="width:100px;">Galerie</th>
            <th style="width:100px;" class="triable" onclick="order_by($(this),'news_created');">Créée le {if isset($smarty.get.tri) and $smarty.get.tri == 'news_created'}<span class="tri_{$smarty.get.ord|default: 'asc'}"></span>{/if}</th>
            <th style="width:70px;">Actions</th>
        </tr>
    </thead>
    <tbody>
    {foreach $data.news as $news}
        {assign var='id' value=$news.news_id}
        <tr {if $news@iteration is even}class="odd" {/if}>
            <td>{$id}</td>
            <td><p>{$news.news_title}</p></td>
            <td><p>{$news.news_categ_title|default: 'Aucune catégorie spécifiée'}</p></td>
            {if isset($news.news_image_url)}
            <td><a href="{$config.news.file_upload_dir}{$news.news_image_url}" rel="shadowbox[images]" title="{$news.news_title|default: ''}"><img style="display:block;" src='{$config.news.file_upload_dir}thumbnails/{$news.news_image_url}' alt="{$news.news_title|default: ''}" title="{$news.news_title|default: ''}" /></a></td>
            {else}
            <td><p>Aucune image spécifiée</p></td>
            {/if}
            <td><p>{$news.galerie_title|default: 'Aucune galerie spécifiée'}</p></td>
            <td><p>{$news.news_created|date_format:"%d/%m/%Y <br/>à %Hh%M"}<br/>par <a href="index.php?model=User&amp;pk={$id}&amp;admin" title="Consulter le profil">{$news.user_fname} {$news.user_lname}</a></p></td>
            <td class="commands">
                <div onclick="activate($(this), 'News','News',{$id});" {if $news.news_active}title="Désactiver" class="btn_active"{else}title="Activer" class="btn_busy"{/if}></div>
                <a href="index.php?module=News&amp;model=News&amp;action=Editform&amp;pk={$id}&amp;admin" title="Editer" class="btn_edit"></a>
                <div onclick="delet($(this), 'News','News',{$id});" title="Supprimer" class="btn_delete"></div>
            </td>
        </tr>
    {/foreach}   
    </tbody>
</table>

<div class="top_bottom_btns">
    <a style="float:left;margin-right:7px;" class="boutonW" href="index.php?module=News&amp;model=News&amp;action=Createform&amp;admin" title="Créer une actualité">Créer une actualité</a>    
    {include file='core/templates/multipage.tpl' data=$data.multipage}
    <a style="float:right;" class="boutonW" href="{$smarty.server.HTTP_REFERER|default: "index.php?module=News&amp;model=News&amp;action=showlist&amp;admin"}" title="Retour">Retour</a> 
    <div style="clear:both;"></div>
</div>