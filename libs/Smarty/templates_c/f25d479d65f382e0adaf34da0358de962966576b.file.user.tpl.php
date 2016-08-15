<?php /* Smarty version Smarty-3.1.7, created on 2012-05-11 23:17:01
         compiled from "core/templates/user.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17384288884fad81cd56d686-77872499%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f25d479d65f382e0adaf34da0358de962966576b' => 
    array (
      0 => 'core/templates/user.tpl',
      1 => 1336762212,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17384288884fad81cd56d686-77872499',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fad81cd600f4',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fad81cd600f4')) {function content_4fad81cd600f4($_smarty_tpl) {?><?php if (!is_callable('smarty_function_mailto')) include '/homepages/23/d369665974/htdocs/valerie/libs/Smarty/plugins/function.mailto.php';
if (!is_callable('smarty_modifier_date_format')) include '/homepages/23/d369665974/htdocs/valerie/libs/Smarty/plugins/modifier.date_format.php';
?><div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="index.php">Accueil</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?model=User&amp;action=show&amp;pk=<?php echo $_smarty_tpl->tpl_vars['data']->value['user_id'];?>
">Visualisation d'un profil</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<h3 class="page_title"><?php echo $_smarty_tpl->tpl_vars['data']->value['user_fname'];?>
 <?php echo $_smarty_tpl->tpl_vars['data']->value['user_lname'];?>
</h3>

<div id="user_profil" style="margin:20px;">
    <div id="profil_picture" style="border:1px solid black; float:left;">
        <?php if (isset($_smarty_tpl->tpl_vars['data']->value['user_image_url'])){?>
            <img src="uploads/images/<?php echo $_smarty_tpl->tpl_vars['data']->value['user_image_url'];?>
" title="Photo de profil" alt="Photo de profil" />            
        <?php }else{ ?>
            <img src="core/images/icones/default_user.png" title="Aucune photo définie" alt="Aucune photo définie" />            
        <?php }?>
    </div>
    
    <div id="profil_infos">
        <pre>
        Mail :              <?php echo smarty_function_mailto(array('address'=>$_smarty_tpl->tpl_vars['data']->value['user_mail'],'encode'=>"hex"),$_smarty_tpl);?>
 

        Site web :          <a href="<?php echo $_smarty_tpl->tpl_vars['data']->value['user_website'];?>
" title="Voir le site web de <?php echo $_smarty_tpl->tpl_vars['data']->value['user_fname'];?>
 <?php echo $_smarty_tpl->tpl_vars['data']->value['user_lname'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['user_website'];?>
</a>

        Profession :        <?php echo $_smarty_tpl->tpl_vars['data']->value['profession']['profession_name'];?>


        Date de création :  <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['user_created'],"%d/%m/%Y à %Hh%M");?>

        </pre>
    </div>
    
</div>
<div style="clear:both;"></div>

<?php }} ?>