<div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="index.php?model=Home">Votre espace</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?module=News&amp;model=News&amp;action=showlist&amp;admin">Gestion des actualités</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?module=News&amp;model=News&amp;admin{if isset($data.news_id)}&amp;action=Editform&amp;pk={$data.news_id}{else}&amp;action=Createform{/if}">{if isset($data.news_id)}Modification d'une actualité{else}Création d'une actualité{/if}</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<form enctype="multipart/form-data" action="index.php?module=News&amp;model=News&amp;action={if isset($data.news_id)}update{else}create{/if}&amp;admin" method="POST" class="formulaire" id="formulaire">
    {if isset($data.news_id)}
        <h3>Modification d'une actualité</h3>
        <input type="hidden" id="news_id" name="news_id" value="{$data.news_id}" />
    {else}
        <h3>Création d'une actualité</h3>
    {/if}
    
    <label for="news_title" required="required">Titre :</label>
    <input type="text" id="news_title" name="news_title" maxlength="64" class="validate[required]" value="{$data.news_title|default: ''}" />
    
    <label for="news_content" required="required">Contenu :</label>
    <textarea id="news_content" name="news_content" class="validate[required] tinyMCE_hidden_textarea mceEditor" data-prompt-position="topRight:0,120">
        {$data.news_content|default: ''}
    </textarea>
    
    <div style="clear:both"></div>
    <label for="news_image_url">Image :</label>
    <input type="hidden" name="MAX_FILE_SIZE" value="{$config.news.max_file_size}">
    {if isset($data.news_image_url)}
    <div style="float:left; margin-bottom:10px;">
    <a href="{$config.news.file_upload_dir}{$data.news_image_url}" rel="shadowbox"><img style="display:block;" src='{$config.news.file_upload_dir}thumbnails/{$data.news_image_url}' /></a>
    <input type="hidden" name="news_image_url" value="{$data.news_image_url}" />
    </div>
    <label id="change_image" style="clear:none !important;float:left; margin-left:10px;" for="image">Changer d'image :</label>
    <input style="clear:none !important;float:left; margin-left:10px;" type="file" id="image" name="image" maxlength="255" class="validate[optional]" />
    <a class="boutonW" id="remove_news_image" style="margin-left:10px;font-size:12px;" title="Supprimer l'image">Supprimer l'image</a>
    {else}
    <input type="file" id="image" name="image" maxlength="255" class="validate[optional]" />
    {/if}
    
    <label for="news_categ_id">Catégorie :</label>
    <select id="news_categ_id" name="news_categ_id">
        <option value="" selected="selected"></option>
        {foreach $data.categs as $id => $categ}
            <option value="{$id}" {if isset($data.news_categ_id) and $data.news_categ_id == $id}selected="selected"{/if}>{$categ}</option>
        {/foreach}
    </select>
    
    <label for="galerie_id">Galerie :</label>
    <select id="galerie_id" name="galerie_id">
        <option value="" selected="selected"></option>
        {foreach $data.galeries as $id => $galerie}
            <option value="{$id}" {if isset($data.galerie_id) and $data.galerie_id == $id}selected="selected"{/if}>{$galerie}</option>
        {/foreach}
    </select>
    
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
    <a class="reset" href="{$smarty.server.HTTP_REFERER|default: "index.php?module=News&amp;admin"}" title="Annuler">Annuler</a>
    <div style="clear:both;"></div>
</form>   

{literal}
<script type="text/javascript">
    {/literal}{if isset($data.news_id)}{literal}
    $('#remove_news_image').click(function(){
        $.ajax({
            type: 'GET',
            url: 'index.php?module=News&model=News&action=RemoveImage&admin',
            data: 'pk='+{/literal}{$data.news_id}{literal},
            success: function(data){
                if(data == 1){
                    $('#change_image').prev('div').remove();
                    $('#change_image').remove();
                    $('#remove_news_image').remove();
                } else {
                    var obj = $.parseJSON(data);
                    alert(obj.error);
                }
            }
        });
    });
    {/literal}{/if}{literal}
</script>
{/literal}		