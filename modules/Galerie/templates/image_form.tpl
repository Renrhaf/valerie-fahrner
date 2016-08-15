<div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="index.php?model=Home">Votre espace</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?module=Galerie&amp;model=Galerie&amp;action=showlist&amp;admin">Gestion des galeries</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?module=Galerie&amp;model=Galerie&amp;action=manage&amp;pk={$data.galerie.galerie_id}&amp;admin">Gestion des images de la galerie</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?module=Galerie&amp;model=Image&amp;action=Editform&amp;pk={$data.image_id}&amp;admin">Modification d'une image</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<form action="index.php?module=Galerie&amp;model=Image&amp;action=update&amp;admin" method="POST" class="formulaire" id="formulaire" style="position:relative;">
    <h3>Modification d'une image</h3>
    <input type="hidden" id="image_id" name="image_id" value="{$data.image_id}" />
    
    <div>
        <a href="{$config.galerie.file_upload_dir}{$data.image_url}" rel="shadowbox" title="{$data.image_title}">
            <img src="{$config.galerie.file_upload_dir}thumbnails/{$data.image_url}" title="{$data.image_title}" alt="{$data.image_title}" style="position:absolute; top:-30px; right:15px; padding:1px; border:1px solid #CCCCCC;" />
        </a>
    </div>
    
    <label for="image_title">Titre :</label>
    <input type="text" id="image_title" name="image_title" maxlength="64" class="validate[optional]" value="{$data.image_title|default: ''}" />
    
    <label for="image_description">Description :</label>
    <textarea id="image_description" name="image_description" maxlength="255" class="validate[optional]">{$data.image_description|default: ''}</textarea>
    
    <label for="img_order">Position :</label>
    <select name="img_order" id="image_order">
        <option value="" {if !isset($data.image_order)}selected="selected"{/if}></option>
        <option value="1" {if $data.image_order eq 1}selected="selected"{/if}>En première position</option>
        {foreach $data.order as $image name=orders}
            {if !$smarty.foreach.orders.first}
                <option value="{$image.image_order}" id="{$image.image_url}" {if $data.image_order eq $image.image_order}selected="selected"{/if}>
                    {if $smarty.foreach.orders.last && $data.image_order eq $image.image_order}
                        En dernière position
                    {else}
                        {$image.image_order} - Au niveau de {$image.image_title}
                    {/if}
                </option>
            {/if}
        {/foreach}
        {if $data.image_order neq $smarty.foreach.orders.total+1}
        <option value="{math equation=$smarty.foreach.orders.total+1}" {if $data.image_order eq $smarty.foreach.orders.total+1}selected="selected"{/if}>En dernière position</option>
        {/if}
    </select>
    <div id="img_pos_preview" style="position: absolute; top: 153px; right: 100px; padding: 1px; border: 1px solid rgb(204, 204, 204); width:31px; height:31px;">
        <img src="" width="31" height="31" />
    </div>
    
    <div style="clear:both;"></div>
    <label for="new_keyword">Ajout de mot clé :</label>
    <div id="autocompleter">
    <input type="text" id="new_keyword" name="new_keyword" maxlength="32" autocomplete="off" />
    <ul id="suggestions"></ul>
    </div>
    
    <h5 style="clear:both;">Mots clés utilisés</h5>
    <ul id="used_keyword_list">
    {if isset($data.used_keywords)}
        {foreach $data.used_keywords as $id => $word}
            <li id="k_{$id}"><input type="hidden" name="keywords[]" value="{$id}"/>{$word}</li>
        {/foreach}
    {/if}
    </ul>
    <div id="manageKeywords">
        <a class="boutonW" style="float:left;line-height:26px;">Supprimer</a>
    </div>
    
    <input type="submit" value="Valider" />
    <a class="reset" href="{$smarty.server.HTTP_REFERER|default: "index.php?module=Galerie&amp;model=Galerie&amp;action=manage&amp;pk={$data.galerie.galerie_id}&amp;admin"}" title="Annuler">Annuler</a>
    <div style="clear:both;"></div>
</form>   

{literal}
<script type="text/javascript">
    $(document).ready(function(){
        var path = "{/literal}{$config.galerie.file_upload_dir}{literal}thumbnails/";
        $('#img_pos_preview').hide();
        
        $('option','#image_order').each(function(){
            $(this).mouseenter(function(){
                var url = $(this).attr('id');
                if(url != null){
                    $("#img_pos_preview").find('img').attr('src',path+url);
                    $('#img_pos_preview').show();
                }
            }).mouseleave(function(){
                $('#img_pos_preview').hide();
            });
        });
    });
</script>
{/literal}