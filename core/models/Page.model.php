<?php
namespace Core;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Objet définissant une page du site
 * \author renrhaf
 */
class Page extends \ObjectModel{

    public function __construct(Array $data = NULL){
        $table = new \Table('page','page');
        \Field::create('Identifiant', 'page_id', \Field::INT, true, 1)->add_primary($table);
        \Field::create('Titre', 'page_title', \Field::STRING, true, 1, 64)->add($table);
        \Field::create('Contenu', 'page_content', \Field::HTML, true)->add($table);
        \Field::create('Date de création', 'page_created', \Field::TIMESTAMP, false)->add($table);
        \Field::create('Date de dernière modification', 'page_updated', \Field::TIMESTAMP, false)->add($table);
        \Field::create('Utilisateur', 'user_id', \Field::INT, false, 1)->add($table);
        \Field::create('Réécriture d\'URL', 'page_rewrite_url', \Field::STRING, true, 1, 64)->add_unique($table, 'uk_page_rewrite_url');
        $this->set_table($table);
        
        $this->redirect = Array(\Model::BACKEND => 'model=Page&action=Showlist&admin');
        
        parent::__construct($data);
    }
    

    /**
     * Affiche la page
     */
    public function show(){
        $data = Array();
        
        // récupèration des infos de la news
        $data['page'] = $this->get_values();

        $this->set_template('page.tpl');
        $this->conf->set('site_description', $this->get('page_content'));
        $this->conf->set('site_title', $this->get('page_title'));
        \Controller::load_shadowbox();
        return $data;
    }
    
    /**
     * Affiche la liste des pages
     */
    public function showlist(){
        $data = Array();
        
        $query = 'SELECT * FROM page';
        $tmp = $this->db->query('SELECT COUNT(*) FROM page', \DB::SINGLE_ROW);
        
        $data['multipage'] = $this->get_multipage_data($tmp['COUNT(*)']);
        $query = $this->add_order_limit($query, $data['multipage']);
        $data['pages'] = $this->db->query($query);
        
        $this->set_template('page_list_admin.tpl', \Model::BACKEND);
        
        $this->conf->set('site_description', 'Affichage de la liste des pages');
        $this->conf->set('site_title', 'Liste des pages');
        return $data;
    }
    
    public function createform(){
        $data = Array();
        $this->conf->set('site_description', 'Création d\'une nouvelle page'); 
        $this->conf->set('site_title', 'Création d\'une page');
        \Controller::load_tinyMCE();
        $this->set_template('page_form.tpl',\Model::BACKEND);
        return $data;
    }
    
    public function editform(){
        $data = Array();
        $data = $this->get_values();
        $this->conf->set('site_description', 'Modification de la page '.$this->get('page_title')); 
        $this->conf->set('site_title', 'Modification : '.$this->get('page_title'));
        \Controller::load_tinyMCE();
        $this->set_template('page_form.tpl',\Model::BACKEND);
        return $data;
    }
    
    /**
     * Insertion/Modification d'une page
     */
    public function create(){
        // mise en forme de la version réécriture d'URL
        $this->set('page_rewrite_url', \Tools::formatURLRewrite($this->get('page_title')));
        $this->set('user_id', $_SESSION['user']['user_id']);
            
        // attention hébergement mutualisé n'autorise pas TRIGGER
        // vérification existence trigger...
        $tmp = $this->db->query('SELECT EVENT_MANIPULATION FROM INFORMATION_SCHEMA.TRIGGERS WHERE TRIGGER_NAME = "page_created"', \DB::SINGLE_ROW);
        if($tmp == Array()){
            // le trigger n'existe pas !
            $this->set('page_created', date("Y-m-d H:i:s"));
            // on passe outre la validation du champ
            $this->get_field('page_created')->set_valid(true);
        }

        if(parent::create())
            notification('validation', 'Page créée avec succès !');
    }
    
    public function update(){
        // mise en forme de la version réécriture d'URL
        $this->set('page_rewrite_url', \Tools::formatURLRewrite($this->get('page_title')));
        
        return parent::update();
    }
}
?>
