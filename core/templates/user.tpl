<div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="">Accueil</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="user/{$data.user_id}/{$data.urlrw}">Visualisation d'un profil</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<h3 class="page_title">{$data.user_fname} {$data.user_lname}</h3>

<div id="user_profil" style="margin:20px;">
    <div id="profil_picture" style="border:1px solid black; float:left;">
        {if isset($data.user_image_url)}
            <img src="uploads/images/{$data.user_image_url}" title="Photo de profil" alt="Photo de profil" />            
        {else}
            <img src="core/images/icones/default_user.png" title="Aucune photo définie" alt="Aucune photo définie" />            
        {/if}
    </div>
    
    <div id="profil_infos">
        <pre>
        Mail :              {mailto address=$data.user_mail encode="hex"} 

        Site web :          <a href="{$data.user_website}" title="Voir le site web de {$data.user_fname} {$data.user_lname}">{$data.user_website}</a>

        Profession :        {$data.profession.profession_name}

        Date de création :  {$data.user_created|date_format:"%d/%m/%Y à %Hh%M"}
        </pre>
    </div>
    
</div>
<div style="clear:both;"></div>

