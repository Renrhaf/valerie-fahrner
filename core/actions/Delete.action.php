<?php
namespace Action;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Suppression d'un objet en BDD
 * 
 * Nécessite le passage en GET :
 * - un moyen d'identifier l'objet de manière unique (clé primaire ou unique)
 * 
 * Pour plus d'informations sur le passage en GET de clé primaire/unique
 * @see ObjectModel::init_from_url();
 * @see ObjectModel::build_init_url();
 * @see Exception\CantIdentifyObject
 */
final class Delete extends Action{
    
    private $method_name = 'delete';
    private $display_name = 'supprimer';
    
    public function __construct(\ObjectModel $model){
        parent::__construct($model);
        
        // on vérifie le droit d'accès
        if($this->model->get_mode() == \Model::FRONTEND || ($this->model->get_mode() == \Model::BACKEND && !isset($_SESSION['user']))){
            throw new \Exception\AccessDenied('Vous devez être connecté et en mode BACKEND');
        }
        
        // on l'initialise avec les données passées en GET
        $this->model->init_from_url();  // @throws CantIdentifyObject
        // on charge l'objet
        $this->model->load();           // @throws ObjectNotExists
    }

    public function perform(){
        
        $result = $this->model->delete();
        if($this->conf->get('ajax')){            
            if($result){
                echo(json_encode(Array('validation' => 'Suppression effectuée'))); exit;
            } else {
                $errors = Array();
                $messages = $this->model->get_table()->get_error_messages();
                foreach($messages as $message){
                    $errors[] = $message;
                }
                echo(json_encode(Array('error' => $errors))); exit;
            }
        } else {
            redirect($this->model->get_redirection());
        }   
    }
    
    public function get_method_name(){
        return $this->method_name;
    }
    
    public function get_display_name(){
        return $this->display_name;
    }
}

?>
