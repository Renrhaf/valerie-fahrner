<?php
namespace News;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Objet définissant une catégorie de news
 * \author renrhaf
 */
class Newscateg extends \ObjectModel{

    public function __construct(Array $data = NULL){
        $table = new \Table('news_categ','catégorie d\'actualité');
        \Field::create('Identifiant', 'news_categ_id', \Field::INT, true, 1)->add_primary($table);
        \Field::create('Titre', 'news_categ_title', \Field::STRING, true, 1, 64)->add_unique($table, 'uk_news_categ_title');
        \Field::create('Description', 'news_categ_description', \Field::STRING, true)->add($table);
        $this->set_table($table);
        
        $this->redirect = Array(\Model::FRONTEND => 'module=News&model=Newscateg&action=showlist', \Model::BACKEND => 'module=News&model=Newscateg&action=showlist&admin');
    
        parent::__construct($data);
    }
    
    /**
     * Affiche la catégorie de news
     */
    public function show(){
        $data = Array();
        
        // récupèration des infos de la catégorie
        $data['news_categ'] = $this->get_values();
        
        // On vérifie que l'url est bien la bonne : news/id/title
        $data['urlrw'] = \Tools::formatURLRewrite($this->get('news_categ_title'));
        if(isset($_GET['urlrwtxt']) && $_GET['urlrwtxt'] != $data['urlrw']){
            header('HTTP/1.1 301 Moved Permanently');
            $location = $this->conf->get('realpath').'news/categs/'.$this->get('news_categ_id').'/'.$data['urlrw'];
            header('Location: '.$location);
            header('Connection: close');
        }
        
        // récupèration des news de cette catégorie
        $query = 'SELECT COUNT(*) FROM news WHERE news_categ_id = ?';
        $tmp = $this->db->preparedQuery($query, Array($this->get('news_categ_id')), \DB::SINGLE_ROW);
        
        $query = 'SELECT * FROM news LEFT JOIN user ON news.user_id = user.user_id 
                                     LEFT JOIN galerie ON news.galerie_id = galerie.galerie_id
                                     WHERE news_categ_id = ?';
        $data['multipage'] = $this->get_multipage_data($tmp['COUNT(*)']);
        $query = $this->add_order_limit($query, $data['multipage']);
        $data['news'] = $this->db->preparedQuery($query, Array($this->get('news_categ_id')));
        
        $this->set_template('news_categ.tpl');
        $this->conf->set('site_description', 'Affichage des actualités de la catégorie '.$this->get('news_categ_title').' : '.$this->get('news_categ_description'));
        $this->conf->set('site_title', 'Actualités : '.$this->get('news_categ_title'));
        \Controller::load_shadowbox();
        
        return $data;
    }
    
    /**
     * Affiche la liste des catégories de news
     */
    public function showlist(){
        $data = Array();
        
        $query = 'SELECT * FROM news_categ';
        $tmp = $this->db->query('SELECT COUNT(*) FROM news_categ', \DB::SINGLE_ROW);
        
        $data['multipage'] = $this->get_multipage_data($tmp['COUNT(*)']);
        $query = $this->add_order_limit($query, $data['multipage']);
        $data['news_categs'] = $this->db->query($query);
        
        foreach($data['news_categs'] as $i => $categ){
            $data['news_categs'][$i]['urlrw'] = \Tools::formatURLRewrite($categ['news_categ_title']);
        }
        
        $this->set_template('news_categ_list.tpl', \Model::FRONTEND);
        $this->set_template('news_categ_list_admin.tpl', \Model::BACKEND);
        
        $this->conf->set('site_description', 'Affichage de la liste des catégories d\'actualités');
        $this->conf->set('site_title', 'Catégories d\'actualités');
        
        return $data;
    }
    
    public function editform(){
        $data = Array();
        $data = $this->get_values();
        $this->conf->set('site_description', 'Modification d\'une catégorie d\'actualité');
        $this->set_template('news_categ_form.tpl',\Model::BACKEND);
        return $data;
    }
    
    public function createform(){
        $data = Array();
        $this->conf->set('site_description', 'Création d\'une nouvelle catégorie d\'actualité'); 
        $this->set_template('news_categ_form.tpl',\Model::BACKEND);
        return $data;
    }
    
    /**
     * Insertion/Modification d'une actualité
     */
    public function create(){
        $bool = NULL;
        $id = $this->get('news_categ_id');
        if(isset($id)){
            // modification
            $bool = true;
            parent::update();
        } else {
            // insertion
            $bool = parent::create();
            if($bool)
                notification('validation', 'Catégorie créée avec succès !');
        }
    }
}
?>
