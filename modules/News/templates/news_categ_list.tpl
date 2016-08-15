<div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="">Accueil</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="news/categs">Liste des catégories d'actualités</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<h3 class="page_title">Catégories d'actualités</h3>

<div class="top_bottom_btns">
    {include file='core/templates/multipage.tpl' data=$data.multipage}
    <a style="float:right;" class="boutonW" href="{$smarty.server.HTTP_REFERER|default: "news/categs"}" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>
    
{foreach $data.news_categs as $news_categ}
<div class="news_categ">
    <div class="news_categ_head">
        {if isset($smarty.session.user)}
            {$news_categ.news_categ_title|truncate:33:'...':true}
        {else}
            {$news_categ.news_categ_title|truncate:38:'...':true}
        {/if}
    </div>
    <div class="news_categ_desc">{$news_categ.news_categ_description}</div>
    {if isset($smarty.session.user)}
    <div class="commands" style="position:absolute;top:5px;right:0px;">
        <a href="index.php?module=News&amp;model=Newscateg&amp;action=Editform&amp;pk={$news_categ.news_categ_id}&amp;admin" title="Editer" class="btn_edit"></a>
        <div onclick="delet($(this), 'News','Newscateg',{$news_categ.news_categ_id}, $(this).parents('.news_categ'));" title="Supprimer" class="btn_delete"></div>
    </div>
    {/if}
    <div class="news_categ_footer">
        <a class="boutonW hasIcon" style="float:left;margin-left:10px;" href="news/categ-{$news_categ.news_categ_id}/{$news_categ.urlrw}" title="Voir les news de cette catégorie"><span class="show_icon"></span>Voir les news de cette catégorie</a>
        <div style="clear:both;"></div>
    </div>
</div>
{/foreach}

<div class="top_bottom_btns">
    {include file='core/templates/multipage.tpl' data=$data.multipage}
    <a style="float:right;" class="boutonW" href="{$smarty.server.HTTP_REFERER|default: "news/categs"}" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>