/* 
 * Fonctions javascript utiles coté administration - backoffice
 */

/**
 * Lance l'activation/désactivation d'un objet en AJAX
 */
function activate(elem, module, model, id){
    if($(elem).hasClass('btn_active')){
        val = 0;
    } else {
        val = 1;
    }
    
    $.ajax({
        url: "index.php?module="+module+"&model="+model+"&action=Activate&pk="+id+"&val="+val+"&admin",
        dataType: "JSON",
        success: function(data){
            if(data.validation){
                notification('validation', data.validation);
                if(val == 0){
                    $(elem).attr('title', 'Activer').removeClass('btn_active').addClass('btn_busy');
                } else {
                    $(elem).attr('title', 'Désactiver').removeClass('btn_busy').addClass('btn_active');
                }
            } else {
                if(isArray(data.error)){
                    $.each(data.error, function(idx, cont){
                        notification('error', cont);
                    });
                } else {
                    notification('error', data.error);
                }
            }
        }
    });
}

/**
 * Lance la suppression d'un objet en AJAX
 */
function delet(elem, module, model, id, elemToRemove){
    if(confirm('Etes-vous sûr ?')){
        $.ajax({
            url: "index.php?module="+module+"&model="+model+"&action=Delete&pk="+id+"&admin",
            dataType: "JSON",
            success: function(data){
                if(data.validation){
                    notification('validation', data.validation);
                    if(!elemToRemove){
                        $(elem).parents('tr').fadeOut(200, function(){ $(this).remove(); });
                    } else {
                        $(elemToRemove).fadeOut(200, function(){ $(this).remove(); });
                    }
                } else {                    
                    if(isArray(data.error)){
                        $.each(data.error, function(idx, cont){
                            notification('error', cont);
                        });
                    } else {
                        notification('error', data.error);
                    }
                }
                
                if(data.redirect){
                    notification('info', 'Redirection dans '+(data.redirect.wait/1000)+' sec');
                    setTimeout(function(){document.location.href = data.redirect.location;}, data.redirect.wait);
                }
            }
        });
    }
}

/**
 * Mise en maintenance du site
 */
function putSiteInMaintenance(status){
    var do_it = true;
    if(status){
        status = 1;
        var estimated_duration = prompt('Combien de temps pensez-vous que la maintenance va durer ?', '2 heures');
        if(estimated_duration == null || estimated_duration == ''){
            do_it = false;
            alert('Vous n\'avez pas donné une durée... La mise en maintenance est annulée');
        }
    } else {
        status = 0;
    }

    if(do_it){
        $.ajax({
            url: "index.php?model=Site&action=Setmaintenance&status="+status+"&admin"+((estimated_duration != null)?'&estimated='+estimated_duration:''),
            dataType: "JSON",
            success: function(data){
                if(data.validation){
                    notification('validation', data.validation);
                    if(status == 1){
                        $('#putInMaintenance').hide();
                        $('#putOutOfMaintenance').show();
                    } else {
                        $('#putInMaintenance').show();
                        $('#putOutOfMaintenance').hide();
                    }
                } else {
                    if(isArray(data.error)){
                        $.each(data.error, function(idx, cont){
                            notification('error', cont);
                        });
                    } else {
                        notification('error', data.error);
                    }
                }
            }
        });
    }
}
