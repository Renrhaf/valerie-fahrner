<?php /* Smarty version Smarty-3.1.7, created on 2016-08-15 15:53:30
         compiled from "core/templates/page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17504507584fad7151f3c8b8-82747473%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b4118d743b27ab8a951c7cd4843c15c04ec2d7d1' => 
    array (
      0 => 'core/templates/page.tpl',
      1 => 1471178385,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17504507584fad7151f3c8b8-82747473',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fad715207145',
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fad715207145')) {function content_4fad715207145($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/var/www/valerie/libs/Smarty/plugins/modifier.date_format.php';
?><div style="position:relative;">
<h3 class="page_title"><?php echo $_smarty_tpl->tpl_vars['data']->value['page']['page_title'];?>
</h3>

<?php if (isset($_SESSION['user'])){?>
<div class="commands" style="position:absolute;top:5px;right:0px;">
    <a href="index.php?model=Page&amp;action=Editform&amp;pk=<?php echo $_smarty_tpl->tpl_vars['data']->value['page']['page_id'];?>
&amp;admin" title="Editer" class="btn_edit"></a>
</div>
<?php }?>
</div>


<div>
    <?php echo $_smarty_tpl->tpl_vars['data']->value['page']['page_content'];?>

</div>

<h6 style="text-align:center; font-size:xx-small;">Dernière modification le <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['page']['page_updated'],"%d/%m/%Y à %Hh%M");?>
</h6><?php }} ?>