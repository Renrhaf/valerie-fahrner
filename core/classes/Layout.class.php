<?php

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Classe gérant le patron de la page affichée
 */
abstract class Layout extends MasterClass{
    
    /* Instance de smarty */
    private $smarty = NULL;
    
    /* Template englobant du layout */
    protected $template = NULL;
    
    /* Le template demandé par le modèle */
    protected $model_template = NULL;
    
    
    /**
     * Initialisation de Smarty
     */
    public function __construct(){
        parent::__construct();
        
        $this->smarty = new Smarty();
        $this->smarty->setCompileDir('libs/Smarty/templates_c');
        $this->smarty->setCacheDir('libs/Smarty/cache');
        $this->smarty->setConfigDir('libs/Smarty/configs');
        $this->smarty->setTemplateDir('core/templates/');
        // $this->smarty->testInstall();
        
        if($this->conf->get('debug')){
            Debug::add('Smarty', 'initialisation réussie');
        }
    }
    
    
    /**
     * Ajoute des données spécifiques au template
     */
    abstract public function build();
    
    /**
     * Assigne un nom à des données, pour y accèder dans le template
     * @param String $name nom avec laquelle désigner la valeur
     * @param Mixed $var tableau, ou valeur
     */
    final public function assign($name, $var){
        $this->smarty->assign($name, $var);
    }
    
    
    /**
     * Défini le template variable de la page à utiliser
     * @param String $template
     */
    final public function set_template($template){
        $this->model_template = $template;
    }
    
    /**
     * Finalise l'ajout de données et affiche le template
     */
    final public function display(Array $data){
        // on construit le layout
        $this->build();
        
        // ajoute les données du modèle
        $this->smarty->assign('data', $data);
        
        // on transmet les données de configuration à Smarty
        $this->smarty->assign('config', $this->conf->get_config());
        
        // traitement des notifications
        $this->smarty->assign('errors', $_SESSION['error']);
        unset($_SESSION['error']);
        $this->smarty->assign('infos', $_SESSION['info']);
        unset($_SESSION['info']);
        $this->smarty->assign('validations', $_SESSION['validation']);
        unset($_SESSION['validation']);
        
        // on transmet les données de débug
        if($this->conf->get('debug')){
            $nb_requests = $this->db->getNumberRequest();
            if(isset($_SESSION['debug_last_request_nb'])){
                $nb_requests += (int) $_SESSION['debug_last_request_nb'];
                unset($_SESSION['debug_last_request_nb']);
            }
            Debug::add('Controller', 'Affichage du template principal, '.$nb_requests.' requête(s) SQL executée(s)');
            $this->smarty->assign('debug', Debug::getInfos());
        }
        
        if(!isset($this->model_template))
            throw new Exception('Le modèle '.get_class(Controller::$model).' ne spécifie aucun template dans le mode '.Controller::$model->get_mode().'!');
        
        if(Controller::$module instanceof Core){
            $this->smarty->assign('template', 'core/templates/'.$this->model_template);
        } else {
            $this->smarty->assign('template', 'modules/'.get_class(Controller::$module).'/templates/'.$this->model_template);
        }
        
        if(!isset($this->template))
            throw new Exception('Le layout '.get_class($this).' ne spécifie pas de template principal à afficher !');
        
        if(Controller::$module instanceof Core){
            $this->smarty->display('core/layouts/templates/'.$this->template);
        } else {
            if(file_exists('modules/'.get_class(Controller::$module).'/layouts/templates/'.$this->template)){
                $this->smarty->display('modules/'.get_class(Controller::$module).'/layouts/templates/'.$this->template);
            } else {
                $this->smarty->display('core/layouts/templates/'.$this->template);
            }
        }
    }
}
?>