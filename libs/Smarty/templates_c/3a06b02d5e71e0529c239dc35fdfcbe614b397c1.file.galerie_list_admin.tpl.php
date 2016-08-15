<?php /* Smarty version Smarty-3.1.7, created on 2012-06-12 11:42:07
         compiled from "modules/Galerie/templates/galerie_list_admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19835644864fad9c03704881-95122802%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3a06b02d5e71e0529c239dc35fdfcbe614b397c1' => 
    array (
      0 => 'modules/Galerie/templates/galerie_list_admin.tpl',
      1 => 1338806716,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19835644864fad9c03704881-95122802',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fad9c038fd46',
  'variables' => 
  array (
    'data' => 0,
    'galerie' => 0,
    'id' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fad9c038fd46')) {function content_4fad9c038fd46($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/homepages/23/d369665974/htdocs/valerie/libs/Smarty/plugins/modifier.date_format.php';
?><div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="index.php?model=Home">Votre espace</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?module=Galerie&amp;model=Galerie&amp;action=showlist&amp;admin">Gestion des galeries</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<h3 class="page_title">Gestion des galeries</h3>

<div class="top_bottom_btns">
    <a style="float:left;margin-right:7px;" class="boutonW" href="index.php?module=Galerie&amp;model=Galerie&amp;action=Createform&amp;admin" title="Créer une galerie">Créer une galerie</a>    
    <?php echo $_smarty_tpl->getSubTemplate ('core/templates/multipage.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('data'=>$_smarty_tpl->tpl_vars['data']->value['multipage']), 0);?>

    <a style="float:right;" class="boutonW" href="<?php echo (($tmp = @$_SERVER['HTTP_REFERER'])===null||$tmp==='' ? "index.php?module=Galerie&amp;model=Galerie&amp;action=showlist&amp;admin" : $tmp);?>
" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>

<table class="admin_table">
    <thead>
        <tr>
            <th style="width:40px;" class="triable" onclick="order_by($(this),'galerie_id');"># <?php if (isset($_GET['tri'])&&$_GET['tri']=='galerie_id'){?><span class="tri_<?php echo (($tmp = @$_GET['ord'])===null||$tmp==='' ? 'asc' : $tmp);?>
"></span><?php }?></th>
            <th style="width:150px;" class="triable" onclick="order_by($(this),'galerie_title');">Titre <?php if (isset($_GET['tri'])&&$_GET['tri']=='galerie_title'){?><span class="tri_<?php echo (($tmp = @$_GET['ord'])===null||$tmp==='' ? 'asc' : $tmp);?>
"></span><?php }?></th>
            <th class="triable" onclick="order_by($(this),'galerie_description');">Description <?php if (isset($_GET['tri'])&&$_GET['tri']=='galerie_description'){?><span class="tri_<?php echo (($tmp = @$_GET['ord'])===null||$tmp==='' ? 'asc' : $tmp);?>
"></span><?php }?></th>
            <th style="width:100px;" class="triable" onclick="order_by($(this),'galerie_created');">Créée le <?php if (isset($_GET['tri'])&&$_GET['tri']=='galerie_created'){?><span class="tri_<?php echo (($tmp = @$_GET['ord'])===null||$tmp==='' ? 'asc' : $tmp);?>
"></span><?php }?></th>
            <th style="width:100px;">Images</th>
            <th style="width:70px;">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php  $_smarty_tpl->tpl_vars['galerie'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['galerie']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['galeries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['galerie']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['galerie']->key => $_smarty_tpl->tpl_vars['galerie']->value){
$_smarty_tpl->tpl_vars['galerie']->_loop = true;
 $_smarty_tpl->tpl_vars['galerie']->iteration++;
?>
        <?php $_smarty_tpl->tpl_vars['id'] = new Smarty_variable($_smarty_tpl->tpl_vars['galerie']->value['galerie_id'], null, 0);?>
        <tr <?php if (!(1 & $_smarty_tpl->tpl_vars['galerie']->iteration)){?>class="odd" <?php }?>>
            <td><?php echo $_smarty_tpl->tpl_vars['id']->value;?>
</td>
            <td><p><?php echo $_smarty_tpl->tpl_vars['galerie']->value['galerie_title'];?>
</p></td>
            <td><p style="text-align:justify;"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['galerie']->value['galerie_description'])===null||$tmp==='' ? "non renseignée" : $tmp);?>
</p></td>
            <td><p><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['galerie']->value['galerie_created'],"%d/%m/%Y <br/>à %Hh%M");?>
<br/>par <a href="index.php?model=User&amp;pk=<?php echo $_smarty_tpl->tpl_vars['galerie']->value['user_id'];?>
&amp;admin" title="Consulter le profil"><?php echo $_smarty_tpl->tpl_vars['galerie']->value['user_fname'];?>
 <?php echo $_smarty_tpl->tpl_vars['galerie']->value['user_lname'];?>
</a></p></td>
            <td><p><a class="boutonW" href="index.php?module=Galerie&amp;model=Galerie&amp;pk=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&amp;action=manage&amp;admin" title="Gérer les images">Gérer les images</a></p></td>
            <td class="commands">
                <div onclick="activate($(this), 'Galerie','Galerie',<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
);" <?php if ($_smarty_tpl->tpl_vars['galerie']->value['galerie_active']){?>title="Désactiver" class="btn_active"<?php }else{ ?>title="Activer" class="btn_busy"<?php }?>></div>
                <a href="index.php?module=Galerie&amp;model=Galerie&amp;action=Editform&amp;pk=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&amp;admin" title="Editer" class="btn_edit"></a>
                <div onclick="delet($(this), 'Galerie','Galerie',<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
);" title="Supprimer" class="btn_delete"></div>
            </td>
        </tr>
    <?php } ?>   
    </tbody>
</table>

<div class="top_bottom_btns">
    <a style="float:left;margin-right:7px;" class="boutonW" href="index.php?module=Galerie&amp;model=Galerie&amp;action=Createform&amp;admin" title="Créer une galerie">Créer une galerie</a>
    <?php echo $_smarty_tpl->getSubTemplate ('core/templates/multipage.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('data'=>$_smarty_tpl->tpl_vars['data']->value['multipage']), 0);?>

    <a style="float:right;" class="boutonW" href="<?php echo (($tmp = @$_SERVER['HTTP_REFERER'])===null||$tmp==='' ? "index.php?module=Galerie&amp;model=Galerie&amp;action=showlist&amp;admin" : $tmp);?>
" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div><?php }} ?>