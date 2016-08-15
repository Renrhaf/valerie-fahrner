<?php
namespace Action;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Affichage d'un modèle ou d'un objet
 * 
 * Si le modèle hérite d'ObjectModel il faut passer en GET :
 * - un moyen d'identifier l'objet de manière unique (clé primaire ou unique)
 * 
 * Pour plus d'informations sur le passage en GET de clé primaire/unique
 * @see ObjectModel::init_from_url();
 * @see ObjectModel::build_init_url();
 * @see Exception\CantIdentifyObject
 */
final class Show extends Action{
    
    private $method_name = 'show';
    private $display_name = 'afficher';
    
    public function __construct(\Model $model){
        parent::__construct($model);
        
        // si c'est un modèle qui hérite d'ObjectModel
        if($this->model instanceof \ObjectModel){
            // on l'initialise avec les données passées en GET
            $this->model->init_from_url();  // @throws CantIdentifyObject
            // et on charge les données
            $this->model->load();      // @throws ObjectNotExists
        }
    }
    
    public function perform(){
        $result = $this->model->show();
        return $result;        
    }
    
    public function get_method_name(){
        return $this->method_name;
    }
    
    public function get_display_name(){
        return $this->display_name;
    }
}

?>
