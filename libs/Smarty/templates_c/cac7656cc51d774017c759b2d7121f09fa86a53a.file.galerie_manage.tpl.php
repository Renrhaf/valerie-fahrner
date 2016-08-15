<?php /* Smarty version Smarty-3.1.7, created on 2012-06-12 11:42:24
         compiled from "modules/Galerie/templates/galerie_manage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1018578944fd70f000c2df1-67573559%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cac7656cc51d774017c759b2d7121f09fa86a53a' => 
    array (
      0 => 'modules/Galerie/templates/galerie_manage.tpl',
      1 => 1338806716,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1018578944fd70f000c2df1-67573559',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'config' => 0,
    'image' => 0,
    'id' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fd70f0024cc5',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fd70f0024cc5')) {function content_4fd70f0024cc5($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include '/homepages/23/d369665974/htdocs/valerie/libs/Smarty/plugins/modifier.truncate.php';
if (!is_callable('smarty_modifier_date_format')) include '/homepages/23/d369665974/htdocs/valerie/libs/Smarty/plugins/modifier.date_format.php';
?><div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="index.php?model=Home">Votre espace</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?module=Galerie&amp;model=Galerie&amp;action=showlist&amp;admin">Gestion des galeries</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?module=Galerie&amp;model=Galerie&amp;action=manage&amp;pk=<?php echo $_smarty_tpl->tpl_vars['data']->value['galerie']['galerie_id'];?>
&amp;admin">Gestion des images de la galerie</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<h3 class="page_title">Images : <?php echo $_smarty_tpl->tpl_vars['data']->value['galerie']['galerie_title'];?>
</h3>

<div class="top_bottom_btns">
    <form style="float:left;" enctype="multipart/form-data" action="index.php?module=Galerie&amp;model=Galerie&amp;action=upload&amp;pk=<?php echo $_smarty_tpl->tpl_vars['data']->value['galerie']['galerie_id'];?>
&amp;admin" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['max_file_size'];?>
">
        <input style="display:none;" name="file[]" type="file" multiple="multiple" onchange="$(this).parent('form').submit();" />
        <a style="float:left;" class="boutonW" title="Ajouter des images" onclick="$(this).prev('input').click();">Ajouter des images</a>
    </form>
    <?php echo $_smarty_tpl->getSubTemplate ('core/templates/multipage.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('data'=>$_smarty_tpl->tpl_vars['data']->value['multipage']), 0);?>

    <a style="float:right;" class="boutonW" href="index.php?module=Galerie&amp;model=Galerie&amp;action=showlist&amp;admin" title="Retour" >Retour</a>
    <div style="clear:both;"></div>
</div>

<table class="admin_table">
    <thead>
        <tr>
            <th title="Position" style="width:50px;" class="triable" onclick="order_by($(this),'image_order');">Pos.<?php if (isset($_GET['tri'])&&$_GET['tri']=='image_order'){?><span class="tri_<?php echo (($tmp = @$_GET['ord'])===null||$tmp==='' ? 'asc' : $tmp);?>
"></span><?php }?></th>
            <th style="width:<?php echo $_smarty_tpl->tpl_vars['config']->value['galerie']['thumb_width'];?>
px;">Miniature</th>
            <th style="width:175px;" class="triable" onclick="order_by($(this),'image_title');">Titre <?php if (isset($_GET['tri'])&&$_GET['tri']=='image_title'){?><span class="tri_<?php echo (($tmp = @$_GET['ord'])===null||$tmp==='' ? 'asc' : $tmp);?>
"></span><?php }?></th>
            <th class="triable" onclick="order_by($(this),'image_description');">Description <?php if (isset($_GET['tri'])&&$_GET['tri']=='image_description'){?><span class="tri_<?php echo (($tmp = @$_GET['ord'])===null||$tmp==='' ? 'asc' : $tmp);?>
"></span><?php }?></th>
            <th style="width:100px;" class="triable" onclick="order_by($(this),'image_created');">Créée le <?php if (isset($_GET['tri'])&&$_GET['tri']=='image_created'){?><span class="tri_<?php echo (($tmp = @$_GET['ord'])===null||$tmp==='' ? 'asc' : $tmp);?>
"></span><?php }?></th>
            <th style="width:70px;">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['image']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['image']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value){
$_smarty_tpl->tpl_vars['image']->_loop = true;
 $_smarty_tpl->tpl_vars['image']->iteration++;
?>
        <?php $_smarty_tpl->tpl_vars['id'] = new Smarty_variable($_smarty_tpl->tpl_vars['image']->value['image_id'], null, 0);?>
        <tr <?php if (!(1 & $_smarty_tpl->tpl_vars['image']->iteration)){?>class="odd" <?php }?>>
            <td><?php echo (($tmp = @$_smarty_tpl->tpl_vars['image']->value['image_order'])===null||$tmp==='' ? '' : $tmp);?>
</td>
            <td><a href="<?php echo $_smarty_tpl->tpl_vars['config']->value['galerie']['file_upload_dir'];?>
<?php echo $_smarty_tpl->tpl_vars['image']->value['image_url'];?>
" rel="shadowbox[<?php echo $_smarty_tpl->tpl_vars['data']->value['galerie']['galerie_title'];?>
]" title="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['image']->value['image_title'])===null||$tmp==='' ? '' : $tmp);?>
"><img style="display:block;" src='<?php echo $_smarty_tpl->tpl_vars['config']->value['galerie']['file_upload_dir'];?>
thumbnails/<?php echo $_smarty_tpl->tpl_vars['image']->value['image_url'];?>
' title="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['image']->value['image_title'])===null||$tmp==='' ? '' : $tmp);?>
" alt="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['image']->value['image_title'])===null||$tmp==='' ? '' : $tmp);?>
" /></a></td>
            <td><p><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['image']->value['image_title'],40);?>
</p></td>
            <td><p style="text-align:justify;"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['image']->value['image_description'])===null||$tmp==='' ? 'Non renseignée' : $tmp);?>
</p></td>
            <td><p><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['image']->value['image_created'],"%d/%m/%Y <br/>à %Hh%M");?>
<br/>par <a href="index.php?model=User&amp;pk=<?php echo $_smarty_tpl->tpl_vars['image']->value['user_id'];?>
&amp;admin" title="Consulter le profil"><?php echo $_smarty_tpl->tpl_vars['image']->value['user_fname'];?>
 <?php echo $_smarty_tpl->tpl_vars['image']->value['user_lname'];?>
</a></p></td>
            <td class="commands">
                <div onclick="activate($(this), 'Galerie','Image',<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
);" <?php if ($_smarty_tpl->tpl_vars['image']->value['image_active']){?>title="Désactiver" class="btn_active"<?php }else{ ?>title="Activer" class="btn_busy"<?php }?>></div>
                <a href="index.php?module=Galerie&amp;model=image&amp;action=Editform&amp;pk=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&amp;admin" title="Editer" class="btn_edit"></a>
                <div onclick="delet($(this), 'Galerie','Image',<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
);" title="Supprimer" class="btn_delete"></div>
            </td>
        </tr>
    <?php } ?>   
    </tbody>
</table>

<div class="top_bottom_btns">
    <form style="float:left;" enctype="multipart/form-data" action="index.php?module=Galerie&amp;model=Galerie&amp;action=upload&amp;pk=<?php echo $_smarty_tpl->tpl_vars['data']->value['galerie']['galerie_id'];?>
&amp;admin" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['max_file_size'];?>
">
        <input style="display:none;" name="file[]" type="file" multiple="multiple" onchange="$(this).parent('form').submit();" />
        <a style="float:left;" class="boutonW" title="Ajouter des images" onclick="$(this).prev('input').click();">Ajouter des images</a>
    </form>
    <?php echo $_smarty_tpl->getSubTemplate ('core/templates/multipage.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('data'=>$_smarty_tpl->tpl_vars['data']->value['multipage']), 0);?>

    <a style="float:right;" class="boutonW" href="index.php?module=Galerie&amp;model=Galerie&amp;action=showlist&amp;admin" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div><?php }} ?>