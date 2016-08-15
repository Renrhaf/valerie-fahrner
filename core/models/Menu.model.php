<?php
namespace Core;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Objet définissant le menu du site
 * \author renrhaf
 */
class Menu extends \ObjectModel{

    public function __construct(Array $data = NULL){
        $table = new \Table('menu_block', 'élément du menu');
        \Field::create('Identifiant', 'menu_block_id', \Field::INT, true, 1)->add_primary($table);
        \Field::create('Titre', 'menu_block_title', \Field::STRING, true, 1, 64)->add_unique($table, 'uk_menu_block_title');
        \Field::create('Destination', 'menu_block_link', \Field::STRING, true, 1, 128)->add($table);
        $this->set_table($table);
        
        $this->redirect = Array(\Model::BACKEND => 'model=Menu&action=showlist&admin');
        
        parent::__construct($data);
    }
    
    public function show(){
        $data = Array();
        
        $query = 'SELECT * FROM menu_block';
        $data['menus'] = $this->db->query($query);
        
        $this->set_template('menu.tpl', \Model::FRONTEND);
        return $data;
    }
    
    /**
     * Affiche la liste des éléments du menu
     */
    public function showlist(){
        $data = Array();
            
        $query = 'SELECT * FROM menu_block';
        $tmp = $this->db->query('SELECT COUNT(*) FROM menu_block', \DB::SINGLE_ROW);
        
        $data['multipage'] = $this->get_multipage_data($tmp['COUNT(*)']);
        $query = $this->add_order_limit($query, $data['multipage']);
        $data['menus'] = $this->db->query($query);
        
        $this->set_template('menu_list_admin.tpl', \Model::BACKEND);
        $this->conf->set('site_description', 'Gestion de la liste des éléments du menu du site');
        $this->conf->set('site_title', 'Gestion du menu du site');
        return $data;
    }
    
    /**
     * Affichage du formulaire de modification d'un élément du menu
     */
    public function editform(){
        $data = Array();
        $data = $this->get_values(); 
        $this->conf->set('site_description', 'Modification de l\'élément de menu '.$this->get('menu_block_title')); 
        $this->conf->set('site_title', 'Modification de l\' élément : '.$this->get('menu_block_title'));
        $this->set_template('menu_form.tpl', \Model::BACKEND);
        return $data;
    }
    
    /**
     * Affichage du formulaire de création d'un élément du menu
     */
    public function createform(){
        $data = Array();
        $this->conf->set('site_description', 'Ajout d\'un élément au menu du site'); 
        $this->conf->set('site_title', 'Ajout d\'un élément au menu');
        $this->set_template('menu_form.tpl', \Model::BACKEND);
        return $data;
    }
    
    /**
     * Création d'un élément du menu
     */
    public function create(){
        if(parent::create())
            notification('validation', 'Element ajouté au menu avec succès !');
    }
}
?>
