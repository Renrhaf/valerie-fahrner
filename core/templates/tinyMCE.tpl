{* Ce template doit être inclus lors de l'utilisation de TinyMCE *}

<script type="text/javascript">
{literal}    
    tinyMCE.init({
        // ne pas modifier
        mode : "textareas",
        width:"100%",
        language : "fr",
        theme : "advanced",
        plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
        content_css : "core/css/styles.css",
        theme_advanced_buttons2 : "bold,italic,underline,strikethrough,|,sub,sup,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect,|,forecolor,backcolor,|,nonbreaking",
        theme_advanced_buttons1 : "newdocument,print,fullscreen,preview,|,undo,redo,|,cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,|,blockquote,link,unlink,anchor,|,image,charmap,emotions,iespell,media,|,insertdate,inserttime,advhr",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,abbr,del,ins,attribs,|,cleanup,code",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
        theme_advanced_path : false,
        template_external_list_url : "js/template_list.js",
        external_link_list_url : "js/link_list.js",
        external_image_list_url : "js/image_list.js",
        media_external_list_url : "js/media_list.js",
        // on ajoute la possibilité de mettre une balise <style>
        valid_children : "+body[style]",

        // Style formats : à ajouter ici
        style_formats : [
                {title : 'Bouton blanc', inline: 'span', classes : 'boutonW'},
                {title : 'Bouton noir', inline: 'span', classes : 'boutonB'},
                {title : 'Styles pour tableaux'},
                {title : 'Lignes impaires', block: 'tr', classes : 'odd'}
        ],
            
        file_browser_callback : "ajaxfilemanager"
    });  
   
    // file &amp; image manager
    function ajaxfilemanager(field_name, url, type, win) {
        var view = 'detail';
        switch (type) {
            case "image":
                view = 'thumbnail';
                break;
            case "media":
                break;
            case "flash": 
                break;
            case "file":
                break;
            default:
                return false;
        }
        tinyMCE.activeEditor.windowManager.open({
            url: "libs/tinymce/jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php?view=" + view,
            width: 782,
            height: 440,
            inline : "yes",
            close_previous : "no"
        },{
            window : win,
            input : field_name
        });
    }
{/literal}   
</script>