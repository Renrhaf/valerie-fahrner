<?php /* Smarty version Smarty-3.1.7, created on 2014-03-30 18:16:19
         compiled from "core/templates/menu_form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18516472744fb218fc4b7793-06250804%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f94de43c88a8b5d4f8a039d5cc319468e8c59392' => 
    array (
      0 => 'core/templates/menu_form.tpl',
      1 => 1338806909,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18516472744fb218fc4b7793-06250804',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fb218fc55844',
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fb218fc55844')) {function content_4fb218fc55844($_smarty_tpl) {?><div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="index.php?model=Home">Votre espace</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?model=Menu&amp;action=showlist&amp;admin">Gestion du menu</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?model=Menu&amp;admin<?php if (isset($_smarty_tpl->tpl_vars['data']->value['menu_block_id'])){?>&amp;action=Editform&amp;pk=<?php echo $_smarty_tpl->tpl_vars['data']->value['menu_block_id'];?>
<?php }else{ ?>&amp;action=Createform<?php }?>"><?php if (isset($_smarty_tpl->tpl_vars['data']->value['page_id'])){?>Modification d'un élément du menu<?php }else{ ?>Ajout d'un élément au menu<?php }?></a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<form action="index.php?model=Menu&amp;action=<?php if (isset($_smarty_tpl->tpl_vars['data']->value['menu_block_id'])){?>Update<?php }else{ ?>Create<?php }?>&amp;admin" method="POST" class="formulaire" id="formulaire">
    <?php if (isset($_smarty_tpl->tpl_vars['data']->value['menu_block_id'])){?>
        <h3>Modification d'un élément du menu</h3>
        <input type="hidden" id="menu_block_id" name="menu_block_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['menu_block_id'];?>
" />
    <?php }else{ ?>
        <h3>Ajout d'un élément au menu</h3>
    <?php }?>
    
    <label for="menu_block_title" required="required">Titre :</label>
    <input type="text" id="menu_block_title" name="menu_block_title" maxlength="64" class="validate[required]" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['menu_block_title'])===null||$tmp==='' ? '' : $tmp);?>
" />
    
    <label for="menu_block_link" required="required">Destination :</label>
    <input type="text" id="menu_block_link" name="menu_block_link" maxlength="64" class="validate[required]" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['menu_block_link'])===null||$tmp==='' ? '' : $tmp);?>
" />
    
    <input type="submit" value="Valider" />
    <a class="reset" href="<?php echo (($tmp = @$_SERVER['HTTP_REFERER'])===null||$tmp==='' ? "index.php?model=Menu&amp;action=showlist&amp;admin" : $tmp);?>
" title="Annuler">Annuler</a>
    <div style="clear:both;"></div>
</form>   


		<?php }} ?>