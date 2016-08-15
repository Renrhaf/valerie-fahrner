<?php /* Smarty version Smarty-3.1.7, created on 2012-08-06 17:55:57
         compiled from "modules/Galerie/templates/image_form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1620197842501fe90d7eecb6-99401897%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0c7aa5e1810274a9aa06f8f103a4d2c47e6ec393' => 
    array (
      0 => 'modules/Galerie/templates/image_form.tpl',
      1 => 1338806716,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1620197842501fe90d7eecb6-99401897',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'config' => 0,
    'image' => 0,
    'id' => 0,
    'word' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_501fe90dc6b15',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_501fe90dc6b15')) {function content_501fe90dc6b15($_smarty_tpl) {?><?php if (!is_callable('smarty_function_math')) include '/homepages/23/d369665974/htdocs/valerie/libs/Smarty/plugins/function.math.php';
?><div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="index.php?model=Home">Votre espace</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?module=Galerie&amp;model=Galerie&amp;action=showlist&amp;admin">Gestion des galeries</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?module=Galerie&amp;model=Galerie&amp;action=manage&amp;pk=<?php echo $_smarty_tpl->tpl_vars['data']->value['galerie']['galerie_id'];?>
&amp;admin">Gestion des images de la galerie</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?module=Galerie&amp;model=Image&amp;action=Editform&amp;pk=<?php echo $_smarty_tpl->tpl_vars['data']->value['image_id'];?>
&amp;admin">Modification d'une image</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<form action="index.php?module=Galerie&amp;model=Image&amp;action=update&amp;admin" method="POST" class="formulaire" id="formulaire" style="position:relative;">
    <h3>Modification d'une image</h3>
    <input type="hidden" id="image_id" name="image_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['image_id'];?>
" />
    
    <div>
        <a href="<?php echo $_smarty_tpl->tpl_vars['config']->value['galerie']['file_upload_dir'];?>
<?php echo $_smarty_tpl->tpl_vars['data']->value['image_url'];?>
" rel="shadowbox" title="<?php echo $_smarty_tpl->tpl_vars['data']->value['image_title'];?>
">
            <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['galerie']['file_upload_dir'];?>
thumbnails/<?php echo $_smarty_tpl->tpl_vars['data']->value['image_url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['data']->value['image_title'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['data']->value['image_title'];?>
" style="position:absolute; top:-30px; right:15px; padding:1px; border:1px solid #CCCCCC;" />
        </a>
    </div>
    
    <label for="image_title">Titre :</label>
    <input type="text" id="image_title" name="image_title" maxlength="64" class="validate[optional]" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['image_title'])===null||$tmp==='' ? '' : $tmp);?>
" />
    
    <label for="image_description">Description :</label>
    <textarea id="image_description" name="image_description" maxlength="255" class="validate[optional]"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['image_description'])===null||$tmp==='' ? '' : $tmp);?>
</textarea>
    
    <label for="img_order">Position :</label>
    <select name="img_order" id="image_order">
        <option value="" <?php if (!isset($_smarty_tpl->tpl_vars['data']->value['image_order'])){?>selected="selected"<?php }?>></option>
        <option value="1" <?php if ($_smarty_tpl->tpl_vars['data']->value['image_order']==1){?>selected="selected"<?php }?>>En première position</option>
        <?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['image']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['order']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['image']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['image']->iteration=0;
 $_smarty_tpl->tpl_vars['image']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['orders']['total'] = $_smarty_tpl->tpl_vars['image']->total;
foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value){
$_smarty_tpl->tpl_vars['image']->_loop = true;
 $_smarty_tpl->tpl_vars['image']->iteration++;
 $_smarty_tpl->tpl_vars['image']->index++;
 $_smarty_tpl->tpl_vars['image']->first = $_smarty_tpl->tpl_vars['image']->index === 0;
 $_smarty_tpl->tpl_vars['image']->last = $_smarty_tpl->tpl_vars['image']->iteration === $_smarty_tpl->tpl_vars['image']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['orders']['first'] = $_smarty_tpl->tpl_vars['image']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['orders']['last'] = $_smarty_tpl->tpl_vars['image']->last;
?>
            <?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['orders']['first']){?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['image']->value['image_order'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['image']->value['image_url'];?>
" <?php if ($_smarty_tpl->tpl_vars['data']->value['image_order']==$_smarty_tpl->tpl_vars['image']->value['image_order']){?>selected="selected"<?php }?>>
                    <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['orders']['last']&&$_smarty_tpl->tpl_vars['data']->value['image_order']==$_smarty_tpl->tpl_vars['image']->value['image_order']){?>
                        En dernière position
                    <?php }else{ ?>
                        <?php echo $_smarty_tpl->tpl_vars['image']->value['image_order'];?>
 - Au niveau de <?php echo $_smarty_tpl->tpl_vars['image']->value['image_title'];?>

                    <?php }?>
                </option>
            <?php }?>
        <?php } ?>
        <?php if ($_smarty_tpl->tpl_vars['data']->value['image_order']!=$_smarty_tpl->getVariable('smarty')->value['foreach']['orders']['total']+1){?>
        <option value="<?php echo smarty_function_math(array('equation'=>$_smarty_tpl->getVariable('smarty')->value['foreach']['orders']['total']+1),$_smarty_tpl);?>
" <?php if ($_smarty_tpl->tpl_vars['data']->value['image_order']==$_smarty_tpl->getVariable('smarty')->value['foreach']['orders']['total']+1){?>selected="selected"<?php }?>>En dernière position</option>
        <?php }?>
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
    <a class="reset" href="<?php echo (($tmp = @$_SERVER['HTTP_REFERER'])===null||$tmp==='' ? "index.php?module=Galerie&amp;model=Galerie&amp;action=manage&amp;pk=".($_smarty_tpl->tpl_vars['data']->value['galerie']['galerie_id'])."&amp;admin" : $tmp);?>
" title="Annuler">Annuler</a>
    <div style="clear:both;"></div>
</form>   


<script type="text/javascript">
    $(document).ready(function(){
        var path = "<?php echo $_smarty_tpl->tpl_vars['config']->value['galerie']['file_upload_dir'];?>
thumbnails/";
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
<?php }} ?>