<div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="">Accueil</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="news">Liste des actualités</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<h3 class="page_title">Liste des actualités</h3>

<div class="top_bottom_btns">
    <span style="float:left;">{if isset($data.news_categ_title)}{$data.news_categ_title}{else}Toutes catégories confondues{/if}</span>
    {include file='core/templates/multipage.tpl' data=$data.multipage}
    <a style="float:right;" class="boutonW" href="{$smarty.server.HTTP_REFERER|default: "news"}" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>

{foreach $data.news as $news}
    <div class="news" id="news_{$news.news_id}">
            {if isset($news.news_image_url)}
                <img class="news_image" src="{$config.news.file_upload_dir}thumbnails/{$news.news_image_url}" />
            {else}
                {if isset($news.galerie_id)}
                <ul class="slideshow">
                    {foreach $news.images as $image}
                    <li><img class="news_image" src="{$config.galerie.file_upload_dir}thumbnails/{$image.image_url}" /></li>
                    {/foreach}
                </ul>
                {/if}
            {/if}
            
            <h4><a href="news/{$news.news_id}/{$news.urlrw}" title="Voir l'actualité">{$news.news_title}</a></h4>
            
            {if isset($smarty.session.user)}
            <div class="commands" style="position:absolute;top:5px;right:0px;">
                <div onclick="activate($(this), 'News','News',{$news.news_id});" {if $news.news_active}title="Désactiver" class="btn_active"{else}title="Activer" class="btn_busy"{/if}></div>
                <a href="index.php?module=News&amp;model=News&amp;action=Editform&amp;pk={$news.news_id}&amp;admin" title="Editer" class="btn_edit"></a>
                <div onclick="delet($(this), 'News','News',{$news.news_id}, $(this).parents('.news'));" title="Supprimer" class="btn_delete"></div>
            </div>
            {/if}
            <p class="news_desc">
            {$news.news_content} <a href="news/{$news.news_id}/{$news.urlrw}" title="Lire la suite">lire la suite</a>
            </p>
        <div class="news_footer">
            <span>
                Publié le {$news.news_created|date_format:"%d/%m/%Y à %Hh%M"}
                {if isset($news.news_categ_id)}- Catégorie : <a href="news/categ-{$news.news_categ_id}/{$news.categ_urlrw}" title="Voir les actualités de cette catégorie">{$news.news_categ_title}</a>{/if}
            </span>
        </div>
        <div style="clear:both;"></div>
    </div>
{/foreach}

<div class="top_bottom_btns">
    {include file='core/templates/multipage.tpl' data=$data.multipage}
    <a style="float:right;" class="boutonW" href="{$smarty.server.HTTP_REFERER|default: "news"}" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>
    
{literal}
<script type="text/javascript">
$(document).ready(function(){ slide(); });
    
function slide(){
    $('.slideshow').each(function(){
        var cur = $(this).find('.current');
        if(cur.length == 0){
            cur = $(this).find('li:first');
        }

        $(this).find('.current').removeClass('current');

        if($(cur).next('li').length != 0){
            $(cur).next('li').addClass('current');
        } else {
            $(this).find('li:first').addClass('current');
        }
    });
    setTimeout(slide, 1500);
}
</script>
{/literal}