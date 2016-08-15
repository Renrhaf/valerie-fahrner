{* Template d'une page chargée en ajax *}

<object>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" dir="ltr" lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- CSS et JS -->
    {if isset($config.css)}
        {foreach $config.css as $css}
        <link type="text/css" rel="stylesheet" media="screen" href="{$css}" />
        {/foreach}
    {/if}
    
    {if isset($config.js)}
        {foreach $config.js as $js}
        <script type="text/javascript" src="{$js}"></script>
        {/foreach}
    {/if}
</head>

<body>
    {include file=$template data=$data}
</body>
</html>
</object>