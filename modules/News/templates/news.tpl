<div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="">Accueil</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="news">Liste des actualités</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="news/{$data.news.news_id}/{$data.urlrw}">Affichage d'une actualité</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>
    
<div itemscope itemtype="http://data-vocabulary.org/Event">
    <div id="news_title_s">
        <div {if isset($data.news.news_image_url)}id="news_t_bandeau"{else}id="news_t_bandeau_noimg"{/if}>
        <h3 class="page_title" itemprop="summary">{$data.news.news_title}</h3>
        <p>
            Publié le {$data.news.news_created|date_format:"%d/%m/%Y à %Hh%M"}
            {if isset($data.news.news_categ_id)}- Catégorie : <a href="news/categ-{$data.news.news_categ_id}/{$data.news.categ.urlrw}" title="Voir les actualités de cette catégorie">{$data.news.categ.news_categ_title}</a>{/if}
            <span style="float:right;margin-left:30px;">Dernière modification : {$data.news.news_updated|date_format:"%d/%m/%Y à %Hh%M"}</span>
        </p>
        </div>
        {if isset($data.news.news_image_url)}
        <div id="news_image">
            <a href="{$config.news.file_upload_dir}{$data.news.news_image_url}" rel="shadowbox" title="{$data.news.news_title}"><img src='{$config.news.file_upload_dir}thumbnails/{$data.news.news_image_url}' itemprop="photo" alt="{$data.news.news_title}" title="{$data.news.news_title}" /></a>
        </div>  
        {/if}
    </div>

    {if isset($data.news.images)}
    <div id="assoc_galerie">
        <ul>
        {foreach $data.news.images as $image name=imggal}
            {if !$smarty.foreach.imggal.last || ($smarty.foreach.imggal.last && !isset($data.news.news_image_url)) || ($smarty.foreach.imggal.last && $smarty.foreach.imggal.total < 8)}
            <li><a href="{$config.galerie.file_upload_dir}{$image.image_url}" rel="prettyPhoto[galerie]" title="{$image.image_description|default: ''}"><img src='{$config.galerie.file_upload_dir}thumbnails/{$image.image_url}' title="{$image.image_title|default: ''}" alt="{$image.image_title|default: ''}" /></a></li>
            {/if}
        {/foreach}
        </ul>
        <div style="clear:both;"></div>
        <a class="boutonW hasIcon" id="go_to_galerie" href="galeries/{$image.galerie_id}/{$data.news.galerie.urlrw}" title="Voir la galerie"><span class="show_icon"></span>Voir toutes les images de la galerie</a>
    </div>
    {/if}

    <div id="news_content_s" itemprop="description">
        {$data.news.news_content}
    </div>
</div>

<div class="top_bottom_btns">
    <a style="float:right;" class="boutonW" href="{$smarty.server.HTTP_REFERER|default: "news"}" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>