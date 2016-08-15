<?php /* Smarty version Smarty-3.1.7, created on 2012-10-08 21:38:44
         compiled from "modules/News/templates/news_form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:146345761950732bc4678597-89032639%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f83a0be2844b66a5d21ca9bebd5c1e26489a57b' => 
    array (
      0 => 'modules/News/templates/news_form.tpl',
      1 => 1338806750,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '146345761950732bc4678597-89032639',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'config' => 0,
    'id' => 0,
    'categ' => 0,
    'galerie' => 0,
    'word' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_50732bc4987a8',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50732bc4987a8')) {function content_50732bc4987a8($_smarty_tpl) {?><div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="index.php?model=Home">Votre espace</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?module=News&amp;model=News&amp;action=showlist&amp;admin">Gestion des actualités</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?module=News&amp;model=News&amp;admin<?php if (isset($_smarty_tpl->tpl_vars['data']->value['news_id'])){?>&amp;action=Editform&amp;pk=<?php echo $_smarty_tpl->tpl_vars['data']->value['news_id'];?>
<?php }else{ ?>&amp;action=Createform<?php }?>"><?php if (isset($_smarty_tpl->tpl_vars['data']->value['news_id'])){?>Modification d'une actualité<?php }else{ ?>Création d'une actualité<?php }?></a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<form enctype="multipart/form-data" action="index.php?module=News&amp;model=News&amp;action=<?php if (isset($_smarty_tpl->tpl_vars['data']->value['news_id'])){?>update<?php }else{ ?>create<?php }?>&amp;admin" method="POST" class="formulaire" id="formulaire">
    <?php if (isset($_smarty_tpl->tpl_vars['data']->value['news_id'])){?>
        <h3>Modification d'une actualité</h3>
        <input type="hidden" id="news_id" name="news_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['news_id'];?>
" />
    <?php }else{ ?>
        <h3>Création d'une actualité</h3>
    <?php }?>
    
    <label for="news_title" required="required">Titre :</label>
    <input type="text" id="news_title" name="news_title" maxlength="64" class="validate[required]" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['news_title'])===null||$tmp==='' ? '' : $tmp);?>
" />
    
    <label for="news_content" required="required">Contenu :</label>
    <textarea id="news_content" name="news_content" class="validate[required] tinyMCE_hidden_textarea mceEditor" data-prompt-position="topRight:0,120">
        <?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['news_content'])===null||$tmp==='' ? '' : $tmp);?>

    </textarea>
    
    <div style="clear:both"></div>
    <label for="news_image_url">Image :</label>
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $_smarty_tpl->tpl_vars['config']->value['news']['max_file_size'];?>
">
    <?php if (isset($_smarty_tpl->tpl_vars['data']->value['news_image_url'])){?>
    <div style="float:left; margin-bottom:10px;">
    <a href="<?php echo $_smarty_tpl->tpl_vars['config']->value['news']['file_upload_dir'];?>
<?php echo $_smarty_tpl->tpl_vars['data']->value['news_image_url'];?>
" rel="shadowbox"><img style="display:block;" src='<?php echo $_smarty_tpl->tpl_vars['config']->value['news']['file_upload_dir'];?>
thumbnails/<?php echo $_smarty_tpl->tpl_vars['data']->value['news_image_url'];?>
' /></a>
    <input type="hidden" name="news_image_url" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['news_image_url'];?>
" />
    </div>
    <label id="change_image" style="clear:none !important;float:left; margin-left:10px;" for="image">Changer d'image :</label>
    <input style="clear:none !important;float:left; margin-left:10px;" type="file" id="image" name="image" maxlength="255" class="validate[optional]" />
    <a class="boutonW" id="remove_news_image" style="margin-left:10px;font-size:12px;" title="Supprimer l'image">Supprimer l'image</a>
    <?php }else{ ?>
    <input type="file" id="image" name="image" maxlength="255" class="validate[optional]" />
    <?php }?>
    
    <label for="news_categ_id">Catégorie :</label>
    <select id="news_categ_id" name="news_categ_id">
        <option value="" selected="selected"></option>
        <?php  $_smarty_tpl->tpl_vars['categ'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['categ']->_loop = false;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['categs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['categ']->key => $_smarty_tpl->tpl_vars['categ']->value){
$_smarty_tpl->tpl_vars['categ']->_loop = true;
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['categ']->key;
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if (isset($_smarty_tpl->tpl_vars['data']->value['news_categ_id'])&&$_smarty_tpl->tpl_vars['data']->value['news_categ_id']==$_smarty_tpl->tpl_vars['id']->value){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['categ']->value;?>
</option>
        <?php } ?>
    </select>
    
    <label for="galerie_id">Galerie :</label>
    <select id="galerie_id" name="galerie_id">
        <option value="" selected="selected"></option>
        <?php  $_smarty_tpl->tpl_vars['galerie'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['galerie']->_loop = false;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['galeries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['galerie']->key => $_smarty_tpl->tpl_vars['galerie']->value){
$_smarty_tpl->tpl_vars['galerie']->_loop = true;
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['galerie']->key;
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if (isset($_smarty_tpl->tpl_vars['data']->value['galerie_id'])&&$_smarty_tpl->tpl_vars['data']->value['galerie_id']==$_smarty_tpl->tpl_vars['id']->value){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['galerie']->value;?>
</option>
        <?php } ?>
    </select>
    
    <div style="clear:both;"></div>
    <label for="new_keyword">Ajout de mot clé :</label>
    <div id="autocompleter">
    <input type="text" id="new_keyword" name="new_keyword" maxlength="32" autocomplete="off" />
    <ul id="suggestions"></ul>
    </div>
    
    <h5 style="clear:both;">Mots clés utilisés</h5>
    <ul id="used_keyword_list">
    <?php if (isset($_smarty_tpl->tpl_vars['data']->value['used_keywords'])){?>
        <?php  $_smarty_tpl->tpl_vars['word'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['word']->_loop = false;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['used_keywords']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['word']->key => $_smarty_tpl->tpl_vars['word']->value){
$_smarty_tpl->tpl_vars['word']->_loop = true;
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['word']->key;
?>
            <li id="k_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"><input type="hidden" name="keywords[]" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"/><?php echo $_smarty_tpl->tpl_vars['word']->value;?>
</li>
        <?php } ?>
    <?php }?>
    </ul>
    <div id="manageKeywords">
        <a class="boutonW" style="float:left;line-height:26px;">Supprimer</a>
    </div>
    
    <input type="submit" value="Valider" />
    <a class="reset" href="<?php echo (($tmp = @$_SERVER['HTTP_REFERER'])===null||$tmp==='' ? "index.php?module=News&amp;admin" : $tmp);?>
" title="Annuler">Annuler</a>
    <div style="clear:both;"></div>
</form>   


<script type="text/javascript">
    <?php if (isset($_smarty_tpl->tpl_vars['data']->value['news_id'])){?>
    $('#remove_news_image').click(function(){
        $.ajax({
            type: 'GET',
            url: 'index.php?module=News&model=News&action=RemoveImage&admin',
            data: 'pk='+<?php echo $_smarty_tpl->tpl_vars['data']->value['news_id'];?>
,
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
    <?php }?>
</script>
		<?php }} ?>