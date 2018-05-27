{* Template principal du site web *}

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" dir="ltr" lang="fr" itemscope itemtype="http://data-vocabulary.org/Person">
<head>
    <meta charset="UTF-8">
<meta name="google-site-verification" content="waNavNZd14-EkU2Plif_eUOyn6lECjgQMBSqasPI7x8" />    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="robots" content="index, follow, noarchive" />
    <meta name="description" content="{$config.site_description}" />
    <meta name="keywords" content="{$config.site_keywords}" />
    <meta name="author" content="{$config.site_author}" /> 
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
    <meta name="generator" content="Eurêka Framework" />
    <meta name="application-name" content="Site web de Valérie Fahrner" />    
    
    <title>{$config.site_title}</title>
    
    <meta itemprop="fn" content="Valérie Fahrner" />
    <meta itemprop="role" content="potière/céramiste" />
    <meta itemprop="org" content="Autoentrepreneur" />
    <meta itemprop="adr" content="4 rue de Hilsenheim - 67820 Wittisheim" />
    <meta itemprop="photo" content="https://www.valeriefahrner.fr/core/images/valerie_fahrner.jpg" />
    
    <base href="{$config.realpath}">

    {foreach $config.css as $css}
        <link type="text/css" rel="stylesheet" media="screen" href="{$css}" />
    {/foreach}
    <link rel="shortcut icon" href="core/images/favicon.png" />
    <link rel="apple-touch-icon" type="image/png" href="core/images/favicon.png" />
    
    <script type="text/javascript" src="core/js/jQuery.js"></script>
    <script type="text/javascript" src="core/js/main.js"></script>
    {if isset($config.async_js)}
        {foreach $config.async_js as $js}
        <script type="text/javascript" src="{$js}" async="async"></script>
        {/foreach}
    {/if}
    
    {if isset($config.js)}
        {foreach $config.js as $js}
        <script type="text/javascript" src="{$js}"></script>
        {/foreach}
    {/if}
    <!--[if IE]>
    <script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js" async="async"></script>
    <![endif]-->
</head>

<body>
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/fr_FR/sdk/xfbml.customerchat.js#xfbml=1&appId=214591485316350&version=v2.12&autoLogAppEvents=1';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>

    <div id="mainWrapper">
        <div id="content">

            {if isset($smarty.session.user)}
                <div id="home">
                    <a rel="nofollow" class="home-login" href="index.php?model=Home" title="Votre espace">votre espace</a>  
                    <a rel="nofollow" class="home-logout" href="index.php?model=User&amp;action=Logout" title="Déconnexion">Déconnexion</a>
                </div>
            {else}
                <div id="home">
                    <a rel="nofollow" class="home-login" href="#" onclick="open_login_form();return false" title="Votre espace">votre espace</a>  
                </div>
            {/if}

            <div id="header"></div>

            {include file='menu.tpl' data=$menu}

            <div id="notifications">
                {foreach $errors as $error}
                    <div class="error-message message"><span class="error-icon"></span>{$error}</div>
                {/foreach}
                {foreach $validations as $validation}
                    <div class="validation-message message"><span class="validation-icon"></span>{$validation}</div>
                {/foreach}
                {foreach $infos as $info}
                    <div class="info-message message"><span class="info-icon"></span>{$info}</div>
                {/foreach}
            </div>

            <div id="page">
                {include file=$template data=$data}
            </div>

            <div id="footer">
                Copyright - Contenu et images protégés par le droit d'auteur - Réalisation <a rel="nofollow" href="https://www.renrhaf.fr" title="visitez mon site">Quentin Fahrner</a>
            </div>
        </div>
        
        <div id="socials">
            <!-- Google +1 button -->
            <div style="float:left;" class="g-plusone" data-annotation="inline" data-width="250" data-href="https://www.valeriefahrner.fr"></div>
            <div style="float:left;" class="fb-like" data-href="https://www.facebook.com/PoterieceramiqueValerieFahrner" data-send="false" data-width="450" data-show-faces="false" data-colorscheme="dark" data-font="tahoma"></div>
        </div>

        <!-- Facebook customer chat code -->
        <div class="fb-customerchat"
             attribution="setup_tool"
             page_id="453907824636236"
             logged_in_greeting="Bienvenue ! :) Une question sur mes créations, mes formations ?"
             logged_out_greeting="Bienvenue ! :) Une question sur mes créations, mes formations ?">
        </div>
    </div>    

    {if !$config.ajax and !isset($smarty.session.user)}
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
    {/if}
    
    {if $config.debug and isset($debug)}
        {include file='debug.tpl' data=$debug}
    {/if}
    
    
    <script type="text/javascript">
        {if isset($config.js_script_append)}
        {foreach $config.js_script_append as $js}
        {$js}
        {/foreach}
        {/if}
        

        {literal}
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
        {/literal}
    </script>
</body>
</html>