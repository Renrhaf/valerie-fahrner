<?php /* Smarty version Smarty-3.1.7, created on 2014-05-22 19:46:21
         compiled from "core/templates/user_list_admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:691551225537e37ed275ef7-80926748%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bdf90aba7779e79e05adf6576396e8739b59f8da' => 
    array (
      0 => 'core/templates/user_list_admin.tpl',
      1 => 1338806911,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '691551225537e37ed275ef7-80926748',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'user' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_537e37ed5016d',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_537e37ed5016d')) {function content_537e37ed5016d($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/homepages/23/d369665974/htdocs/valerie/libs/Smarty/plugins/modifier.date_format.php';
?><div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="index.php?model=Home">Votre espace</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?model=User&amp;action=showlist&amp;admin">Gestion des utilisateurs</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<h3 class="page_title">Gestion des utilisateurs</h3>

<div class="top_bottom_btns">
    <a style="float:left;" class="boutonW" href="index.php?model=User&amp;action=Createform&amp;admin" title="Créer un utilisateur">Créer un utilisateur</a>
    <?php echo $_smarty_tpl->getSubTemplate ('core/templates/multipage.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('data'=>$_smarty_tpl->tpl_vars['data']->value['multipage']), 0);?>

    <a style="float:right;" class="boutonW" href="<?php echo (($tmp = @$_SERVER['HTTP_REFERER'])===null||$tmp==='' ? "index.php?model=User&amp;action=showlist&amp;admin" : $tmp);?>
" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>
    
<table class="admin_table">
    <thead>
        <tr>
            <th style="width:40px;" class="triable" onclick="order_by($(this),'user_id');"># <?php if (isset($_GET['tri'])&&$_GET['tri']=='user_id'){?><span class="tri_<?php echo (($tmp = @$_GET['ord'])===null||$tmp==='' ? 'asc' : $tmp);?>
"></span><?php }?></th>
            <th style="width:100px;" class="triable" onclick="order_by($(this),'user_fname');">Prénom <?php if (isset($_GET['tri'])&&$_GET['tri']=='user_fname'){?><span class="tri_<?php echo (($tmp = @$_GET['ord'])===null||$tmp==='' ? 'asc' : $tmp);?>
"></span><?php }?></th>
            <th style="width:100px;" class="triable" onclick="order_by($(this),'user_lname');">Nom <?php if (isset($_GET['tri'])&&$_GET['tri']=='user_lname'){?><span class="tri_<?php echo (($tmp = @$_GET['ord'])===null||$tmp==='' ? 'asc' : $tmp);?>
"></span><?php }?></th>
            <th style="width:200px;" class="triable" onclick="order_by($(this),'user_mail');">Email <?php if (isset($_GET['tri'])&&$_GET['tri']=='user_mail'){?><span class="tri_<?php echo (($tmp = @$_GET['ord'])===null||$tmp==='' ? 'asc' : $tmp);?>
"></span><?php }?></th>
            <th>Site web</th>
            <th style="width:150px;" class="triable" onclick="order_by($(this),'profession_name');">Profession <?php if (isset($_GET['tri'])&&$_GET['tri']=='profession_name'){?><span class="tri_<?php echo (($tmp = @$_GET['ord'])===null||$tmp==='' ? 'asc' : $tmp);?>
"></span><?php }?></th>
            <th style="width:100px;" class="triable" onclick="order_by($(this),'user_created');">Créée le <?php if (isset($_GET['tri'])&&$_GET['tri']=='user_created'){?><span class="tri_<?php echo (($tmp = @$_GET['ord'])===null||$tmp==='' ? 'asc' : $tmp);?>
"></span><?php }?></th>
            <th style="width:70px;">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['user']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
$_smarty_tpl->tpl_vars['user']->_loop = true;
?>
        <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['user']->value['user_id'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['user']->value['user_fname'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['user']->value['user_lname'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['user']->value['user_mail'];?>
</td>
            <td><?php echo (($tmp = @$_smarty_tpl->tpl_vars['user']->value['user_website'])===null||$tmp==='' ? "non précisé" : $tmp);?>
</td>
            <td><?php echo (($tmp = @$_smarty_tpl->tpl_vars['user']->value['profession_name'])===null||$tmp==='' ? "non précisé" : $tmp);?>
</td>
            <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['user']->value['user_created'],"%d/%m/%Y <br/>à %Hh%M");?>
</td>
            <td class="commands">
                <div onclick="activate($(this), 'Core','User',<?php echo $_smarty_tpl->tpl_vars['user']->value['user_id'];?>
);" <?php if ($_smarty_tpl->tpl_vars['user']->value['user_active']){?>title="Désactiver" class="btn_active"<?php }else{ ?>title="Activer" class="btn_busy"<?php }?>></div>
                <a href="index.php?model=User&amp;action=Editform&amp;pk=<?php echo $_smarty_tpl->tpl_vars['user']->value['user_id'];?>
&amp;admin" title="Editer" class="btn_edit"></a>
                <div onclick="delet($(this), 'Core','User',<?php echo $_smarty_tpl->tpl_vars['user']->value['user_id'];?>
);" title="Supprimer" class="btn_delete"></div>
            </td>
        </tr>
    <?php } ?>   
    </tbody>
</table>

<div class="top_bottom_btns">
    <a style="float:left;" class="boutonW" href="index.php?model=User&amp;action=Createform&amp;admin" title="Créer un utilisateur">Créer un utilisateur</a>
    <?php echo $_smarty_tpl->getSubTemplate ('core/templates/multipage.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('data'=>$_smarty_tpl->tpl_vars['data']->value['multipage']), 0);?>

    <a style="float:right;" class="boutonW" href="<?php echo (($tmp = @$_SERVER['HTTP_REFERER'])===null||$tmp==='' ? "index.php?model=User&amp;action=showlist&amp;admin" : $tmp);?>
" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div><?php }} ?>