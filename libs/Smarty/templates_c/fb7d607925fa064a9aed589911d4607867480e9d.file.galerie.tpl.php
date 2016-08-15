<?php /* Smarty version Smarty-3.1.7, created on 2012-06-04 13:07:59
         compiled from "modules/Galerie/templates/galerie.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4130726544fad71e2b8e0b8-48619718%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fb7d607925fa064a9aed589911d4607867480e9d' => 
    array (
      0 => 'modules/Galerie/templates/galerie.tpl',
      1 => 1338806715,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4130726544fad71e2b8e0b8-48619718',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fad71e2d06f9',
  'variables' => 
  array (
    'data' => 0,
    'image' => 0,
    'config' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fad71e2d06f9')) {function content_4fad71e2d06f9($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/homepages/23/d369665974/htdocs/valerie/libs/Smarty/plugins/modifier.date_format.php';
?><div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="">Accueil</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="galeries">Liste des galeries</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="galeries/<?php echo $_smarty_tpl->tpl_vars['data']->value['galerie']['galerie_id'];?>
/<?php echo $_smarty_tpl->tpl_vars['data']->value['urlrw'];?>
">Affichage d'une galerie</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<h3 class="page_title"><?php echo $_smarty_tpl->tpl_vars['data']->value['galerie']['galerie_title'];?>
</h3>

<p class="desc_note" style="margin-left:15px;margin-top:10px;">Description de la galerie :</p>
<p class="galerie_desc"><?php echo $_smarty_tpl->tpl_vars['data']->value['galerie']['galerie_description'];?>
</p>

<div class="top_bottom_btns">
    <?php echo $_smarty_tpl->getSubTemplate ('core/templates/multipage.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('data'=>$_smarty_tpl->tpl_vars['data']->value['multipage']), 0);?>

    <a style="float:right;" class="boutonW" href="<?php echo (($tmp = @$_SERVER['HTTP_REFERER'])===null||$tmp==='' ? "galeries" : $tmp);?>
" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>
   
<p class="desc_note" style="text-align:center;">La description d'une image s'affichera lors du passage de la souris - Vous pouvez utiliser les flèches du clavier pour défiler les images</p>
    
<ul id="Gimage_list">
<?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['image']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value){
$_smarty_tpl->tpl_vars['image']->_loop = true;
?>
    <li id="image_<?php echo $_smarty_tpl->tpl_vars['image']->value['image_id'];?>
"><a href="<?php echo $_smarty_tpl->tpl_vars['config']->value['galerie']['file_upload_dir'];?>
<?php echo $_smarty_tpl->tpl_vars['image']->value['image_url'];?>
" rel="prettyPhoto[<?php echo $_smarty_tpl->tpl_vars['data']->value['galerie']['galerie_title'];?>
]" title="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['image']->value['image_description'])===null||$tmp==='' ? '' : $tmp);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['galerie']['file_upload_dir'];?>
thumbnails/<?php echo $_smarty_tpl->tpl_vars['image']->value['image_url'];?>
" title="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['image']->value['image_title'])===null||$tmp==='' ? '' : $tmp);?>
" alt="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['image']->value['image_title'])===null||$tmp==='' ? '' : $tmp);?>
" /></a>
        <?php if (isset($_SESSION['user'])){?>
            <span class="commands">
                <div onclick="activate($(this), 'Galerie','Image',<?php echo $_smarty_tpl->tpl_vars['image']->value['image_id'];?>
);" <?php if ($_smarty_tpl->tpl_vars['image']->value['image_active']){?>title="Désactiver" class="btn_active"<?php }else{ ?>title="Activer" class="btn_busy"<?php }?>></div>
                <a href="index.php?module=Galerie&amp;model=image&amp;action=Editform&amp;pk=<?php echo $_smarty_tpl->tpl_vars['image']->value['image_id'];?>
&amp;admin" title="Editer" class="btn_edit"></a>
                <div onclick="delet($(this), 'Galerie','Image',<?php echo $_smarty_tpl->tpl_vars['image']->value['image_id'];?>
, $(this).parents('li'));" title="Supprimer" class="btn_delete"></div>
            </span>
        <?php }?>
        <span class="image_desc"><?php echo $_smarty_tpl->tpl_vars['image']->value['image_description'];?>
</span>
    </li>
<?php } ?>
</ul>
<div style="clear:both;"></div>

<div id="image_desc">
    <h4>Description de l'image :</h4>
    <p>
    
    </p>
    <img src="modules/Galerie/images/quote.png" style="display:none; position:absolute; top:-10px; left:-10px;" />
    <img src="modules/Galerie/images/quote2.png" style="display:none; position:absolute; bottom:-10px; right:-10px;"/>
</div>

<div class="top_bottom_btns">
    <?php echo $_smarty_tpl->getSubTemplate ('core/templates/multipage.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('data'=>$_smarty_tpl->tpl_vars['data']->value['multipage']), 0);?>

    <a style="float:right;" class="boutonW" href="<?php echo (($tmp = @$_SERVER['HTTP_REFERER'])===null||$tmp==='' ? "galeries" : $tmp);?>
" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>
    
<p class="last-update">dernière mise à jour : <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['galerie']['galerie_updated'],"%d/%m/%Y à %Hh%M");?>
</p><?php }} ?>