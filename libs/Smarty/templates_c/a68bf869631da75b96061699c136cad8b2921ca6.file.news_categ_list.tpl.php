<?php /* Smarty version Smarty-3.1.7, created on 2012-05-11 23:49:35
         compiled from "modules/News/templates/news_categ_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14452556404fad896f21fe38-32330397%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a68bf869631da75b96061699c136cad8b2921ca6' => 
    array (
      0 => 'modules/News/templates/news_categ_list.tpl',
      1 => 1336762238,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14452556404fad896f21fe38-32330397',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'news_categ' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fad896f2eea7',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fad896f2eea7')) {function content_4fad896f2eea7($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include '/homepages/23/d369665974/htdocs/valerie/libs/Smarty/plugins/modifier.truncate.php';
?><div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="index.php">Accueil</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?module=News&amp;model=Newscateg&amp;action=showlist">Liste des catégories d'actualités</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<h3 class="page_title">Catégories d'actualités</h3>

<div class="top_bottom_btns">
    <?php echo $_smarty_tpl->getSubTemplate ('core/templates/multipage.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('data'=>$_smarty_tpl->tpl_vars['data']->value['multipage']), 0);?>

    <a style="float:right;" class="boutonW" href="<?php echo (($tmp = @$_SERVER['HTTP_REFERER'])===null||$tmp==='' ? "index.php?module=News&amp;model=Newscateg&amp;action=showlist" : $tmp);?>
" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>
    
<?php  $_smarty_tpl->tpl_vars['news_categ'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['news_categ']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['news_categs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['news_categ']->key => $_smarty_tpl->tpl_vars['news_categ']->value){
$_smarty_tpl->tpl_vars['news_categ']->_loop = true;
?>
<div class="news_categ">
    <div class="news_categ_head">
        <?php if (isset($_SESSION['user'])){?>
            <?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['news_categ']->value['news_categ_title'],33,'...',true);?>

        <?php }else{ ?>
            <?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['news_categ']->value['news_categ_title'],38,'...',true);?>

        <?php }?>
    </div>
    <div class="news_categ_desc"><?php echo $_smarty_tpl->tpl_vars['news_categ']->value['news_categ_description'];?>
</div>
    <?php if (isset($_SESSION['user'])){?>
    <div class="commands" style="position:absolute;top:5px;right:0px;">
        <a href="index.php?module=News&amp;model=Newscateg&amp;action=Editform&amp;pk=<?php echo $_smarty_tpl->tpl_vars['news_categ']->value['news_categ_id'];?>
&amp;admin" title="Editer" class="btn_edit"></a>
        <div onclick="delet($(this), 'News','Newscateg',<?php echo $_smarty_tpl->tpl_vars['news_categ']->value['news_categ_id'];?>
, $(this).parents('.news_categ'));" title="Supprimer" class="btn_delete"></div>
    </div>
    <?php }?>
    <div class="news_categ_footer">
        <a class="boutonW hasIcon" style="float:left;margin-left:10px;" href="index.php?module=News&amp;model=News&amp;action=showlist&amp;news_categ_id=<?php echo $_smarty_tpl->tpl_vars['news_categ']->value['news_categ_id'];?>
" title="Voir les news de cette catégorie"><span class="show_icon"></span>Voir les news de cette catégorie</a>
        <div style="clear:both;"></div>
    </div>
</div>
<?php } ?>

<div class="top_bottom_btns">
    <?php echo $_smarty_tpl->getSubTemplate ('core/templates/multipage.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('data'=>$_smarty_tpl->tpl_vars['data']->value['multipage']), 0);?>

    <a style="float:right;" class="boutonW" href="<?php echo (($tmp = @$_SERVER['HTTP_REFERER'])===null||$tmp==='' ? "index.php?module=News&amp;model=Newscateg&amp;action=showlist" : $tmp);?>
" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div><?php }} ?>