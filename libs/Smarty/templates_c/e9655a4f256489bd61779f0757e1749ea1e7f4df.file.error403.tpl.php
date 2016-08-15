<?php /* Smarty version Smarty-3.1.7, created on 2016-08-15 15:53:38
         compiled from "core/templates/errors/error403.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6580686334fad71a5baa911-11164178%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e9655a4f256489bd61779f0757e1749ea1e7f4df' => 
    array (
      0 => 'core/templates/errors/error403.tpl',
      1 => 1471178388,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6580686334fad71a5baa911-11164178',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fad71a5c0625',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fad71a5c0625')) {function content_4fad71a5c0625($_smarty_tpl) {?><div id="error">
    <h2>Vous n'êtes pas autorisé à accèder à ce fichier !</h2>

    <p id="error_sol">Pour des raisons de sécurité, l'accès à cette ressource est strictement interdit.<br/> Merci de votre compréhension.</p>
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