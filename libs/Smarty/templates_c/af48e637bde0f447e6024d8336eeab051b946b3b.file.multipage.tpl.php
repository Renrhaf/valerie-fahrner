<?php /* Smarty version Smarty-3.1.7, created on 2012-06-04 12:49:21
         compiled from "core/templates/multipage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7458849244fad71e0789887-66679381%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'af48e637bde0f447e6024d8336eeab051b946b3b' => 
    array (
      0 => 'core/templates/multipage.tpl',
      1 => 1338806910,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7458849244fad71e0789887-66679381',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fad71e07efb1',
  'variables' => 
  array (
    'name' => 0,
    'val' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fad71e07efb1')) {function content_4fad71e07efb1($_smarty_tpl) {?>

<form method="GET" action="index.php">
    <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['name'] = new Smarty_Variable;
 $_from = $_GET; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['name']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
        <input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['val']->value;?>
" />
    <?php } ?>
        
    <?php if ($_smarty_tpl->tpl_vars['data']->value['nb_pages']>1){?>
    <div class="multipage"> 
        <?php if ($_smarty_tpl->tpl_vars['data']->value['page']-1>0){?>
        <button class="boutonW" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['page']-1;?>
" onclick="$(this).next('select').find('option:selected').prev('option').attr('selected', 'selected');">
           Page précédente
        </button>
        <?php }else{ ?>
        <input type="button" class="boutonI" value="Page précédente" />
        <?php }?>
        <select name="page" class="select" style="padding:2px 1px 3px 1px;width:85px;" onchange="$(this).parents('form').submit();">
            <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['pages'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['pages']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['name'] = 'pages';
$_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['start'] = (int)1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['data']->value['nb_pages']+1) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['step'] = ((int)1) == 0 ? 1 : (int)1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['loop'];
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['pages']['total']);
?>
            <option value="<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['pages']['index'];?>
" <?php if ($_smarty_tpl->getVariable('smarty')->value['section']['pages']['index']==$_smarty_tpl->tpl_vars['data']->value['page']){?>selected="selected"<?php }?>>Page <?php echo $_smarty_tpl->getVariable('smarty')->value['section']['pages']['index'];?>
</option>
            <?php endfor; endif; ?>
        </select>

        <?php if ($_smarty_tpl->tpl_vars['data']->value['page']+1<=$_smarty_tpl->tpl_vars['data']->value['nb_pages']){?>
        <button class="boutonW" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['page']+1;?>
" onclick="$(this).prev('select').find('option:selected').next('option').attr('selected', 'selected');">
            Page suivante
        </button>
        <?php }else{ ?>
        <input type="button" class="boutonI" value="Page suivante" />
        <?php }?>
    </div>
    <?php }?>
        
</form>

<?php }} ?>