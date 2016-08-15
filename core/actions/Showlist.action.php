<?php
namespace Action;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Affichage d'une liste d'objets
 * 
 * @TODO filtrage, tri, pagination -> c'est ici que ca doit se passer !
 * Mais pas seulement ! trouver un autre moyen
 */
final class Showlist extends Action{
    
    private $method_name = 'showlist';
    private $display_name = 'affichage la liste';
    
    public function __construct(\ObjectModel $model){
        parent::__construct($model);
        
        // on vérifie le droit d'accès
        if($this->model->get_mode() == \Model::BACKEND && !isset($_SESSION['user'])){
            throw new \Exception\AccessDenied('Vous devez être connecté');
        }
    }
    
    public function perform(){
        $result = NULL;
        $result = $this->model->showlist();
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
