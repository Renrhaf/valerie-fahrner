<?php
/**
 * Exception lancée lorsqu'un objet ne peut être identifié de manière unique
 * @TODO améliorer et proposer un <select> des différentes valeurs possibles pour l'URL
 */
class CantIdentifyObject extends Exception {

    /**
     * Constructeur de la classe CantIdentifyObject
     */
    public function __construct(ObjectModel $model, $code = 0){
        $table = $model->get_table();
        $conf = Config::getInstance();
        $baseUrl = $conf->get('realpath').'index.php?';
        if(!(Controller::$module instanceof Core)){
            $baseUrl .= 'module='.get_class(Controller::$module);
        }
        if(get_class(Controller::$model) != Controller::$module->get_default_model()){
            $baseUrl .= '&model='.get_class(Controller::$model);
        }
        if(get_class(Controller::$action) != Controller::$model->get_default_action()){
            $baseUrl .= '&action='.get_class(Controller::$action);
        }
        
        $message = 'Impossible de déterminer l\'objet <b>'.$table->get_display_name().'</b> concerné par la requête !<br/><br/>';
            
        if(count($table->get_error_messages()) > 0){
            $message .= 'Une ou plusieurs valeurs sont spécifiées, mais voici les erreurs présentes : <br/> - ';
            $message .= implode('<br/> - ', $table->get_error_messages()).'<br/>';
            $message .= '<br/><i>Rappel :</i> ';
        }
        
        $message .= 'Pour un objet <b>'.$table->get_display_name().'</b>, il faut indiquer soit :<br/>';
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
            $howTo .= '&pk['.$i.']=<i>'.$field->get_display_name().'</i>';
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
                $howTo .= '&uk['.($i+1).']=<i>'.$field->get_display_name().'</i>';
                if($i < $nb-2) $message .= ', ';
                elseif($i < $nb-1) $message .= ' et ';
                $i++;
            }
            $message .= '<br/><span style="margin-left:30px;">'.$howTo.'</span><br/>';
        }

        
        $lol = new Galerie\Mgalerie();
        
        parent::__construct($message,$code);
    }
}
?>