
/**
 * désactivation de la validation du formulaire avec ENTER
 */
function isEnterTouch(e){
    if(window.event){
        e = window.event;
    }
    if(e.type=="keypress" && e.keyCode==13){
        return false;  
    }
}
document.onkeypress = isEnterTouch;

$(document).ready(function(){
    // traitement lors de l'ajout d'un mot clé
    $('#new_keyword').keyup(function(e){
        if(e.which == 13){
            // touche ENTER
            if($('.s_selected','#suggestions').length == 0){
                var add = true;
                var value = AccentToNoAccent($('#new_keyword').val().toUpperCase());
                $('li','#suggestions').each(function(){
                    if(AccentToNoAccent($(this).html().toUpperCase()) == value){
                        add = false;
                        $('<li id="'+$(this).attr('id')+'"><input type="hidden" name="keywords[]" value="'+$(this).attr('id').substr(2)+'"/>'+$(this).html()+'</li>').click(function(){
                            selectKeyword($(this));
                        }).appendTo('#used_keyword_list');
                    }
                });
                $('li','#used_keyword_list').each(function(){
                    if(AccentToNoAccent($(this).html().toUpperCase()) == value){
                        add = false;
                        alert('Ce mot clé est déjà associé à cet objet');
                    }
                });
                    
                if(add){
                    addKeyword($('#new_keyword').val());
                }
            } else {
                $('<li id="'+$('.s_selected:first','#suggestions').attr('id')+'"><input type="hidden" name="keywords[]" value="'+$('.s_selected:first','#suggestions').attr('id').substr(2)+'"/>'+$('.s_selected:first','#suggestions').html()+'</li>').click(function(){
                    selectKeyword($(this));
                }).appendTo('#used_keyword_list');
            }
            $(this).val('');
            $('li','#suggestions').remove();
        } else if(e.which == 38){
            // touche UP
            if($('.s_selected','#suggestions').length == 0){
                $('li:first','#suggestions').addClass('s_selected');
            } else {
                $('.s_selected','#suggestions').removeClass('s_selected').prev('li').addClass('s_selected');
                if($('.s_selected','#suggestions').length == 0){
                    $('li:last','#suggestions').addClass('s_selected');
                }
            }
        } else if(e.which == 40){
            // touche DOWN
            if($('.s_selected','#suggestions').length == 0){
                $('li:first','#suggestions').addClass('s_selected');
            } else {
                $('.s_selected','#suggestions').removeClass('s_selected').next('li').addClass('s_selected');
                if($('.s_selected','#suggestions').length == 0){
                    $('li:first','#suggestions').addClass('s_selected');
                }
            }
        } else {
            autocomplete($(this));
        }
    });
    
    // suppression de mots clés déjà ajoutés
    $('#manageKeywords').hide().find('a').click(function(){
        $('.uk_selected','#used_keyword_list').remove();
        $('#manageKeywords').hide();
    }); 
    
    $('li','#used_keyword_list').click(function(){
        selectKeyword($(this));
    });
});
    
        
/**
 * Recherche et affichage des mots clés déjà existants
 */
function autocomplete(elem){
    var elem = $(elem);
    if($(elem).val() != ''){
        $.ajax({
            type: 'POST',
            url: 'index.php?model=Keyword&action=getjson',
            dataType: 'JSON',
            data: 'search='+$('#new_keyword').val(),
            success: function(data){
                $('li','#suggestions').remove();
                if(data.error){
                    if(data.error != 'noresult'){
                        $('#suggestions').append('<li>'+data.error+'</li>');
                    }
                } else {
                    for (var i = 0; i < data.length; i++) { 
                        if($('#k_'+data[i].keyword_id, '#used_keyword_list').length == 0){
                            $('<li id="k_'+data[i].keyword_id+'">'+data[i].keyword_name+'</li>').click(function(){
                                $('<li id="'+$(this).attr('id')+'"><input type="hidden" name="keywords[]" value="'+$(this).attr('id').substr(2)+'"/>'+$(this).html()+'</li>').click(function(){
                                    selectKeyword($(this));
                                }).appendTo('#used_keyword_list');
                                $('li','#suggestions').remove();
                                $('#new_keyword').val('');
                            }).appendTo('#suggestions');
                        }
                    }
                }
            }
        });
    } else {
        $('li','#suggestions').remove();
    }
}   
        
/**
 * Ajout d'un nouveau mot clé dans la BDD en Ajax
 */
function addKeyword(word){
    if(word != ''){
        $.ajax({
            type: 'POST',
            url: 'index.php?model=Keyword&action=create&admin',
            data: 'keyword_name='+word,
            success: function(data){
                if(data != -1){
                    $('<li id="k_'+data+'"><input type="hidden" name="keywords[]" value="'+data+'"/>'+word+'</li>').click(function(){
                        selectKeyword($(this));
                    }).appendTo('#used_keyword_list');
                } else {
                    alert('Erreur lors de l\'insertion du mot clé');
                }
            }
        });
    }
}
        
/**
 * Selection d'un mot clé déjà utilisé pour suppression
 */
function selectKeyword(elem){
    $(elem).toggleClass('uk_selected');
    if($('.uk_selected','#used_keyword_list').length == 0){
        $('#manageKeywords').hide();
    } else {
        $('#manageKeywords').show();
    }
}