<?php /* Smarty version Smarty-3.1.7, created on 2013-02-03 23:12:37
         compiled from "modules/Galerie/templates/galerie_form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:165754768510ee0d51efd98-74411660%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8698172d3b62c70c2e8db8d0f057b98136d931f8' => 
    array (
      0 => 'modules/Galerie/templates/galerie_form.tpl',
      1 => 1338806715,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '165754768510ee0d51efd98-74411660',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'id' => 0,
    'word' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_510ee0d542079',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_510ee0d542079')) {function content_510ee0d542079($_smarty_tpl) {?><div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="index.php?model=Home">Votre espace</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?module=Galerie&amp;model=Galerie&amp;action=showlist&amp;admin">Gestion des galeries</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?module=Galerie&amp;model=Galerie&amp;admin<?php if (isset($_smarty_tpl->tpl_vars['data']->value['galerie_id'])){?>&amp;action=Editform&amp;pk=<?php echo $_smarty_tpl->tpl_vars['data']->value['galerie_id'];?>
<?php }else{ ?>&amp;action=Createform<?php }?>"><?php if (isset($_smarty_tpl->tpl_vars['data']->value['galerie_id'])){?>Modification de la galerie : <?php echo $_smarty_tpl->tpl_vars['data']->value['galerie_title'];?>
<?php }else{ ?>Création d'une galerie<?php }?></a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<form action="index.php?module=Galerie&amp;model=Galerie&amp;action=<?php if (isset($_smarty_tpl->tpl_vars['data']->value['galerie_id'])){?>update<?php }else{ ?>create<?php }?>&amp;admin" method="POST" class="formulaire" id="formulaire">
    <?php if (isset($_smarty_tpl->tpl_vars['data']->value['galerie_id'])){?>
        <h3>Modification d'une galerie</h3>
        <input type="hidden" id="galerie_id" name="galerie_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['galerie_id'];?>
" />
    <?php }else{ ?>
        <h3>Création d'une galerie</h3>
    <?php }?>
    
    <label for="galerie_title" required="required">Titre :</label>
    <input type="text" id="galerie_title" name="galerie_title" maxlength="64" class="validate[required]" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['galerie_title'])===null||$tmp==='' ? '' : $tmp);?>
" />
    
    <label for="galerie_description">Description :</label>
    <textarea id="galerie_description" name="galerie_description" maxlength="255"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['galerie_description'])===null||$tmp==='' ? '' : $tmp);?>
</textarea>
    
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
    <a class="reset" href="<?php echo (($tmp = @$_SERVER['HTTP_REFERER'])===null||$tmp==='' ? "index.php?module=Galerie&amp;admin" : $tmp);?>
" title="Annuler">Annuler</a>
    <div style="clear:both;"></div>
</form><?php }} ?>