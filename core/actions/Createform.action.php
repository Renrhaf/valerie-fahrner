<?php
namespace Action;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Affichage du formulaire de création d'un objet
 */
final class Createform extends Action{
    
    private $method_name = 'createform';
    private $display_name = 'afficher le formulaire de création';
    
    public function __construct(\ObjectModel $model){
        parent::__construct($model);
        
        // on vérifie le droit d'accès
        if($this->model->get_mode() == \Model::FRONTEND || ($this->model->get_mode() == \Model::BACKEND && !isset($_SESSION['user']))){
            throw new \Exception\AccessDenied('Vous devez être connecté et en mode BACKEND');
        }
    }

    public function perform(){
        $result = NULL;

        if(isset($_SERVER['HTTP_REFERER'])){
            // on mémorise la page précédente pour redirection après action Create
            $_SESSION['EDIT_REFERER'] = $_SERVER['HTTP_REFERER'];
        }
        $result = $this->model->createform();

        // on charge le plugin formValidator
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
