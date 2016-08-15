<div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="index.php?model=Home">Votre espace</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?module=Galerie&amp;model=Galerie&amp;action=showlist&amp;admin">Gestion des galeries</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?module=Galerie&amp;model=Galerie&amp;action=manage&amp;pk={$data.galerie.galerie_id}&amp;admin">Gestion des images de la galerie</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<h3 class="page_title">Images : {$data.galerie.galerie_title}</h3>

<div class="top_bottom_btns">
    <form style="float:left;" enctype="multipart/form-data" action="index.php?module=Galerie&amp;model=Galerie&amp;action=upload&amp;pk={$data.galerie.galerie_id}&amp;admin" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="{$data.max_file_size}">
        <input style="display:none;" name="file[]" type="file" multiple="multiple" onchange="$(this).parent('form').submit();" />
        <a style="float:left;" class="boutonW" title="Ajouter des images" onclick="$(this).prev('input').click();">Ajouter des images</a>
    </form>
    {include file='core/templates/multipage.tpl' data=$data.multipage}
    <a style="float:right;" class="boutonW" href="index.php?module=Galerie&amp;model=Galerie&amp;action=showlist&amp;admin" title="Retour" >Retour</a>
    <div style="clear:both;"></div>
</div>

<table class="admin_table">
    <thead>
        <tr>
            <th title="Position" style="width:50px;" class="triable" onclick="order_by($(this),'image_order');">Pos.{if isset($smarty.get.tri) and $smarty.get.tri == 'image_order'}<span class="tri_{$smarty.get.ord|default: 'asc'}"></span>{/if}</th>
            <th style="width:{$config.galerie.thumb_width}px;">Miniature</th>
            <th style="width:175px;" class="triable" onclick="order_by($(this),'image_title');">Titre {if isset($smarty.get.tri) and $smarty.get.tri == 'image_title'}<span class="tri_{$smarty.get.ord|default: 'asc'}"></span>{/if}</th>
            <th class="triable" onclick="order_by($(this),'image_description');">Description {if isset($smarty.get.tri) and $smarty.get.tri == 'image_description'}<span class="tri_{$smarty.get.ord|default: 'asc'}"></span>{/if}</th>
            <th style="width:100px;" class="triable" onclick="order_by($(this),'image_created');">Créée le {if isset($smarty.get.tri) and $smarty.get.tri == 'image_created'}<span class="tri_{$smarty.get.ord|default: 'asc'}"></span>{/if}</th>
            <th style="width:70px;">Actions</th>
        </tr>
    </thead>
    <tbody>
    {foreach $data.images as $image}
        {assign var='id' value=$image.image_id}
        <tr {if $image@iteration is even}class="odd" {/if}>
            <td>{$image.image_order|default: ""}</td>
            <td><a href="{$config.galerie.file_upload_dir}{$image.image_url}" rel="shadowbox[{$data.galerie.galerie_title}]" title="{$image.image_title|default: ''}"><img style="display:block;" src='{$config.galerie.file_upload_dir}thumbnails/{$image.image_url}' title="{$image.image_title|default: ''}" alt="{$image.image_title|default: ''}" /></a></td>
            <td><p>{$image.image_title|truncate:40}</p></td>
            <td><p style="text-align:justify;">{$image.image_description|default: 'Non renseignée'}</p></td>
            <td><p>{$image.image_created|date_format:"%d/%m/%Y <br/>à %Hh%M"}<br/>par <a href="index.php?model=User&amp;pk={$image.user_id}&amp;admin" title="Consulter le profil">{$image.user_fname} {$image.user_lname}</a></p></td>
            <td class="commands">
                <div onclick="activate($(this), 'Galerie','Image',{$id});" {if $image.image_active}title="Désactiver" class="btn_active"{else}title="Activer" class="btn_busy"{/if}></div>
                <a href="index.php?module=Galerie&amp;model=image&amp;action=Editform&amp;pk={$id}&amp;admin" title="Editer" class="btn_edit"></a>
                <div onclick="delet($(this), 'Galerie','Image',{$id});" title="Supprimer" class="btn_delete"></div>
            </td>
        </tr>
    {/foreach}   
    </tbody>
</table>

<div class="top_bottom_btns">
    <form style="float:left;" enctype="multipart/form-data" action="index.php?module=Galerie&amp;model=Galerie&amp;action=upload&amp;pk={$data.galerie.galerie_id}&amp;admin" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="{$data.max_file_size}">
        <input style="display:none;" name="file[]" type="file" multiple="multiple" onchange="$(this).parent('form').submit();" />
        <a style="float:left;" class="boutonW" title="Ajouter des images" onclick="$(this).prev('input').click();">Ajouter des images</a>
    </form>
    {include file='core/templates/multipage.tpl' data=$data.multipage}
    <a style="float:right;" class="boutonW" href="index.php?module=Galerie&amp;model=Galerie&amp;action=showlist&amp;admin" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>