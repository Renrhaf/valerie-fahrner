<?php /* Smarty version Smarty-3.1.7, created on 2012-06-04 13:36:57
         compiled from "modules/News/templates/news.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15211799484fad869905cb54-35119739%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9f1914c6e33a61e1ba58d2200972e706829b9b0c' => 
    array (
      0 => 'modules/News/templates/news.tpl',
      1 => 1338806749,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15211799484fad869905cb54-35119739',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fad8699139ff',
  'variables' => 
  array (
    'data' => 0,
    'config' => 0,
    'image' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fad8699139ff')) {function content_4fad8699139ff($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/homepages/23/d369665974/htdocs/valerie/libs/Smarty/plugins/modifier.date_format.php';
?><div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="">Accueil</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="news">Liste des actualités</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="news/<?php echo $_smarty_tpl->tpl_vars['data']->value['news']['news_id'];?>
/<?php echo $_smarty_tpl->tpl_vars['data']->value['urlrw'];?>
">Affichage d'une actualité</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>
    
<div itemscope itemtype="http://data-vocabulary.org/Event">
    <div id="news_title_s">
        <div <?php if (isset($_smarty_tpl->tpl_vars['data']->value['news']['news_image_url'])){?>id="news_t_bandeau"<?php }else{ ?>id="news_t_bandeau_noimg"<?php }?>>
        <h3 class="page_title" itemprop="summary"><?php echo $_smarty_tpl->tpl_vars['data']->value['news']['news_title'];?>
</h3>
        <p>
            Publié le <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['news']['news_created'],"%d/%m/%Y à %Hh%M");?>

            <?php if (isset($_smarty_tpl->tpl_vars['data']->value['news']['news_categ_id'])){?>- Catégorie : <a href="news/categ-<?php echo $_smarty_tpl->tpl_vars['data']->value['news']['news_categ_id'];?>
/<?php echo $_smarty_tpl->tpl_vars['data']->value['news']['categ']['urlrw'];?>
" title="Voir les actualités de cette catégorie"><?php echo $_smarty_tpl->tpl_vars['data']->value['news']['categ']['news_categ_title'];?>
</a><?php }?>
            <span style="float:right;margin-left:30px;">Dernière modification : <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['news']['news_updated'],"%d/%m/%Y à %Hh%M");?>
</span>
        </p>
        </div>
        <?php if (isset($_smarty_tpl->tpl_vars['data']->value['news']['news_image_url'])){?>
        <div id="news_image">
            <a href="<?php echo $_smarty_tpl->tpl_vars['config']->value['news']['file_upload_dir'];?>
<?php echo $_smarty_tpl->tpl_vars['data']->value['news']['news_image_url'];?>
" rel="shadowbox" title="<?php echo $_smarty_tpl->tpl_vars['data']->value['news']['news_title'];?>
"><img src='<?php echo $_smarty_tpl->tpl_vars['config']->value['news']['file_upload_dir'];?>
thumbnails/<?php echo $_smarty_tpl->tpl_vars['data']->value['news']['news_image_url'];?>
' itemprop="photo" alt="<?php echo $_smarty_tpl->tpl_vars['data']->value['news']['news_title'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['data']->value['news']['news_title'];?>
" /></a>
        </div>  
        <?php }?>
    </div>

    <?php if (isset($_smarty_tpl->tpl_vars['data']->value['news']['images'])){?>
    <div id="assoc_galerie">
        <ul>
        <?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['image']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['news']['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['image']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['image']->iteration=0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['imggal']['total'] = $_smarty_tpl->tpl_vars['image']->total;
foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value){
$_smarty_tpl->tpl_vars['image']->_loop = true;
 $_smarty_tpl->tpl_vars['image']->iteration++;
 $_smarty_tpl->tpl_vars['image']->last = $_smarty_tpl->tpl_vars['image']->iteration === $_smarty_tpl->tpl_vars['image']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['imggal']['last'] = $_smarty_tpl->tpl_vars['image']->last;
?>
            <?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['imggal']['last']||($_smarty_tpl->getVariable('smarty')->value['foreach']['imggal']['last']&&!isset($_smarty_tpl->tpl_vars['data']->value['news']['news_image_url']))||($_smarty_tpl->getVariable('smarty')->value['foreach']['imggal']['last']&&$_smarty_tpl->getVariable('smarty')->value['foreach']['imggal']['total']<8)){?>
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['config']->value['galerie']['file_upload_dir'];?>
<?php echo $_smarty_tpl->tpl_vars['image']->value['image_url'];?>
" rel="prettyPhoto[galerie]" title="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['image']->value['image_description'])===null||$tmp==='' ? '' : $tmp);?>
"><img src='<?php echo $_smarty_tpl->tpl_vars['config']->value['galerie']['file_upload_dir'];?>
thumbnails/<?php echo $_smarty_tpl->tpl_vars['image']->value['image_url'];?>
' title="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['image']->value['image_title'])===null||$tmp==='' ? '' : $tmp);?>
" alt="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['image']->value['image_title'])===null||$tmp==='' ? '' : $tmp);?>
" /></a></li>
            <?php }?>
        <?php } ?>
        </ul>
        <div style="clear:both;"></div>
        <a class="boutonW hasIcon" id="go_to_galerie" href="galeries/<?php echo $_smarty_tpl->tpl_vars['image']->value['galerie_id'];?>
/<?php echo $_smarty_tpl->tpl_vars['data']->value['news']['galerie']['urlrw'];?>
" title="Voir la galerie"><span class="show_icon"></span>Voir toutes les images de la galerie</a>
    </div>
    <?php }?>

    <div id="news_content_s" itemprop="description">
        <?php echo $_smarty_tpl->tpl_vars['data']->value['news']['news_content'];?>

    </div>
</div>

<div class="top_bottom_btns">
    <a style="float:right;" class="boutonW" href="<?php echo (($tmp = @$_SERVER['HTTP_REFERER'])===null||$tmp==='' ? "news" : $tmp);?>
" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div><?php }} ?>