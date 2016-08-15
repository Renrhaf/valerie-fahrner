<?php /* Smarty version Smarty-3.1.7, created on 2012-05-11 23:25:49
         compiled from "core/templates/errors/error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15034474364fad83ddeddb42-85126427%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5a9a835e8041140b1b7237271252b46c2b4ba2c9' => 
    array (
      0 => 'core/templates/errors/error.tpl',
      1 => 1336762225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15034474364fad83ddeddb42-85126427',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fad83ddf3419',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fad83ddf3419')) {function content_4fad83ddf3419($_smarty_tpl) {?><h3 class="page_title">Un problème est survenu :</h3>
   
<?php if (isset($_smarty_tpl->tpl_vars['data']->value['simple'])){?>
    <div class="ptext" style="margin-left:50px;margin-right:50px;"><?php echo $_smarty_tpl->tpl_vars['data']->value['simple'];?>
</div>
<?php }else{ ?>
    <p class="ptext" style="margin-left:50px;margin-right:50px;"><?php echo $_smarty_tpl->tpl_vars['data']->value['message'];?>
</p>
<?php }?>
        
<div class="top_bottom_btns">    
    <a style="float:right;" class="boutonW" href="<?php echo (($tmp = @$_SERVER['HTTP_REFERER'])===null||$tmp==='' ? "index.php" : $tmp);?>
" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div><?php }} ?>