/**
 * Lancé dès que le DOM est chargé
 */
$(document).ready(function(){
   // on ajoute les boutons de fermeture des notifications
   addCloseButtonToNotifications();
});

/**
 * Ajoute un bouton pour fermer les messages de notification
 */
function addCloseButtonToNotifications(){
    $('.message').mouseenter(function(){
        $(this).find('.close-message').show();
    }).mouseleave(function(){
        $(this).find('.close-message').hide();
    }).click(function(){
        $(this).remove();
    }).delay(15000).fadeOut(400, function(){
        $(this).remove();
    });
}

/**
 * Supprime les accents d'une chaîne de caractères
 */
function AccentToNoAccent(str) {
    var norm = new Array('À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë',
    'Ì','Í','Î','Ï', 'Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý',
    'Þ','ß', 'à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î',
    'ï','ð','ñ', 'ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ý','þ','ÿ');
    var spec = new Array('A','A','A','A','A','A','A','C','E','E','E','E',
    'I','I','I','I', 'D','N','O','O','O','0','O','O','U','U','U','U','Y',
    'b','s', 'a','a','a','a','a','a','a','c','e','e','e','e','i','i','i',
    'i','d','n', 'o','o','o','o','o','o','u','u','u','u','y','y','b','y');
    for (var i = 0; i < spec.length; i++)
        str = replaceAll(str, norm[i], spec[i]);
    return str;
}

/**
 * Remplace les occurences de search par repl dans str
 */
function replaceAll(str, search, repl) {
    while (str.indexOf(search) != -1)
        str = str.replace(search, repl);
    return str;
}

/**
 * Fonction de tri des données
 * Utilisée notamment interface admin 
 * pour le tri des colonnes de la DB
 */
function order_by(elem, field){
    $('.top_bottom_btns').find('form').each(function(){
        var input_tri = $(this).find('input[name="tri"]');
        if($(input_tri).length == 0){
            $(this).append('<input type="hidden" name="tri" value="'+field+'" />');
        } else {
            $(input_tri).val(field);
        }
        
        var ordre_input = $(this).find('input[name="ord"]');
        if($(ordre_input).length == 0){
            $(this).append('<input type="hidden" name="ord" value="asc" />');
        } else {
            if($(ordre_input).val() == 'asc'){
                $(ordre_input).val('desc');
            } else {
                $(ordre_input).val('asc');
            }
        }
        
        $(this).submit();
    });
}

/**
 * Génére une notification à l'utilisateur
 */
function notification(type, message, duree){
    if(duree == null){
        duree = 2000;
    }
    
    var html = '';
    if(type == 'validation'){
        html = '<div class="validation-message message"><span class="validation-icon"></span>'+message+'</div>';
    } else if(type == 'error'){
        html = '<div class="error-message message"><span class="error-icon"></span>'+message+'</div>';
    } else {
        html = '<div class="info-message message"><span class="info-icon"></span>'+message+'</div>';
    }
    
    var notif = $(html);
    $(notif).mouseenter(function(){
        $(this).find('.close-message').show();
    }).mouseleave(function(){
        $(this).find('.close-message').hide();
    }).click(function(){
        $(this).remove();
    });    
    $(notif).hide().appendTo('#notifications').fadeIn(400).delay(duree).fadeOut(400, function(){
        $(this).remove();
    });  
}

/**
 * Ouvre une boite de contrôle pour charger du contenu en AJAX
 */
function openBoxAjax(MyUrl , Mytitle , MyW , MyH){
	if(MyW){}else{
		var MyW = parseInt($(window).width())-200;
		if(MyW < 200){ MyW = 200;}
	}
	if(MyH){}else{
		var MyH = parseInt($(window).height()) -50;
		if(MyH < 200){ MyH = 200;}
	}
	if($('#OpenBoxAjax').length != 0){
		$('#OpenBoxAjax').remove();
	}
	$("body").append('<div id="OpenBoxAjax" title="'+Mytitle+'"></div>');
	if(MyH < 0) {
		$('#OpenBoxAjax').dialog({ autoOpen: false, draggable: false, resizable: false, modal:true, width: MyW, open: function() { $('#OpenBoxAjax').load(MyUrl); } });
	}else{
		$('#OpenBoxAjax').dialog({ autoOpen: false, draggable: false, resizable: false, modal:true, width: MyW, height: MyH, open: function() { $('#OpenBoxAjax').load(MyUrl); } });
	}$('#OpenBoxAjax').dialog('open');
}

/**
 * Teste si l'objet est un tableau
 */
function isArray(obj){
    if(obj != null && obj != undefined){
        if (obj.constructor.toString().indexOf("Array") == -1)
            return false;
        else
            return true;
    } else {
        return false;
    }
}