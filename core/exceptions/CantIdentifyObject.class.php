<?php
namespace Exception;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Exception lancée lorsqu'un objet ne peut être identifié de manière unique
 */
class CantIdentifyObject extends EurekaException{

    /**
     * Constructeur de la classe CantIdentifyObject
     */
    public function __construct(\ObjectModel $model){
        $table = $model->get_table();
        $conf = \Config::getInstance();
        $baseUrl = $conf->get('realpath').'index.php?';
        if(isset($_GET['module']) && $_GET['module'] != '' && ucfirst($_GET['module']) != 'Core')
            $baseUrl .= 'module='.$_GET['module'].'&';
        if(isset($_GET['model'])){
            $baseUrl .= 'model='.$_GET['model'];
        } else {
            $tmp = explode('\\', get_class($model));
            $baseUrl .= 'model='.(end($tmp));
        }
        
        if(isset($_GET['action']) && $_GET['action'] != '' && ucfirst($_GET['action']) != $model->get_default_action())
            $baseUrl .= '&action='.$_GET['action'];
        
        $message = 'Impossible de déterminer l\'objet '.$table->get_display_name().' concerné par la requête !<br/><br/>';
            
        if(count($table->get_error_messages()) > 0){
            $message .= 'Une ou plusieurs valeurs sont spécifiées, mais voici les erreurs présentes : <b><br/> - ';
            $message .= implode('<br/> - ', $table->get_error_messages()).'<br/></b>';
        }
        
        $message .= 'Pour un objet '.$table->get_display_name().', il faut indiquer soit :<br/>';
        $pk_fields = $table->get_primary_key();
        $i = 0;
        $nb = count($pk_fields);
        if($nb > 1) 
            $message .= '- Les champs : '; 
        else 
            $message .= '- Le champ : '; 

        $howTo = $baseUrl;
        foreach($pk_fields as $field){
            $message .= $field->get_display_name();
            $howTo .= '&pk['.$i.']=<b>'.$field->get_display_name().'</b>';
            if($i < $nb-2) $message .= ', ';
            elseif($i < $nb-1) $message .= ' et ';
            $i++;
        }
        $message .= '<br/><span style="margin-left:30px;">'.$howTo.'</span><br/>';

        $ukeys = $table->get_unique_keys();
        foreach($ukeys as $ukey_name => $ukey_fields){
            $nb = count($ukey_fields); $i = 0;                
            if($nb > 1) 
                $message .= '<br/> - Les champs : '; 
            else 
                $message .= '<br/> - Le champ : '; 

            $howTo = $baseUrl.'&uk[0]='.$ukey_name;
            foreach($ukey_fields as $field){
                $message .= $field->get_display_name();
                $howTo .= '&uk['.($i+1).']=<b>'.$field->get_display_name().'</b>';
                if($i < $nb-2) $message .= ', ';
                elseif($i < $nb-1) $message .= ' et ';
                $i++;
            }
            $message .= '<br/><span style="margin-left:30px;">'.$howTo.'</span><br/>';
        }

        $this->developer_message = $message;
        parent::__construct(404);
    }
}
?>