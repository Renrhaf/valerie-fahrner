<?php
namespace Action;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Superclasse des Actions ou contrôleurs
 * Effectue la vérification de cohérence entre le modèle et l'action
 */
abstract class Action extends \MasterClass{
    
    /* Le model sur lequel on va lancer l'action */
    protected $model;
    
    /**
     * Constructeur commun à toutes les action
     * @param \Model $model - le modèle concerné
     */
    public function __construct(\Model $model){
        parent::__construct();
        $this->model = $model;
        
        // on vérifie que le modèle est compatible avec l'action
        if(!method_exists($this->model, $this->get_method_name())){
            throw new \Exception\ActionNotAllowed($this, $this->model);
        }
    }
    
    /**
     * Effectue des traitements spécifiques à l'action
     * @return Mixed - données à transmettre au template
     */
    public abstract function perform();
    
    /**
     * Renvoi le nom de la méthode du modèle à executer
     * @return String
     */
    public abstract function get_method_name();
    
    /**
     * Renvoi le nom de cet action de manière compréhensible par un visiteur
     * @example pour l'action Show : 'Affichage'
     * @return String
     */
    public abstract function get_display_name();
}
?>