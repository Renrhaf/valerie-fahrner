<div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="">Accueil</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="galeries">Liste des galeries</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="galeries/{$data.galerie.galerie_id}/{$data.urlrw}">Affichage d'une galerie</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<h3 class="page_title">{$data.galerie.galerie_title}</h3>

<p class="desc_note" style="margin-left:15px;margin-top:10px;">Description de la galerie :</p>
<p class="galerie_desc">{$data.galerie.galerie_description}</p>

<div class="top_bottom_btns">
    {include file='core/templates/multipage.tpl' data=$data.multipage}
    <a style="float:right;" class="boutonW" href="{$smarty.server.HTTP_REFERER|default: "galeries"}" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>
   
<p class="desc_note" style="text-align:center;">La description d'une image s'affichera lors du passage de la souris - Vous pouvez utiliser les flèches du clavier pour défiler les images</p>
    
<ul id="Gimage_list">
{foreach $data.images as $image}
    <li id="image_{$image.image_id}"><a href="{$config.galerie.file_upload_dir}{$image.image_url}" rel="prettyPhoto[{$data.galerie.galerie_title}]" title="{$image.image_description|default: ''}"><img src="{$config.galerie.file_upload_dir}thumbnails/{$image.image_url}" title="{$image.image_title|default: ''}" alt="{$image.image_title|default: ''}" /></a>
        {if isset($smarty.session.user)}
            <span class="commands">
                <div onclick="activate($(this), 'Galerie','Image',{$image.image_id});" {if $image.image_active}title="Désactiver" class="btn_active"{else}title="Activer" class="btn_busy"{/if}></div>
                <a href="index.php?module=Galerie&amp;model=image&amp;action=Editform&amp;pk={$image.image_id}&amp;admin" title="Editer" class="btn_edit"></a>
                <div onclick="delet($(this), 'Galerie','Image',{$image.image_id}, $(this).parents('li'));" title="Supprimer" class="btn_delete"></div>
            </span>
        {/if}
        <span class="image_desc">{$image.image_description}</span>
    </li>
{/foreach}
</ul>
<div style="clear:both;"></div>

<div id="image_desc">
    <h4>Description de l'image :</h4>
    <p>
    
    </p>
    <img src="modules/Galerie/images/quote.png" style="display:none; position:absolute; top:-10px; left:-10px;" />
    <img src="modules/Galerie/images/quote2.png" style="display:none; position:absolute; bottom:-10px; right:-10px;"/>
</div>

<div class="top_bottom_btns">
    {include file='core/templates/multipage.tpl' data=$data.multipage}
    <a style="float:right;" class="boutonW" href="{$smarty.server.HTTP_REFERER|default: "galeries"}" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>
    
<p class="last-update">dernière mise à jour : {$data.galerie.galerie_updated|date_format:"%d/%m/%Y à %Hh%M"}</p>