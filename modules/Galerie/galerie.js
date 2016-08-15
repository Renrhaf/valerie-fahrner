/**
 * galerie.tpl : affichage des descriptions d'images
 */
$('li','#Gimage_list').mouseenter(function(){
    $('.image_hovered').removeClass('image_hovered');
    $(this).addClass('image_hovered');
    var html = $(this).find('.image_desc').html();
    if(html.length != 0){
        $('#image_desc').find('h4').css('visibility', 'visible');
        $('#image_desc').find('img').fadeIn(300);
    } else {
        $('#image_desc').find('h4').css('visibility', 'hidden');
        $('#image_desc').find('img').fadeOut(300);
    }
    $('#image_desc').find('p').html(html);
});