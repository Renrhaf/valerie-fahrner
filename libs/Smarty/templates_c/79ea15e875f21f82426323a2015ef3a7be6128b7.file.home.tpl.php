<?php /* Smarty version Smarty-3.1.7, created on 2012-06-04 13:48:56
         compiled from "core/templates/home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8871371984fad83384cb113-90014304%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '79ea15e875f21f82426323a2015ef3a7be6128b7' => 
    array (
      0 => 'core/templates/home.tpl',
      1 => 1338806909,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8871371984fad83384cb113-90014304',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fad833879548',
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fad833879548')) {function content_4fad833879548($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/homepages/23/d369665974/htdocs/valerie/libs/Smarty/plugins/modifier.date_format.php';
?><h3 class="page_title">Votre espace personnel</h3>
             
<div class="home_box">
    <div class="home_box_head">
        Fonctionnalités principales
    </div>
    <div class="home_box_body">
        <h5>Votre compte</h5>
        <ul>
            <li><span class="uf_label">Nom :</span><span class="uf_val"><?php echo $_smarty_tpl->tpl_vars['data']->value['user']['user_lname'];?>
</span></li>
            <li><span class="uf_label">Prénom :</span><span class="uf_val"><?php echo $_smarty_tpl->tpl_vars['data']->value['user']['user_fname'];?>
</span></li>
            <li><span class="uf_label">Email :</span><span class="uf_val"><?php echo $_smarty_tpl->tpl_vars['data']->value['user']['user_mail'];?>
</span></li>
            <li><span class="uf_label">Date d'inscription :</span><span class="uf_val"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['user']['user_created'],"le %d/%m/%Y à %Hh%M");?>
</span></li>
            <?php if (isset($_smarty_tpl->tpl_vars['data']->value['user']['user_website'])){?><li><span class="uf_label">Site web :</span><span class="uf_val"><a href="<?php echo $_smarty_tpl->tpl_vars['data']->value['user']['user_website'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['user']['user_website'];?>
</a></span></li><?php }?>
            <?php if (isset($_smarty_tpl->tpl_vars['data']->value['profession']['profession_name'])){?><li><span class="uf_label">Profession :</span><span class="uf_val"><?php echo $_smarty_tpl->tpl_vars['data']->value['profession']['profession_name'];?>
</span></li><?php }?>
        </ul>
        <div style="clear:both;"></div>
        
        <a class="boutonW hasIcon" style="float:left;margin:20px;" href="index.php?model=User&amp;action=Editform&amp;pk=<?php echo $_SESSION['user']['user_id'];?>
&amp;admin" title="Modifier vos informations personnelles"><span class="user_icon"></span>Modifier vos informations personnelles</a>
        
        <h5 style="clear:both;">Informations diverses</h5>
        <ul>
            <li><span class="uf_label">Nombre d'utilisateurs :</span><span class="uf_val"><?php echo $_smarty_tpl->tpl_vars['data']->value['miscellaneous']['total_users'];?>
</span></li>
            <li><span class="uf_label">Dernier inscrit :</span><span class="uf_val"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['miscellaneous']['last_date'],"le %d/%m/%Y à %Hh%M");?>
</span></li>
            <li><span class="uf_label">Catégorie majeure :</span><span class="uf_val"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['miscellaneous']['most_used_prof'])===null||$tmp==='' ? "aucune" : $tmp);?>
</span></li>
            
            
        </ul>
        <div style="clear:both;"></div>
        
        <a class="boutonW hasIcon" style="float:left;margin:20px;margin-bottom:0px;" href="index.php?model=User&amp;action=showlist&amp;admin" title="Gérer les utilisateurs"><span class="users_icon"></span>Gérer les utilisateurs</a>
        <div style="clear:both;"></div>
        <a class="boutonW hasIcon" style="float:left;margin:20px;margin-bottom:0px;" href="index.php?model=Page&amp;action=showlist&amp;admin" title="Gérer les pages"><span class="pages_icon"></span>Gérer les pages</a>
        <a class="boutonW hasIcon" style="float:left;margin:20px;margin-bottom:0px;" href="index.php?model=Menu&amp;action=showlist&amp;admin" title="Gérer le menu"><span class="news_categ_icon"></span>Gérer le menu</a>
        <div style="clear:both;"></div>
        
        <div style="margin:30px 10px 10px 10px;">
            <a id="putInMaintenance" class="boutonB" style="width:100%;<?php if (!$_smarty_tpl->tpl_vars['data']->value['site_status']){?>display:none;<?php }?>" href="#" onclick="putSiteInMaintenance(true); return false;">Mettre le site en maintenance</a>
            <a id="putOutOfMaintenance" class="boutonW" style="width:100%;<?php if ($_smarty_tpl->tpl_vars['data']->value['site_status']){?>display:none;<?php }?>" href="#" onclick="putSiteInMaintenance(false); return false;">Mettre le site en ligne</a>
        </div>
    </div>
</div>

<div class="home_box">
    <div class="home_box_head">
        Module de Galeries
    </div>
    <div class="home_box_body">
        <h5 style="clear:both;">Informations diverses</h5>
        <ul>
            <li><span class="uf_label">Nombre de galeries :</span><span class="uf_val"><?php echo $_smarty_tpl->tpl_vars['data']->value['galerie']['nb_galeries'];?>
</span></li>
            <li><span class="uf_label">Nombre d'images :</span><span class="uf_val"><?php echo $_smarty_tpl->tpl_vars['data']->value['galerie']['nb_images'];?>
</span></li>
            <li><span class="uf_label">Taille totale :</span><span class="uf_val"><?php echo sprintf("%.2f",($_smarty_tpl->tpl_vars['data']->value['galerie']['total_size']/1000000));?>
 Mo</span></li>
        </ul>
        <div style="clear:both;"></div>
        
        <a class="boutonW hasIcon" style="float:left;margin:20px;margin-bottom:0px;" href="index.php?module=Galerie&amp;model=Galerie&amp;action=showlist&amp;admin" title="Gérer les galeries"><span class="galerie_icon"></span>Gérer les galeries</a>
        <div style="clear:both;"></div>
    </div>
</div>

<div class="home_box">
    <div class="home_box_head">
        Module d'actualités
    </div>
    <div class="home_box_body">
        <h5 style="clear:both;">Informations diverses</h5>
        <ul>
            <li><span class="uf_label">Nombre d'actualités :</span><span class="uf_val"><?php echo $_smarty_tpl->tpl_vars['data']->value['news']['nb_news'];?>
</span></li>
            <li><span class="uf_label">Nombre de catégories :</span><span class="uf_val"><?php echo $_smarty_tpl->tpl_vars['data']->value['news']['nb_news_categ'];?>
</span></li>
            <li><span class="uf_label">Catégorie majeure :</span><span class="uf_val"><?php echo $_smarty_tpl->tpl_vars['data']->value['news']['most_used_categ'];?>
</span></li>
        </ul>
        <div style="clear:both;"></div>
        
        <a class="boutonW hasIcon" style="float:left;margin:20px;margin-bottom:0px;" href="index.php?module=News&amp;model=News&amp;action=showlist&amp;admin" title="Gérer les actualités"><span class="news_icon"></span>Gérer les actualités</a>
        <a class="boutonW hasIcon" style="float:left;margin:20px;margin-bottom:0px;" href="index.php?module=News&amp;model=Newscateg&amp;action=showlist&amp;admin" title="Gérer les catégories"><span class="news_categ_icon"></span>Gérer les catégories</a>
        <div style="clear:both;"></div>
    </div>
</div><?php }} ?>