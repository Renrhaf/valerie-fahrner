<?php /* Smarty version Smarty-3.1.7, created on 2012-06-04 12:47:24
         compiled from "modules/News/templates/news_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18996566094fad7211aef736-24861566%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b8be34dacc51009abd34dd80b260e077905dde2c' => 
    array (
      0 => 'modules/News/templates/news_list.tpl',
      1 => 1338806750,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18996566094fad7211aef736-24861566',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fad7211e85e2',
  'variables' => 
  array (
    'data' => 0,
    'news' => 0,
    'config' => 0,
    'image' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fad7211e85e2')) {function content_4fad7211e85e2($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/homepages/23/d369665974/htdocs/valerie/libs/Smarty/plugins/modifier.date_format.php';
?><div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="">Accueil</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="news">Liste des actualités</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<h3 class="page_title">Liste des actualités</h3>

<div class="top_bottom_btns">
    <span style="float:left;"><?php if (isset($_smarty_tpl->tpl_vars['data']->value['news_categ_title'])){?><?php echo $_smarty_tpl->tpl_vars['data']->value['news_categ_title'];?>
<?php }else{ ?>Toutes catégories confondues<?php }?></span>
    <?php echo $_smarty_tpl->getSubTemplate ('core/templates/multipage.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('data'=>$_smarty_tpl->tpl_vars['data']->value['multipage']), 0);?>

    <a style="float:right;" class="boutonW" href="<?php echo (($tmp = @$_SERVER['HTTP_REFERER'])===null||$tmp==='' ? "news" : $tmp);?>
" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>

<?php  $_smarty_tpl->tpl_vars['news'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['news']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['news']->key => $_smarty_tpl->tpl_vars['news']->value){
$_smarty_tpl->tpl_vars['news']->_loop = true;
?>
    <div class="news" id="news_<?php echo $_smarty_tpl->tpl_vars['news']->value['news_id'];?>
">
            <?php if (isset($_smarty_tpl->tpl_vars['news']->value['news_image_url'])){?>
                <img class="news_image" src="<?php echo $_smarty_tpl->tpl_vars['config']->value['news']['file_upload_dir'];?>
thumbnails/<?php echo $_smarty_tpl->tpl_vars['news']->value['news_image_url'];?>
" />
            <?php }else{ ?>
                <?php if (isset($_smarty_tpl->tpl_vars['news']->value['galerie_id'])){?>
                <ul class="slideshow">
                    <?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['image']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['news']->value['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value){
$_smarty_tpl->tpl_vars['image']->_loop = true;
?>
                    <li><img class="news_image" src="<?php echo $_smarty_tpl->tpl_vars['config']->value['galerie']['file_upload_dir'];?>
thumbnails/<?php echo $_smarty_tpl->tpl_vars['image']->value['image_url'];?>
" /></li>
                    <?php } ?>
                </ul>
                <?php }?>
            <?php }?>
            
            <h4><a href="news/<?php echo $_smarty_tpl->tpl_vars['news']->value['news_id'];?>
/<?php echo $_smarty_tpl->tpl_vars['news']->value['urlrw'];?>
" title="Voir l'actualité"><?php echo $_smarty_tpl->tpl_vars['news']->value['news_title'];?>
</a></h4>
            
            <?php if (isset($_SESSION['user'])){?>
            <div class="commands" style="position:absolute;top:5px;right:0px;">
                <div onclick="activate($(this), 'News','News',<?php echo $_smarty_tpl->tpl_vars['news']->value['news_id'];?>
);" <?php if ($_smarty_tpl->tpl_vars['news']->value['news_active']){?>title="Désactiver" class="btn_active"<?php }else{ ?>title="Activer" class="btn_busy"<?php }?>></div>
                <a href="index.php?module=News&amp;model=News&amp;action=Editform&amp;pk=<?php echo $_smarty_tpl->tpl_vars['news']->value['news_id'];?>
&amp;admin" title="Editer" class="btn_edit"></a>
                <div onclick="delet($(this), 'News','News',<?php echo $_smarty_tpl->tpl_vars['news']->value['news_id'];?>
, $(this).parents('.news'));" title="Supprimer" class="btn_delete"></div>
            </div>
            <?php }?>
            <p class="news_desc">
            <?php echo $_smarty_tpl->tpl_vars['news']->value['news_content'];?>
 <a href="news/<?php echo $_smarty_tpl->tpl_vars['news']->value['news_id'];?>
/<?php echo $_smarty_tpl->tpl_vars['news']->value['urlrw'];?>
" title="Lire la suite">lire la suite</a>
            </p>
        <div class="news_footer">
            <span>
                Publié le <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['news']->value['news_created'],"%d/%m/%Y à %Hh%M");?>

                <?php if (isset($_smarty_tpl->tpl_vars['news']->value['news_categ_id'])){?>- Catégorie : <a href="news/categ-<?php echo $_smarty_tpl->tpl_vars['news']->value['news_categ_id'];?>
/<?php echo $_smarty_tpl->tpl_vars['news']->value['categ_urlrw'];?>
" title="Voir les actualités de cette catégorie"><?php echo $_smarty_tpl->tpl_vars['news']->value['news_categ_title'];?>
</a><?php }?>
            </span>
        </div>
        <div style="clear:both;"></div>
    </div>
<?php } ?>

<div class="top_bottom_btns">
    <?php echo $_smarty_tpl->getSubTemplate ('core/templates/multipage.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('data'=>$_smarty_tpl->tpl_vars['data']->value['multipage']), 0);?>

    <a style="float:right;" class="boutonW" href="<?php echo (($tmp = @$_SERVER['HTTP_REFERER'])===null||$tmp==='' ? "news" : $tmp);?>
" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>
    

<script type="text/javascript">
$(document).ready(function(){ slide(); });
    
function slide(){
    $('.slideshow').each(function(){
        var cur = $(this).find('.current');
        if(cur.length == 0){
            cur = $(this).find('li:first');
        }

        $(this).find('.current').removeClass('current');

        if($(cur).next('li').length != 0){
            $(cur).next('li').addClass('current');
        } else {
            $(this).find('li:first').addClass('current');
        }
    });
    setTimeout(slide, 1500);
}
</script>
<?php }} ?>