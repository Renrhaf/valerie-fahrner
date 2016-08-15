<div id="debug-infos">
    <div id="debug-controls" title="Augmenter la taille" class="debug-up"></div>
    
    <div class="debug-info debug-info-first">
        <span class="debug-title">
            Title
        </span>
        <span class="debug-message">
            Message
        </span>
        <span class="debug-time">
            Time
        </span>
        <div style="clear:both;"></div>
    </div> 
    {foreach $debug as $info name=debuginfos}
        <div class="debug-info{if $smarty.foreach.debuginfos.last} debug-info-last{/if}{if $info['title'] eq 'Redirection'} debug-info-redirection{/if}">
            <span class="debug-title">
                {$info['title']}
            </span>
            <span class="debug-message">
                {$info['message']}
            </span>
            <span class="debug-time">
                {$info['time']|string_format:"%.5f"}
            </span>
            <div style="clear:both;"></div>
        </div>  
    {/foreach}
</div>

{literal}
<script type="text/javascript">
$('.debug-info', '#debug-infos').hide();
$('.debug-info-last', '#debug-infos').show();

$('#debug-controls').click(function(){
    if($(this).hasClass('debug-up')){
        $(this).removeClass('debug-up');
        $(this).attr('title','Réduire la taille');
        $(this).addClass('debug-down');
        $('.debug-info', '#debug-infos').show();
        $(this).css({
            position: 'absolute',
            top: '10px'
        });
        $(this).parent('div').animate({
            height: '100%'
        }, function(){
            $('#debug-controls').css({
                position: 'fixed',
                top: '10px'
            });
        });
    } else {
        $(this).removeClass('debug-down');
        $(this).attr('title','Augmenter la taille');
        $(this).addClass('debug-up');
        $(this).css({
            position: 'absolute',
            top: '10px'
        });
        $(this).parent('div').animate({
            height: '32px'
        }, function(){
            $('#debug-controls').css({
                position: '',
                bottom: '',
                top: ''
            });
            $('.debug-info', '#debug-infos').hide();
            $('.debug-info-last', '#debug-infos').show();
        });
    }
});
</script>
{/literal}