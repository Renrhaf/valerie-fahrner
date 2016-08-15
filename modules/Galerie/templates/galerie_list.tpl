<div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="">Accueil</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="galeries">Liste des galeries</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<h3 class="page_title">Liste des galeries</h3>

<div class="top_bottom_btns">
    {include file='core/templates/multipage.tpl' data=$data.multipage}
    <a style="float:right;" class="boutonW" href="{$smarty.server.HTTP_REFERER|default: "galeries"}" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>

<div id="galeries">
{foreach $data.galeries as $galerie}
    <div class="galerie" id="galerie_{$galerie.galerie_id}">
        <div class="galerie_head">
            {$galerie.galerie_title|truncate:15:'...':true}
            
            {if isset($smarty.session.user)}
            <div class="commands" style="position:absolute;top:5px;right:0px;">
                <div onclick="activate($(this), 'Galerie','Galerie',{$galerie.galerie_id});" {if $galerie.galerie_active}title="Désactiver" class="btn_active"{else}title="Activer" class="btn_busy"{/if}></div>
                <a href="index.php?module=Galerie&amp;model=Galerie&amp;action=Editform&amp;pk={$galerie.galerie_id}&amp;admin" title="Editer" class="btn_edit"></a>
                <div onclick="delet($(this), 'Galerie','Galerie',{$galerie.galerie_id}, $(this).parents('.galerie'));" title="Supprimer" class="btn_delete"></div>
            </div>
            {/if}
        </div>
        <div class="galerie_body">
            {if isset($galerie.image.image_url)}
                <a href="galeries/{$galerie.galerie_id}/{$galerie.urlrw}" title="Voir les images de la galerie"><img class="galerie_preview" src="{$config.galerie.file_upload_dir}preview/{$galerie.image.image_url}" width="225" height="225" /></a>
            {else}
                <div class="galerie_preview">La galerie ne contient pas d'images pour le moment</div>
            {/if}
        </div>
        <div class="galerie_footer">
            <a class="boutonW hasIcon" style="display:block; margin-top:4px;" href="galeries/{$galerie.galerie_id}/{$galerie.urlrw}" title="Voir les images de la galerie"><span class="show_icon"></span>Afficher la galerie</a>
        </div>
        <div style="clear:both;"></div>
    </div>
    {if $galerie@iteration % 4 eq 0}
    <div style="clear:both;"></div>
    {/if}
{/foreach} 
</div>
<div style="clear:both;"></div>

<div class="top_bottom_btns">
    {include file='core/templates/multipage.tpl' data=$data.multipage}
    <a style="float:right;" class="boutonW" href="{$smarty.server.HTTP_REFERER|default: "galeries"}" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>
