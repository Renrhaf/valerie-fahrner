<?php /* Smarty version Smarty-3.1.7, created on 2012-06-04 12:47:30
         compiled from "modules/Galerie/templates/galerie_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8296601614fad71e06bbc87-32473508%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fdd2be7162f881407bf9fea5a0fae82ffeab1b80' => 
    array (
      0 => 'modules/Galerie/templates/galerie_list.tpl',
      1 => 1338806715,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8296601614fad71e06bbc87-32473508',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fad71e0775e8',
  'variables' => 
  array (
    'data' => 0,
    'galerie' => 0,
    'config' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fad71e0775e8')) {function content_4fad71e0775e8($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include '/homepages/23/d369665974/htdocs/valerie/libs/Smarty/plugins/modifier.truncate.php';
?><div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="">Accueil</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="galeries">Liste des galeries</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<h3 class="page_title">Liste des galeries</h3>

<div class="top_bottom_btns">
    <?php echo $_smarty_tpl->getSubTemplate ('core/templates/multipage.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('data'=>$_smarty_tpl->tpl_vars['data']->value['multipage']), 0);?>

    <a style="float:right;" class="boutonW" href="<?php echo (($tmp = @$_SERVER['HTTP_REFERER'])===null||$tmp==='' ? "galeries" : $tmp);?>
" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>

<div id="galeries">
<?php  $_smarty_tpl->tpl_vars['galerie'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['galerie']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['galeries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['galerie']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['galerie']->key => $_smarty_tpl->tpl_vars['galerie']->value){
$_smarty_tpl->tpl_vars['galerie']->_loop = true;
 $_smarty_tpl->tpl_vars['galerie']->iteration++;
?>
    <div class="galerie" id="galerie_<?php echo $_smarty_tpl->tpl_vars['galerie']->value['galerie_id'];?>
">
        <div class="galerie_head">
            <?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['galerie']->value['galerie_title'],15,'...',true);?>

            
            <?php if (isset($_SESSION['user'])){?>
            <div class="commands" style="position:absolute;top:5px;right:0px;">
                <div onclick="activate($(this), 'Galerie','Galerie',<?php echo $_smarty_tpl->tpl_vars['galerie']->value['galerie_id'];?>
);" <?php if ($_smarty_tpl->tpl_vars['galerie']->value['galerie_active']){?>title="Désactiver" class="btn_active"<?php }else{ ?>title="Activer" class="btn_busy"<?php }?>></div>
                <a href="index.php?module=Galerie&amp;model=Galerie&amp;action=Editform&amp;pk=<?php echo $_smarty_tpl->tpl_vars['galerie']->value['galerie_id'];?>
&amp;admin" title="Editer" class="btn_edit"></a>
                <div onclick="delet($(this), 'Galerie','Galerie',<?php echo $_smarty_tpl->tpl_vars['galerie']->value['galerie_id'];?>
, $(this).parents('.galerie'));" title="Supprimer" class="btn_delete"></div>
            </div>
            <?php }?>
        </div>
        <div class="galerie_body">
            <?php if (isset($_smarty_tpl->tpl_vars['galerie']->value['image']['image_url'])){?>
                <a href="galeries/<?php echo $_smarty_tpl->tpl_vars['galerie']->value['galerie_id'];?>
/<?php echo $_smarty_tpl->tpl_vars['galerie']->value['urlrw'];?>
" title="Voir les images de la galerie"><img class="galerie_preview" src="<?php echo $_smarty_tpl->tpl_vars['config']->value['galerie']['file_upload_dir'];?>
preview/<?php echo $_smarty_tpl->tpl_vars['galerie']->value['image']['image_url'];?>
" width="225" height="225" /></a>
            <?php }else{ ?>
                <div class="galerie_preview">La galerie ne contient pas d'images pour le moment</div>
            <?php }?>
        </div>
        <div class="galerie_footer">
            <a class="boutonW hasIcon" style="display:block; margin-top:4px;" href="galeries/<?php echo $_smarty_tpl->tpl_vars['galerie']->value['galerie_id'];?>
/<?php echo $_smarty_tpl->tpl_vars['galerie']->value['urlrw'];?>
" title="Voir les images de la galerie"><span class="show_icon"></span>Afficher la galerie</a>
        </div>
        <div style="clear:both;"></div>
    </div>
    <?php if ($_smarty_tpl->tpl_vars['galerie']->iteration%4==0){?>
    <div style="clear:both;"></div>
    <?php }?>
<?php } ?> 
</div>
<div style="clear:both;"></div>

<div class="top_bottom_btns">
    <?php echo $_smarty_tpl->getSubTemplate ('core/templates/multipage.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('data'=>$_smarty_tpl->tpl_vars['data']->value['multipage']), 0);?>

    <a style="float:right;" class="boutonW" href="<?php echo (($tmp = @$_SERVER['HTTP_REFERER'])===null||$tmp==='' ? "galeries" : $tmp);?>
" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>
<?php }} ?>