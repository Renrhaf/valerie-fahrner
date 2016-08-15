<?php /* Smarty version Smarty-3.1.7, created on 2014-07-27 14:38:29
         compiled from "modules/News/templates/news_categ_list_admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:132976876753d4f2c50c9773-48582959%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7252608c5fb40de58718d8d1f1c859f689214da3' => 
    array (
      0 => 'modules/News/templates/news_categ_list_admin.tpl',
      1 => 1338806750,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '132976876753d4f2c50c9773-48582959',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'news_categ' => 0,
    'id' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_53d4f2c558174',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53d4f2c558174')) {function content_53d4f2c558174($_smarty_tpl) {?><div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="index.php?model=Home">Votre espace</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?module=News&amp;model=Newscateg&amp;action=showlist&amp;admin">Gestion des catégories d'actualités</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<h3 class="page_title">Gestion des catégories d'actualités</h3>

<div class="top_bottom_btns">
    <a style="float:left;margin-right:7px;" class="boutonW" href="index.php?module=News&amp;model=Newscateg&amp;action=Createform&amp;admin" title="Créer une catégorie">Créer une catégorie</a>    
    <?php echo $_smarty_tpl->getSubTemplate ('core/templates/multipage.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('data'=>$_smarty_tpl->tpl_vars['data']->value['multipage']), 0);?>

    <a style="float:right;" class="boutonW" href="<?php echo (($tmp = @$_SERVER['HTTP_REFERER'])===null||$tmp==='' ? "index.php?module=News&amp;model=Newscateg&amp;action=showlist&amp;admin" : $tmp);?>
" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>

<table class="admin_table">
    <thead>
        <tr>
            <th style="width:40px;" class="triable" onclick="order_by($(this),'news_categ_id');"># <?php if (isset($_GET['tri'])&&$_GET['tri']=='news_categ_id'){?><span class="tri_<?php echo (($tmp = @$_GET['ord'])===null||$tmp==='' ? 'asc' : $tmp);?>
"></span><?php }?></th>
            <th style="width:150px;" class="triable" onclick="order_by($(this),'news_categ_title');">Titre <?php if (isset($_GET['tri'])&&$_GET['tri']=='news_categ_title'){?><span class="tri_<?php echo (($tmp = @$_GET['ord'])===null||$tmp==='' ? 'asc' : $tmp);?>
"></span><?php }?></th>
            <th class="triable" onclick="order_by($(this),'news_categ_description');">Catégorie <?php if (isset($_GET['tri'])&&$_GET['tri']=='news_categ_description'){?><span class="tri_<?php echo (($tmp = @$_GET['ord'])===null||$tmp==='' ? 'asc' : $tmp);?>
"></span><?php }?></th>
            <th style="width:70px;">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php  $_smarty_tpl->tpl_vars['news_categ'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['news_categ']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['news_categs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['news_categ']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['news_categ']->key => $_smarty_tpl->tpl_vars['news_categ']->value){
$_smarty_tpl->tpl_vars['news_categ']->_loop = true;
 $_smarty_tpl->tpl_vars['news_categ']->iteration++;
?>
        <?php $_smarty_tpl->tpl_vars['id'] = new Smarty_variable($_smarty_tpl->tpl_vars['news_categ']->value['news_categ_id'], null, 0);?>
        <tr <?php if (!(1 & $_smarty_tpl->tpl_vars['news_categ']->iteration)){?>class="odd" <?php }?>>
            <td><?php echo $_smarty_tpl->tpl_vars['id']->value;?>
</td>
            <td><p><?php echo $_smarty_tpl->tpl_vars['news_categ']->value['news_categ_title'];?>
</p></td>
            <td><p><?php echo $_smarty_tpl->tpl_vars['news_categ']->value['news_categ_description'];?>
</p></td>
            <td class="commands">
                <a href="index.php?module=News&amp;model=Newscateg&amp;action=Editform&amp;pk=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&amp;admin" title="Editer" class="btn_edit"></a>
                <div onclick="delet($(this), 'News','Newscateg',<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
);" title="Supprimer" class="btn_delete"></div>
            </td>
        </tr>
    <?php } ?>   
    </tbody>
</table>

<div class="top_bottom_btns">
    <a style="float:left;margin-right:7px;" class="boutonW" href="index.php?module=News&amp;model=Newscateg&amp;action=Createform&amp;admin" title="Créer une catégorie">Créer une catégorie</a>    
    <?php echo $_smarty_tpl->getSubTemplate ('core/templates/multipage.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('data'=>$_smarty_tpl->tpl_vars['data']->value['multipage']), 0);?>

    <a style="float:right;" class="boutonW" href="<?php echo (($tmp = @$_SERVER['HTTP_REFERER'])===null||$tmp==='' ? "index.php?module=News&amp;model=Newscateg&amp;action=showlist&amp;admin" : $tmp);?>
" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div><?php }} ?>