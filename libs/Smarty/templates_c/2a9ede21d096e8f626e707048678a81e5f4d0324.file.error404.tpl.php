<?php /* Smarty version Smarty-3.1.7, created on 2012-06-04 13:48:08
         compiled from "core/templates/errors/error404.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17457355144fad714817c1e8-45870373%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2a9ede21d096e8f626e707048678a81e5f4d0324' => 
    array (
      0 => 'core/templates/errors/error404.tpl',
      1 => 1338806919,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17457355144fad714817c1e8-45870373',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fad7148197bf',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fad7148197bf')) {function content_4fad7148197bf($_smarty_tpl) {?><div id="error">
    <h2>Désolé, la page que vous demandez est introuvable.</h2>

    <p id="error_sol">Vous pouvez retourner à la page précédente, utiliser le menu<br/> ou lancer une recherche par mots clé pour continuer à naviguer sur le site.</p>
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