<?php
namespace Action;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Supprime l'image associée à une news
 * Uniquement disponible en BACKEND
 * 
 * Nécessite le passage en GET de :
 * - un moyen d'identifier l'objet de manière unique (clé primaire ou unique)
 * 
 * Pour plus d'informations sur le passage en GET de clé primaire/unique
 * @see ObjectModel::init_from_url();
 * @see ObjectModel::build_init_url();
 * @see Exception\CantIdentifyObject
 */
final class RemoveImage extends Action{
    
    private $method_name = 'remove_image';
    private $display_name = 'Suppression de l\'image associée à une news';
    
    public function __construct(\ObjectModel $model){
        parent::__construct($model);
        
        // on vérifie le droit d'accès
        if($this->model->get_mode() == \Model::FRONTEND || ($this->model->get_mode() == \Model::BACKEND && !isset($_SESSION['user']))){
            throw new \Exception\AccessDenied('Vous devez être connecté et en mode BACKEND');
        }
        
        // on initialise le modèle avec les données passées en GET
        $this->model->init_from_url(); // @throws CantIdentifyObject
        // et on charge les données
        $this->model->load();          // @throws ObjectNotExists
    }

    public function perform(){        
        return $this->model->remove_image();
    }
    
    public function get_method_name(){
        return $this->method_name;
    }
    
    public function get_display_name(){
        return $this->display_name;
    }
}

?>
