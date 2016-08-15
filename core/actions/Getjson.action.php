<?php
namespace Action;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Récupère des données en AJAX au format JSON
 * Remarque : cette action est uniquement AJAX
 * 
 * @TODO Automatiser ces conneries de vérifications (AjaxAction par ex...)
 */
final class Getjson extends Action{
    
    private $method_name = 'getjson';
    private $display_name = 'récupèrer au format JSON';
    
    public function __construct(\Model $model){
        parent::__construct($model);
    }
    
    /**
     * Récupère en AJAX des données au format JSON
     * @param Object $model le modèle initialisé
     */
    public function perform(){
        // on vérifie qu'on est bien en AJAX
        if(!$this->conf->get('ajax')){
            notification('error', 'Action non autorisée');
            redirect();
        }
        
        $this->model->getjson();
    }
    
    public function get_method_name(){
        return $this->method_name;
    }
    
    public function get_display_name(){
        return $this->display_name;
    }
}

?>
