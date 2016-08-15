<?php
if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Superclasse des Modèles
 * 
 * Cette classe défini :
 * - le mode de traitement des données (par défaut visiteur)
 * - une action par défaut pour le modèle (par défaut affichage)
 * - les templates à utiliser selon le mode (à redéfinir dans le modèle)
 * Tous les modèles doivent étendre cette classe et définir les templates
 */
abstract class Model extends MasterClass{
    
    /* Mode de récupèration et d'affichage des données */
    protected $mode = Model::FRONTEND;    
    /* Constante définissant le mode frontend - visualisation */
    const FRONTEND = 0;
    /* Constante définissant le mode backend - administration */
    const BACKEND = 1;
    
    /* Action par défaut lancée sur le modèle */
    protected $default_action = 'Show';
    /* On défini dans cette variable les templates a afficher selon le mode */
    protected $template = Array(Model::FRONTEND => NULL, Model::BACKEND => NULL);
    /* Chemins de redirection */
    protected $redirect = Array(Model::FRONTEND => NULL, Model::BACKEND => NULL);
    
    /**
     * Constructeur de la classe Model
     */
    public function __construct(){
        parent::__construct();
        
        // on met en place le mode
        if(isset($_GET['admin'])){
            $this->set_mode(Model::BACKEND);
        }
    }
    
    /**
     * Renvoi l'action par défaut du modèle
     * @return String
     */
    final public function get_default_action(){
        return $this->default_action;
    }
    
    /**
     * Renvoi le template adéquat par rapport au mode courant
     * @return le template à afficher
     */
    final public function get_template(){
        if(isset($this->template[$this->mode]))
            return $this->template[$this->mode];
        else
            throw new Exception('Aucun template spécifié pour ce modèle et dans ce mode');
    }
    
    /**
     * Renvoi la redirection adéquate par rapport au mode courant
     * @return le template à afficher
     */
    final public function get_redirection(){
        if(isset($this->redirect[$this->mode]))
            return $this->redirect[$this->mode];
        else
            throw new Exception('Aucune redirection spécifiée pour ce modèle et dans ce mode');
    }
    
    /**
     * Défini le template à utiliser dans le mode donné
     * @param String $template
     * @param Constant $mode Model::FRONTEND ou Model::BACKEND
     */
    final public function set_template($template, $mode = NULL){
        if($mode === NULL){
            $this->template[Model::FRONTEND] = $template;
            $this->template[Model::BACKEND] = $template;
        } else {
            $this->template[$mode] = $template;
        }
    }
    
    /**
     * Défini la redirection à utiliser dans le mode donné
     * @param String $redirection
     * @param Constant $mode Model::FRONTEND ou Model::BACKEND
     */
    final public function set_redirection($redirection, $mode = NULL){
        if($mode == NULL){
            $this->redirect[Model::FRONTEND] = $redirection;
            $this->redirect[Model::BACKEND] = $redirection;
        } else {
            $this->redirect[$mode] = $redirection;
        }
    }
    
    /**
     * Met en place le mode de récupèration et d'affichage des données passé
     * Si backend, interface d'administration
     * Si frontend, interface visiteur
     * @param $mode Model::BACKEND ou Model::FRONTEND
     */
    final public function set_mode($mode){
        if($mode == Model::FRONTEND || $mode == Model::BACKEND){
            $this->mode = $mode;
        } else {
            throw new Exception('Le mode demandé n\'existe pas, veuillez utiliser les modes FRONTEND ou BACKEND de la classe Model');
        }
    }
    
    /**
     * Récupère le mode d'affichage des données
     * @return Model::FRONTEND ou Model::BACKEND
     */
    final public function get_mode(){
        return $this->mode;
    }
}
?>