<?php /* Smarty version Smarty-3.1.7, created on 2012-06-05 14:23:51
         compiled from "core/templates/errors/error401.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13295174194fad7157901b94-69768997%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2f27a595b9deb511b01df12dd29a4d09dfa921d5' => 
    array (
      0 => 'core/templates/errors/error401.tpl',
      1 => 1338806919,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13295174194fad7157901b94-69768997',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fad715796011',
  'variables' => 
  array (
    'config' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fad715796011')) {function content_4fad715796011($_smarty_tpl) {?><div id="error">
    <h2>Vous n'êtes pas autorisé à accèder à cette page !</h2>

    <p id="error_sol">Cette page nécessite des privilèges dont vous ne disposez pas actuellement.<br/> Si vous pensez que ce n'est pas le comportement normal, <a href="<?php echo $_smarty_tpl->tpl_vars['config']->value['realpath'];?>
contactez-nous">contactez-nous</a>.</p>
</div>

<div class="top_bottom_btns">    
    <a style="float:right;" class="boutonW" href="<?php echo (($tmp = @$_SERVER['HTTP_REFERER'])===null||$tmp==='' ? "index.php" : $tmp);?>
" title="Retour à la page précédente">Retour à la page précédente</a>
    <div style="clear:both;"></div>
</div>
    

<script type="text/javascript">
    var music = new Audio('core/sounds/WoopWoop.wav');
    music.volume = 0.1;
    music.play();
    
    var i = true;
    $(document).ready(function(){
        setTimeout(switchBackground,1000);
    });
        
    function switchBackground(){
        if(i){
            $('#error').css('background-image','url(\'core/images/exclamation2.gif\')');
            i = false;
         } else {
            $('#error').css('background-image','url(\'core/images/exclamation.gif\')');
            i = true;
         }
         setTimeout(switchBackground,1000);
    }
</script>
<?php }} ?>