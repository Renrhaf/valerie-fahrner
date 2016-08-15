<?php /* Smarty version Smarty-3.1.7, created on 2012-06-04 13:49:01
         compiled from "core/templates/page_form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8475998054fb603eae56dd7-57624084%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ea65aec210c2f6b797dc495d7c20c43c5cb5afe5' => 
    array (
      0 => 'core/templates/page_form.tpl',
      1 => 1338806910,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8475998054fb603eae56dd7-57624084',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fb603eaefd84',
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fb603eaefd84')) {function content_4fb603eaefd84($_smarty_tpl) {?><div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="index.php?model=Home">Votre espace</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?model=page&amp;action=showlist&amp;admin">Gestion des pages</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?model=page&amp;admin<?php if (isset($_smarty_tpl->tpl_vars['data']->value['page_id'])){?>&amp;action=Editform&amp;pk=<?php echo $_smarty_tpl->tpl_vars['data']->value['page_id'];?>
<?php }else{ ?>&amp;action=Createform<?php }?>"><?php if (isset($_smarty_tpl->tpl_vars['data']->value['page_id'])){?>Modification d'une page<?php }else{ ?>Création d'une page<?php }?></a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<form action="index.php?model=page&amp;action=<?php if (isset($_smarty_tpl->tpl_vars['data']->value['page_id'])){?>update<?php }else{ ?>create<?php }?>&amp;admin" method="POST" class="formulaire" id="formulaire">
    <?php if (isset($_smarty_tpl->tpl_vars['data']->value['page_id'])){?>
        <h3>Modification d'une page</h3>
        <input type="hidden" id="page_id" name="page_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['page_id'];?>
" />
    <?php }else{ ?>
        <h3>Création d'une page</h3>
    <?php }?>
    
    <label for="page_title" required="required">Titre :</label>
    <input type="text" id="page_title" name="page_title" maxlength="64" class="validate[required]" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['page_title'])===null||$tmp==='' ? '' : $tmp);?>
" />
    
    <label for="page_content" required="required">Contenu :</label>
    <textarea id="page_content" name="page_content" class="validate[required] tinyMCE_hidden_textarea mceEditor" data-prompt-position="topRight:0,120">
        <?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['page_content'])===null||$tmp==='' ? '' : $tmp);?>

    </textarea>
    
    <input type="submit" value="Valider" />
    <a class="reset" href="<?php echo (($tmp = @$_SERVER['HTTP_REFERER'])===null||$tmp==='' ? "index.php?model=Page&amp;action=showlist&amp;admin" : $tmp);?>
" title="Annuler">Annuler</a>
    <div style="clear:both;"></div>
</form>	<?php }} ?>