<?php /* Smarty version Smarty-3.1.7, created on 2012-05-12 00:39:54
         compiled from "core/templates/errors/error500.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10342540244fad953a926244-13435034%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a72bccf50b02f38316ccfb512b6f9bbe1d42bc2f' => 
    array (
      0 => 'core/templates/errors/error500.tpl',
      1 => 1336764773,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10342540244fad953a926244-13435034',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fad953abf5aa',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fad953abf5aa')) {function content_4fad953abf5aa($_smarty_tpl) {?><div id="error">
    <h2>Une erreur interne au serveur s'est produite.</h2>

    <p id="error_sol">Notre système rencontre actuellement des problèmes.<br/>Nous faisons notre possible pour rétablir son bon fonctionnement au plus vite.</p>
</div>

<div class="top_bottom_btns">    
    <a style="float:right;" class="boutonW" href="<?php echo (($tmp = @$_SERVER['HTTP_REFERER'])===null||$tmp==='' ? "index.php" : $tmp);?>
" title="Retour à la page précédente">Retour à la page précédente</a>
    <div style="clear:both;"></div>
</div>

<script type="text/javascript">
    var music = new Audio('core/sounds/SadTrombone.wav');
    music.volume = 0.1;
    music.play();
</script><?php }} ?>