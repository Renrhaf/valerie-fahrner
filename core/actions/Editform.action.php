<?php
namespace Action;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Affichage du formulaire de modification d'un objet
 * 
 * Nécessite de passer en GET :
 * - un moyen d'identifier l'objet de manière unique (clé primaire ou unique)
 * 
 * Pour plus d'informations sur le passage en GET de clé primaire/unique
 * @see ObjectModel::init_from_url();
 * @see ObjectModel::build_init_url();
 * @see Exception\CantIdentifyObject
 */
final class Editform extends Action{
    
    private $method_name = 'editform';
    private $display_name = 'afficher le formulaire de modification';
    
    public function __construct(\ObjectModel $model){
        parent::__construct($model);
        
        // on vérifie le droit d'accès
        if($this->model->get_mode() == \Model::FRONTEND || ($this->model->get_mode() == \Model::BACKEND && !isset($_SESSION['user']))){
            throw new \Exception\AccessDenied('Vous devez être connecté et en mode BACKEND');
        }
        
        // on l'initialise avec les données passées en GET
        $this->model->init_from_url();  // @throws CantIdentifyObject
        // et on charge les données
        $this->model->load();           // @throws ObjectNotExists
    }

    public function perform(){
        $result = NULL;
        
        if(isset($_SERVER['HTTP_REFERER'])){
            // on mémorise la page précédente pour redirection après action Create
            $_SESSION['EDIT_REFERER'] = $_SERVER['HTTP_REFERER'];
        }
        $result = $this->model->editform();

        // on charge les fichiers de formValidator
        \Controller::load_form_validator();
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
