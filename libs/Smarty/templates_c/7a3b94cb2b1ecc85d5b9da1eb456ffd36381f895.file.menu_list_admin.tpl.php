<?php /* Smarty version Smarty-3.1.7, created on 2013-02-03 23:42:52
         compiled from "core/templates/menu_list_admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9074338374fb218f9256a13-38912236%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7a3b94cb2b1ecc85d5b9da1eb456ffd36381f895' => 
    array (
      0 => 'core/templates/menu_list_admin.tpl',
      1 => 1338806909,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9074338374fb218f9256a13-38912236',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fb218f97dbba',
  'variables' => 
  array (
    'data' => 0,
    'menu' => 0,
    'id' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fb218f97dbba')) {function content_4fb218f97dbba($_smarty_tpl) {?><div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="index.php?model=Home">Votre espace</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?model=Menu&amp;action=showlist&amp;admin">Gestion du menu</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<h3 class="page_title">Gestion du menu</h3>

<div class="top_bottom_btns">
    <a style="float:left;margin-right:7px;" class="boutonW" href="index.php?model=Menu&amp;action=Createform&amp;admin" title="Ajouter un élément au menu">Ajouter un élément au menu</a>    
    <?php echo $_smarty_tpl->getSubTemplate ('core/templates/multipage.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('data'=>$_smarty_tpl->tpl_vars['data']->value['multipage']), 0);?>

    <a style="float:right;" class="boutonW" href="<?php echo (($tmp = @$_SERVER['HTTP_REFERER'])===null||$tmp==='' ? "index.php?model=Menu&amp;action=showlist&amp;admin" : $tmp);?>
" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>

<table class="admin_table">
    <thead>
        <tr>
            <th style="width:40px;" class="triable" onclick="order_by($(this),'menu_block_id');"># <?php if (isset($_GET['tri'])&&$_GET['tri']=='menu_block_id'){?><span class="tri_<?php echo (($tmp = @$_GET['ord'])===null||$tmp==='' ? 'asc' : $tmp);?>
"></span><?php }?></th>
            <th class="triable" onclick="order_by($(this),'menu_block_title');">Titre <?php if (isset($_GET['tri'])&&$_GET['tri']=='menu_block_title'){?><span class="tri_<?php echo (($tmp = @$_GET['ord'])===null||$tmp==='' ? 'asc' : $tmp);?>
"></span><?php }?></th>
            <th>Destination</th>
            <th style="width:70px;">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php  $_smarty_tpl->tpl_vars['menu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['menus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['menu']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['menu']->key => $_smarty_tpl->tpl_vars['menu']->value){
$_smarty_tpl->tpl_vars['menu']->_loop = true;
 $_smarty_tpl->tpl_vars['menu']->iteration++;
?>
        <?php $_smarty_tpl->tpl_vars['id'] = new Smarty_variable($_smarty_tpl->tpl_vars['menu']->value['menu_block_id'], null, 0);?>
        <tr <?php if (!(1 & $_smarty_tpl->tpl_vars['menu']->iteration)){?>class="odd" <?php }?>>
            <td><?php echo $_smarty_tpl->tpl_vars['id']->value;?>
</td>
            <td><p><?php echo $_smarty_tpl->tpl_vars['menu']->value['menu_block_title'];?>
</p></td>
            <td><a href="<?php echo $_smarty_tpl->tpl_vars['menu']->value['menu_block_link'];?>
" title="Voir la cible">Voir la cible</a></td>
            <td class="commands">
                <a href="index.php?model=Menu&amp;action=Editform&amp;pk=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&amp;admin" title="Editer" class="btn_edit"></a>
                <div onclick="delet($(this), 'Core','Menu',<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
);" title="Supprimer" class="btn_delete"></div>
            </td>
        </tr>
    <?php } ?>   
    </tbody>
</table>
    
<div class="top_bottom_btns">
    <a style="float:left;margin-right:7px;" class="boutonW" href="index.php?model=Menu&amp;action=Createform&amp;admin" title="Ajouter un élément au menu">Ajouter un élément au menu</a>    
    <?php echo $_smarty_tpl->getSubTemplate ('core/templates/multipage.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('data'=>$_smarty_tpl->tpl_vars['data']->value['multipage']), 0);?>

    <a style="float:right;" class="boutonW" href="<?php echo (($tmp = @$_SERVER['HTTP_REFERER'])===null||$tmp==='' ? "index.php?model=Menu&amp;action=showlist&amp;admin" : $tmp);?>
" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div><?php }} ?>