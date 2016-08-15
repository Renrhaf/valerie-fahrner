<?php
namespace Action;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Insertion d'un objet en BDD
 * 
 * Nécessite le passage en POST :
 * - Tous les champs obligatoires de la table
 */
final class Create extends Action{
    
    private $method_name = 'create';
    private $display_name = 'créer';
    
    public function __construct(\ObjectModel $model){
        parent::__construct($model);
        
        // on vérifie le droit d'accès
        if($this->model->get_mode() == \Model::FRONTEND || ($this->model->get_mode() == \Model::BACKEND && !isset($_SESSION['user']))){
            throw new \Exception\AccessDenied('Vous devez être connecté et en mode BACKEND');
        }
        
        // on set les valeurs
        foreach($_POST as $name => $value){
            try{
                $field = $this->model->set($name, $value);
            } catch(\Exception $e) {}
        }
    }

    public function perform(){        
        // on lance la méthode
        $this->model->create();

        // Si on dispose de la page d'où provient l'édition on redirige là
        if(isset($_SESSION['EDIT_REFERER'])){
            $redir = $_SESSION['EDIT_REFERER'];
            unset($_SESSION['EDIT_REFERER']);
        } else {
            $redir = $this->model->get_redirection();
        }
        redirect($redir);
    }
    
    public function get_method_name(){
        return $this->method_name;
    }
    
    public function get_display_name(){
        return $this->display_name;
    }
}

?>
