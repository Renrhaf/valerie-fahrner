<?php /* Smarty version Smarty-3.1.7, created on 2016-08-15 15:53:38
         compiled from "core/templates/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:401001554fad714813f099-37035293%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0bb98d68c0ff58d107b073261865fb698359de48' => 
    array (
      0 => 'core/templates/menu.tpl',
      1 => 1471178382,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '401001554fad714813f099-37035293',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fad7148168de',
  'variables' => 
  array (
    'data' => 0,
    'config' => 0,
    'menu' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fad7148168de')) {function content_4fad7148168de($_smarty_tpl) {?><div id="menu">
    <ul>
        <?php  $_smarty_tpl->tpl_vars['menu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['menus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menu']->key => $_smarty_tpl->tpl_vars['menu']->value){
$_smarty_tpl->tpl_vars['menu']->_loop = true;
?>
            <?php if ($_smarty_tpl->tpl_vars['config']->value['realpath']==$_smarty_tpl->tpl_vars['menu']->value['menu_block_link']){?>
                <li class="menublock">
                    <span class="menuAG menu_limit"></span>
                        <a class="menuA" href="<?php echo $_smarty_tpl->tpl_vars['menu']->value['menu_block_link'];?>
"><?php echo $_smarty_tpl->tpl_vars['menu']->value['menu_block_title'];?>
</a>
                    <span class="menuAD menu_limit"></span>
                </li>
            <?php }else{ ?>
                <li class="menublock">
                    <span class="menuG menu_limit"></span>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['menu']->value['menu_block_link'];?>
"><?php echo $_smarty_tpl->tpl_vars['menu']->value['menu_block_title'];?>
</a>
                    <span class="menuD menu_limit"></span>
                </li>
            <?php }?>
        <?php } ?>
    </ul>
    <div style="clear:both;"></div>
</div><?php }} ?>