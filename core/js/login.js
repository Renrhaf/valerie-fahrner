/**
 * Ouvre le formulaire de connexion
 */
function open_login_form(){
    if(localStorage.getItem('mail') != null){
        $('#saveInfo').attr('checked','checked');
        $('#mail').val(localStorage.getItem('mail'));
        $('#password').val(localStorage.getItem('password'));
    }

    $('#login-embedded').add('#blackout').add('#backImg').fadeIn(500);
    $('#login-embedded').find('input:first').focus();    
    $('#blackout').add('#close-login').click(function(){
        if($(this).is(':visible')){
            $('#login-embedded').add('#blackout').add('#backImg').fadeOut(500);
        }
    });
}

/**
 * Enregistre en local les infos de connection
 * Utilise la puissance du localStorage de l'HTML5 !
 */
function save_infos(){
    if($('#saveInfo').attr('checked') == 'checked'){
        localStorage.setItem('mail', $('#mail').val());
        localStorage.setItem('password', $('#password').val());
    } else {
        if(localStorage.getItem('mail') != null){
            localStorage.removeItem('mail');
            localStorage.removeItem('password');
        }
    }
}

/**
 * Transforme le formulaire de connexion pour réinitialisation du mot de passe
 */
function into_forgot_form(){
    $('#forgotPassword').val('Annuler');
    $('#forgotPassword').attr('onclick','restore_login_form(); return false;')
    $('#loginForm').attr('action','index.php?model=User&action=Send');
    $('#submitButton').val('Valider');
    $('#TemLog').html('Réinitialisation du mot de passe');
    $('#passP').hide();
}

/**
 * Restore le formulaire de connexion
 */
function restore_login_form(){
    $('#forgotPassword').val('Identifiants oubliés ?');
    $('#forgotPassword').attr('onclick','into_forgot_form(); return false;')
    $('#loginForm').attr('action','index.php?model=User&action=Login');
    $('#submitButton').val('Se connecter');
    $('#TemLog').html('Accès à votre espace personnel');
    $('#passP').show();
}


$(document).ready(function(){ 
 
/* background resizable */    
function redimensionnement(){ 
 
    var image_width = $('#backImg').width(); 
    var image_height = $('#backImg').height();     
     
    var over = image_width / image_height; 
    var under = image_height / image_width; 
     
    var body_width = $(window).width(); 
    var body_height = $(window).height(); 
     
    if (body_width / body_height >= over) { 
      $('#backImg').css({ 
        'width': body_width + 'px', 
        'height': Math.ceil(under * body_width) + 'px', 
        'left': '0px', 
        'top': Math.abs((under * body_width) - body_height) / -2 + 'px' 
      }); 
    }  
     
    else { 
      $('#backImg').css({ 
        'width': Math.ceil(over * body_height) + 'px', 
        'height': body_height + 'px', 
        'top': '0px', 
        'left': Math.abs((over * body_height) - body_width) / -2 + 'px' 
      }); 
    } 
} 
         
    redimensionnement(); //onload 
     
    $(window).resize(function(){ 
        redimensionnement(); 
    }); 
 
}); 