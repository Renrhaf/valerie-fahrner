<?php /* Smarty version Smarty-3.1.7, created on 2012-06-27 23:34:54
         compiled from "modules/News/templates/news_list_admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15122295114feb7c7e672240-46224617%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fe965ae155038a4452e7e7ab0252db1c83615ab6' => 
    array (
      0 => 'modules/News/templates/news_list_admin.tpl',
      1 => 1338806751,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15122295114feb7c7e672240-46224617',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'config' => 0,
    'news' => 0,
    'id' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4feb7c7e92912',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4feb7c7e92912')) {function content_4feb7c7e92912($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/homepages/23/d369665974/htdocs/valerie/libs/Smarty/plugins/modifier.date_format.php';
?><div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="index.php?model=Home">Votre espace</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?module=News&amp;model=News&amp;action=showlist&amp;admin">Gestion des actualités</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<h3 class="page_title">Gestion des actualités</h3>

<div class="top_bottom_btns">
    <a style="float:left;margin-right:7px;" class="boutonW" href="index.php?module=News&amp;model=News&amp;action=Createform&amp;admin" title="Créer une actualité">Créer une actualité</a>    
    <?php echo $_smarty_tpl->getSubTemplate ('core/templates/multipage.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('data'=>$_smarty_tpl->tpl_vars['data']->value['multipage']), 0);?>

    <a style="float:right;" class="boutonW" href="<?php echo (($tmp = @$_SERVER['HTTP_REFERER'])===null||$tmp==='' ? "index.php?module=News&amp;model=News&amp;action=showlist&amp;admin" : $tmp);?>
" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>

<table class="admin_table">
    <thead>
        <tr>
            <th style="width:40px;" class="triable" onclick="order_by($(this),'news_id');"># <?php if (isset($_GET['tri'])&&$_GET['tri']=='news_id'){?><span class="tri_<?php echo (($tmp = @$_GET['ord'])===null||$tmp==='' ? 'asc' : $tmp);?>
"></span><?php }?></th>
            <th class="triable" onclick="order_by($(this),'news_title');">Titre <?php if (isset($_GET['tri'])&&$_GET['tri']=='news_title'){?><span class="tri_<?php echo (($tmp = @$_GET['ord'])===null||$tmp==='' ? 'asc' : $tmp);?>
"></span><?php }?></th>
            <th style="width:150px;" class="triable" onclick="order_by($(this),'news_categ_title');">Catégorie <?php if (isset($_GET['tri'])&&$_GET['tri']=='news_categ_title'){?><span class="tri_<?php echo (($tmp = @$_GET['ord'])===null||$tmp==='' ? 'asc' : $tmp);?>
"></span><?php }?></th>
            <th style="width:<?php echo $_smarty_tpl->tpl_vars['config']->value['news']['thumb_width'];?>
px;">Image</th>
            <th style="width:100px;">Galerie</th>
            <th style="width:100px;" class="triable" onclick="order_by($(this),'news_created');">Créée le <?php if (isset($_GET['tri'])&&$_GET['tri']=='news_created'){?><span class="tri_<?php echo (($tmp = @$_GET['ord'])===null||$tmp==='' ? 'asc' : $tmp);?>
"></span><?php }?></th>
            <th style="width:70px;">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php  $_smarty_tpl->tpl_vars['news'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['news']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['news']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['news']->key => $_smarty_tpl->tpl_vars['news']->value){
$_smarty_tpl->tpl_vars['news']->_loop = true;
 $_smarty_tpl->tpl_vars['news']->iteration++;
?>
        <?php $_smarty_tpl->tpl_vars['id'] = new Smarty_variable($_smarty_tpl->tpl_vars['news']->value['news_id'], null, 0);?>
        <tr <?php if (!(1 & $_smarty_tpl->tpl_vars['news']->iteration)){?>class="odd" <?php }?>>
            <td><?php echo $_smarty_tpl->tpl_vars['id']->value;?>
</td>
            <td><p><?php echo $_smarty_tpl->tpl_vars['news']->value['news_title'];?>
</p></td>
            <td><p><?php echo (($tmp = @$_smarty_tpl->tpl_vars['news']->value['news_categ_title'])===null||$tmp==='' ? 'Aucune catégorie spécifiée' : $tmp);?>
</p></td>
            <?php if (isset($_smarty_tpl->tpl_vars['news']->value['news_image_url'])){?>
            <td><a href="<?php echo $_smarty_tpl->tpl_vars['config']->value['news']['file_upload_dir'];?>
<?php echo $_smarty_tpl->tpl_vars['news']->value['news_image_url'];?>
" rel="shadowbox[images]" title="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['news']->value['news_title'])===null||$tmp==='' ? '' : $tmp);?>
"><img style="display:block;" src='<?php echo $_smarty_tpl->tpl_vars['config']->value['news']['file_upload_dir'];?>
thumbnails/<?php echo $_smarty_tpl->tpl_vars['news']->value['news_image_url'];?>
' alt="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['news']->value['news_title'])===null||$tmp==='' ? '' : $tmp);?>
" title="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['news']->value['news_title'])===null||$tmp==='' ? '' : $tmp);?>
" /></a></td>
            <?php }else{ ?>
            <td><p>Aucune image spécifiée</p></td>
            <?php }?>
            <td><p><?php echo (($tmp = @$_smarty_tpl->tpl_vars['news']->value['galerie_title'])===null||$tmp==='' ? 'Aucune galerie spécifiée' : $tmp);?>
</p></td>
            <td><p><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['news']->value['news_created'],"%d/%m/%Y <br/>à %Hh%M");?>
<br/>par <a href="index.php?model=User&amp;pk=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&amp;admin" title="Consulter le profil"><?php echo $_smarty_tpl->tpl_vars['news']->value['user_fname'];?>
 <?php echo $_smarty_tpl->tpl_vars['news']->value['user_lname'];?>
</a></p></td>
            <td class="commands">
                <div onclick="activate($(this), 'News','News',<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
);" <?php if ($_smarty_tpl->tpl_vars['news']->value['news_active']){?>title="Désactiver" class="btn_active"<?php }else{ ?>title="Activer" class="btn_busy"<?php }?>></div>
                <a href="index.php?module=News&amp;model=News&amp;action=Editform&amp;pk=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&amp;admin" title="Editer" class="btn_edit"></a>
                <div onclick="delet($(this), 'News','News',<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
);" title="Supprimer" class="btn_delete"></div>
            </td>
        </tr>
    <?php } ?>   
    </tbody>
</table>

<div class="top_bottom_btns">
    <a style="float:left;margin-right:7px;" class="boutonW" href="index.php?module=News&amp;model=News&amp;action=Createform&amp;admin" title="Créer une actualité">Créer une actualité</a>    
    <?php echo $_smarty_tpl->getSubTemplate ('core/templates/multipage.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('data'=>$_smarty_tpl->tpl_vars['data']->value['multipage']), 0);?>

    <a style="float:right;" class="boutonW" href="<?php echo (($tmp = @$_SERVER['HTTP_REFERER'])===null||$tmp==='' ? "index.php?module=News&amp;model=News&amp;action=showlist&amp;admin" : $tmp);?>
" title="Retour">Retour</a> 
    <div style="clear:both;"></div>
</div><?php }} ?>