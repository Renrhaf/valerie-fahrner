<?php /* Smarty version Smarty-3.1.7, created on 2012-06-04 13:06:22
         compiled from "core/templates/debug.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16538893554fad8379d6ae32-28810778%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f25caf1c0c5fb8e1e3022c8a86693c78d0e57d4' => 
    array (
      0 => 'core/templates/debug.tpl',
      1 => 1338806906,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16538893554fad8379d6ae32-28810778',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fad8379e464b',
  'variables' => 
  array (
    'debug' => 0,
    'info' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fad8379e464b')) {function content_4fad8379e464b($_smarty_tpl) {?><div id="debug-infos">
    <div id="debug-controls" title="Augmenter la taille" class="debug-up"></div>
    
    <div class="debug-info debug-info-first">
        <span class="debug-title">
            Title
        </span>
        <span class="debug-message">
            Message
        </span>
        <span class="debug-time">
            Time
        </span>
        <div style="clear:both;"></div>
    </div> 
    <?php  $_smarty_tpl->tpl_vars['info'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['info']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['debug']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['info']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['info']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['info']->key => $_smarty_tpl->tpl_vars['info']->value){
$_smarty_tpl->tpl_vars['info']->_loop = true;
 $_smarty_tpl->tpl_vars['info']->iteration++;
 $_smarty_tpl->tpl_vars['info']->last = $_smarty_tpl->tpl_vars['info']->iteration === $_smarty_tpl->tpl_vars['info']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['debuginfos']['last'] = $_smarty_tpl->tpl_vars['info']->last;
?>
        <div class="debug-info<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['debuginfos']['last']){?> debug-info-last<?php }?><?php if ($_smarty_tpl->tpl_vars['info']->value['title']=='Redirection'){?> debug-info-redirection<?php }?>">
            <span class="debug-title">
                <?php echo $_smarty_tpl->tpl_vars['info']->value['title'];?>

            </span>
            <span class="debug-message">
                <?php echo $_smarty_tpl->tpl_vars['info']->value['message'];?>

            </span>
            <span class="debug-time">
                <?php echo sprintf("%.5f",$_smarty_tpl->tpl_vars['info']->value['time']);?>

            </span>
            <div style="clear:both;"></div>
        </div>  
    <?php } ?>
</div>


<script type="text/javascript">
$('.debug-info', '#debug-infos').hide();
$('.debug-info-last', '#debug-infos').show();

$('#debug-controls').click(function(){
    if($(this).hasClass('debug-up')){
        $(this).removeClass('debug-up');
        $(this).attr('title','Réduire la taille');
        $(this).addClass('debug-down');
        $('.debug-info', '#debug-infos').show();
        $(this).css({
            position: 'absolute',
            top: '10px'
        });
        $(this).parent('div').animate({
            height: '100%'
        }, function(){
            $('#debug-controls').css({
                position: 'fixed',
                top: '10px'
            });
        });
    } else {
        $(this).removeClass('debug-down');
        $(this).attr('title','Augmenter la taille');
        $(this).addClass('debug-up');
        $(this).css({
            position: 'absolute',
            top: '10px'
        });
        $(this).parent('div').animate({
            height: '32px'
        }, function(){
            $('#debug-controls').css({
                position: '',
                bottom: '',
                top: ''
            });
            $('.debug-info', '#debug-infos').hide();
            $('.debug-info-last', '#debug-infos').show();
        });
    }
});
</script>
<?php }} ?>