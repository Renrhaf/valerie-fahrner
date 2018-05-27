{* Template principal du site web *}

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" dir="ltr" lang="fr" itemscope itemtype="http://data-vocabulary.org/Person">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
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
    <meta itemprop="photo" content="http://valeriefahrner.fr/core/images/valerie_fahrner.jpg" />

    {foreach $config.css as $css} <link type="text/css" rel="stylesheet" media="screen" href="{$css}" /> {/foreach}
    {foreach $config.js as $js} <script type="text/javascript" src="{$js}"></script> {/foreach}

    <link rel="shortcut icon" href="core/images/favicon.png">
    <link rel="apple-touch-icon" type="image/png" href="core/images/favicon.png" />
    
    {literal}
    <script type="text/javascript">
        // Google +1 button
        window.___gcfg = {lang: 'fr'};
        (function() {
            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
            po.src = 'https://apis.google.com/js/plusone.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
        })();

        // google analytics
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-22877755-2']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>
    {/literal}
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
    }(document, 'script', 'facebook-jssdk'));</script>
    
    <div id="mainWrapper">
        <div id="content">

            {if isset($smarty.session.user)}
                <div id="home">
                    <a rel="nofollow" class="home-login" href="index.php?model=Home" title="Votre espace">votre espace</a>  
                    <a rel="nofollow" class="home-logout" href="index.php?model=User&amp;action=Logout" title="Déconnexion">Déconnexion</a>
                </div>
            {else}
                <div id="home">
                    <a rel="nofollow" class="home-login" href="index.php?model=User&amp;action=Loginform" onclick="open_login_form();return false" title="Votre espace">votre espace</a>  
                </div>
            {/if}

            {include file='header.tpl'}

            {include file='menu_list.tpl' data=$menu}

            <div id="notifications">
                {foreach $errors as $error}
                    <div class="error-message message">{$error}</div>
                {/foreach}
                {foreach $validations as $validation}
                    <div class="validation-message message">{$validation}</div>
                {/foreach}
                {foreach $infos as $info}
                    <div class="info-message message">{$info}</div>
                {/foreach}
            </div>

            <div id="page">
                {include file=$template data=$data}
            </div>

            {include file='footer.tpl'}
        </div>
        
        <div id="socials">
            <!-- Google +1 button -->
            <div style="float:left;" class="g-plusone" data-annotation="inline" data-width="250" data-href="http://www.valeriefahrner.fr"></div>
            <div id="fb-root" style="display:none;"></div>
            <div style="float:right;" class="fb-like" data-href="http://www.valeriefahrner.fr" data-send="false" data-width="450" data-show-faces="false" data-colorscheme="dark" data-font="tahoma"></div>
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
        {include file='loginform.tpl'}
    {/if}
    
</body>
</html>
