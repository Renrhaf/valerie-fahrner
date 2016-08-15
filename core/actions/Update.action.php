<?php
namespace Action;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Modification d'un objet en BDD
 * 
 * Nécessite le passage en POST :
 * - un moyen d'identifier l'objet de manière unique (clé primaire ou unique)
 * - les champs que l'on veut mettre à jour
 * 
 * @see Exception\CantIdentifyObject
 */
final class Update extends Action{
    
    private $method_name = 'update';
    private $display_name = 'mettre à jour';
    
    public function __construct(\ObjectModel $model){
        parent::__construct($model);
        
        // on vérifie le droit d'accès
        if($this->model->get_mode() == \Model::FRONTEND || ($this->model->get_mode() == \Model::BACKEND && !isset($_SESSION['user']))){
            throw new \Exception\AccessDenied('Vous devez être connecté et en mode BACKEND');
        }
        
        // on set les valeurs
        foreach($_POST as $name => $value){
            try{
                $this->model->set($name, $value);
            } catch(\Exception $e) {}
        }
        
        // on vérifie si la clé primaire ou une clé unique est définie
        if(!$this->model->get_table()->is_able_to_identify_object())
            throw new Exception\CantIdentifyObject($this->model);
    }

    public function perform(){
        
        // on lance la méthode
        $this->model->update();

        $redir = $this->model->get_redirection();
        // Si on dispose de la page d'où provient l'édition on redirige là
        if(isset($_SESSION['EDIT_REFERER'])){
            $redir = $_SESSION['EDIT_REFERER'];
            unset($_SESSION['EDIT_REFERER']);
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
