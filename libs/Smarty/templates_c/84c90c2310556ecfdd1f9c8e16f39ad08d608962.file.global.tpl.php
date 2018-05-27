<?php /* Smarty version Smarty-3.1.7, created on 2016-08-15 22:21:11
         compiled from "core/layouts/templates/global.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15343502124fad7147f24052-96850690%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '84c90c2310556ecfdd1f9c8e16f39ad08d608962' => 
    array (
      0 => 'core/layouts/templates/global.tpl',
      1 => 1471269492,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15343502124fad7147f24052-96850690',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fad71480ad59',
  'variables' => 
  array (
    'config' => 0,
    'css' => 0,
    'js' => 0,
    'menu' => 0,
    'errors' => 0,
    'error' => 0,
    'validations' => 0,
    'validation' => 0,
    'infos' => 0,
    'info' => 0,
    'template' => 0,
    'data' => 0,
    'debug' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fad71480ad59')) {function content_4fad71480ad59($_smarty_tpl) {?>﻿

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" dir="ltr" lang="fr" itemscope itemtype="http://data-vocabulary.org/Person">
<head>
    <meta charset="UTF-8">
<meta name="google-site-verification" content="waNavNZd14-EkU2Plif_eUOyn6lECjgQMBSqasPI7x8" />    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="robots" content="index, follow, noarchive" />
    <meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['config']->value['site_description'];?>
" />
    <meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['config']->value['site_keywords'];?>
" />
    <meta name="author" content="<?php echo $_smarty_tpl->tpl_vars['config']->value['site_author'];?>
" /> 
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
    <meta name="generator" content="Eurêka Framework" />
    <meta name="application-name" content="Site web de Valérie Fahrner" />    
    
    <title><?php echo $_smarty_tpl->tpl_vars['config']->value['site_title'];?>
</title>
    
    <meta itemprop="fn" content="Valérie Fahrner" />
    <meta itemprop="role" content="potière/céramiste" />
    <meta itemprop="org" content="Autoentrepreneur" />
    <meta itemprop="adr" content="4 rue de Hilsenheim - 67820 Wittisheim" />
    <meta itemprop="photo" content="http://valeriefahrner.fr/core/images/valerie_fahrner.jpg" />
    
    <base href="<?php echo $_smarty_tpl->tpl_vars['config']->value['realpath'];?>
">

    <?php  $_smarty_tpl->tpl_vars['css'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['css']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['config']->value['css']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['css']->key => $_smarty_tpl->tpl_vars['css']->value){
$_smarty_tpl->tpl_vars['css']->_loop = true;
?>
        <link type="text/css" rel="stylesheet" media="screen" href="<?php echo $_smarty_tpl->tpl_vars['css']->value;?>
" />
    <?php } ?>
    <link rel="shortcut icon" href="core/images/favicon.png" />
    <link rel="apple-touch-icon" type="image/png" href="core/images/favicon.png" />
    
    <script type="text/javascript" src="core/js/jQuery.js"></script>
    <script type="text/javascript" src="core/js/main.js"></script>
    <?php if (isset($_smarty_tpl->tpl_vars['config']->value['async_js'])){?>
        <?php  $_smarty_tpl->tpl_vars['js'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['js']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['config']->value['async_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['js']->key => $_smarty_tpl->tpl_vars['js']->value){
$_smarty_tpl->tpl_vars['js']->_loop = true;
?>
        <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
" async="async"></script>
        <?php } ?>
    <?php }?>
    
    <?php if (isset($_smarty_tpl->tpl_vars['config']->value['js'])){?>
        <?php  $_smarty_tpl->tpl_vars['js'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['js']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['config']->value['js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['js']->key => $_smarty_tpl->tpl_vars['js']->value){
$_smarty_tpl->tpl_vars['js']->_loop = true;
?>
        <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
"></script>
        <?php } ?>
    <?php }?>
    <!--[if IE]>
    <script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js" async="async"></script>
    <![endif]-->
</head>

<body>    
    <div id="mainWrapper">
        <div id="content">

            <?php if (isset($_SESSION['user'])){?>
                <div id="home">
                    <a rel="nofollow" class="home-login" href="index.php?model=Home" title="Votre espace">votre espace</a>  
                    <a rel="nofollow" class="home-logout" href="index.php?model=User&amp;action=Logout" title="Déconnexion">Déconnexion</a>
                </div>
            <?php }else{ ?>
                <div id="home">
                    <a rel="nofollow" class="home-login" href="#" onclick="open_login_form();return false" title="Votre espace">votre espace</a>  
                </div>
            <?php }?>

            <div id="header"></div>

            <?php echo $_smarty_tpl->getSubTemplate ('menu.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('data'=>$_smarty_tpl->tpl_vars['menu']->value), 0);?>


            <div id="notifications">
                <?php  $_smarty_tpl->tpl_vars['error'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['error']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['errors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['error']->key => $_smarty_tpl->tpl_vars['error']->value){
$_smarty_tpl->tpl_vars['error']->_loop = true;
?>
                    <div class="error-message message"><span class="error-icon"></span><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</div>
                <?php } ?>
                <?php  $_smarty_tpl->tpl_vars['validation'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['validation']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['validations']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['validation']->key => $_smarty_tpl->tpl_vars['validation']->value){
$_smarty_tpl->tpl_vars['validation']->_loop = true;
?>
                    <div class="validation-message message"><span class="validation-icon"></span><?php echo $_smarty_tpl->tpl_vars['validation']->value;?>
</div>
                <?php } ?>
                <?php  $_smarty_tpl->tpl_vars['info'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['info']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['infos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['info']->key => $_smarty_tpl->tpl_vars['info']->value){
$_smarty_tpl->tpl_vars['info']->_loop = true;
?>
                    <div class="info-message message"><span class="info-icon"></span><?php echo $_smarty_tpl->tpl_vars['info']->value;?>
</div>
                <?php } ?>
            </div>

            <div id="page">
                <?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['template']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('data'=>$_smarty_tpl->tpl_vars['data']->value), 0);?>

            </div>

            <div id="footer">
                Copyright - Contenu et images protégés par le droit d'auteur - Réalisation <a rel="nofollow" href="http://www.renrhaf.fr" title="visitez mon site">Quentin Fahrner</a>    
            </div>
        </div>
        
        <div id="socials">
        <!-- Google +1 button -->
        <div style="float:left;" class="g-plusone" data-annotation="inline" data-width="250" data-href="https://www.valeriefahrner.fr"></div>
        <div id="fb-root" style="float:left;"></div>
        <div style="float:left;" class="fb-like" data-href="https://www.facebook.com/PoterieceramiqueValerieFahrner" data-send="false" data-width="450" data-show-faces="false" data-colorscheme="dark" data-font="tahoma"></div>
        
        <div style="float:right;">
            <a href="http://www.w3.org/html/logo/">
                <img width="80" height="25" src="core/images/html5-badge.png" alt="HTML5 Powered with CSS3 / Styling, Semantics, and Offline &amp; Storage" title="HTML5 Powered with CSS3 / Styling, Semantics, and Offline &amp; Storage">
            </a>
        </div>
        </div>
    </div>    

    <?php if (!$_smarty_tpl->tpl_vars['config']->value['ajax']&&!isset($_SESSION['user'])){?>
        <img id="backImg" src="core/images/space.jpg" style="display:none;" />
        <div id="login-embedded" style="display: none;">
            <a rel="nofollow" id="close-login" href="#" title="fermer"></a>
            <div id="embedded-login">
                <h3 id="TemLog">Accès à votre espace personnel</h3>

                <form name="loginForm" action="index.php?model=User&amp;action=Login" method="post" id="loginForm">
                    <div>
                        <div>
                            <label id="label_mail" for="mail" class="label"><span class="mail_icon"></span>Adresse e-mail</label>
                            <input id="mail" value="" name="mail" maxlength="320" type="text" tabindex="1" class="input" />
                            <div style="clear:both;"></div>
                        </div>

                        <div id="passP">
                            <label id="label_password" for="password" class="label"><span class="password_icon"></span>Mot de passe</label>
                            <input id="password" name="password" maxlength="16" type="password" tabindex="2" autocomplete="off" class="input" />
                            <div style="clear:both;"></div>

                            <input type="checkbox" name="saveInfo" id="saveInfo" style="float:left;margin:4px;" />
                            <label>Mémoriser mes informations</label>
                            <div style="clear:both;"></div>
                        </div>

                        <p style="margin-top:5px;">
                            <input id="submitButton" class="boutonB" type="submit" value="Se connecter" onclick="save_infos();" />
                            <input id="forgotPassword" class="boutonW" type="reset" style="text-align:center; float:right;" value="Identifiants oubliés ?" onclick="into_forgot_form(); return false;">
                        </p>
                        <div style="clear:both;"></div>
                    </div>
                </form>
            </div>
        </div>
        <div id="blackout" style="display: none;"></div>
    <?php }?>
    
    <?php if ($_smarty_tpl->tpl_vars['config']->value['debug']&&isset($_smarty_tpl->tpl_vars['debug']->value)){?>
        <?php echo $_smarty_tpl->getSubTemplate ('debug.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('data'=>$_smarty_tpl->tpl_vars['debug']->value), 0);?>

    <?php }?>
    
    
    <script type="text/javascript">
        <?php if (isset($_smarty_tpl->tpl_vars['config']->value['js_script_append'])){?>
        <?php  $_smarty_tpl->tpl_vars['js'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['js']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['config']->value['js_script_append']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['js']->key => $_smarty_tpl->tpl_vars['js']->value){
$_smarty_tpl->tpl_vars['js']->_loop = true;
?>
        <?php echo $_smarty_tpl->tpl_vars['js']->value;?>

        <?php } ?>
        <?php }?>
        

        
        // Google +1 button
        window.___gcfg = {lang: 'fr'};
        $.getScript('https://apis.google.com/js/plusone.js');
        // Facebook like button
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id; js.async = true;
            js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1&amp;appId=214591485316350";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk')); 
        // google analytics
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-22877755-2']);
        _gaq.push(['_trackPageview']);
        var src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        $.getScript(src);
        
    </script>
</body>
</html><?php }} ?>