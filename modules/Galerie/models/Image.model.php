<?php
namespace Galerie;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Objet définissant une image d'une galerie photo
 * \author renrhaf
 */
class Image extends \ObjectModel{

    public function __construct(Array $data = NULL){
        $table = new \Table('image','image');
        \Field::create('Identifiant', 'image_id', \Field::INT, true, 1)->add_primary($table);
        \Field::create('Titre', 'image_title', \Field::STRING, false, 1, 64)->add($table);
        \Field::create('Description', 'image_description', \Field::STRING, false, 1, 255)->add($table);
        \Field::create('Chemin vers l\'image', 'image_url', \Field::STRING, true, 1, 255)->add_unique($table, 'uk_image_url');
        \Field::create('Date de création', 'image_created', \Field::TIMESTAMP, false)->add($table);
        \Field::create('Utilisateur', 'user_id', \Field::INT, false, 1)->add($table);
        \Field::create('Visibilité', 'image_active', \Field::INT, false, 0, 1)->add($table);
        \Field::create('Galerie', 'galerie_id', \Field::INT, true, 1)->add($table);
        \Field::create('Ordre', 'image_order', \Field::INT, false, 1)->add($table);
        $this->set_table($table);
        
        parent::__construct($data);
    }
    
    /**
     * Supprime une image de la base de données et du disque
     */
    public function delete(){
        $data = Array();
        $data = $this->get_values();
        
        // on lance la suppression en base de données
        // attention, on utilise une procédure stockée pour la gestion de l'ordre
        try {
            $query = 'CALL image_delete('.$this->get('image_id').')';
            $this->db->query($query);
        } catch(\Exception $e){
            // la procédure n'existe pas... maudit hébergement mutualisé :S
            // on fait les traitements en PHP... plus lourd pour les communication BDD !
            if($this->get('image_order') != null){
                $this->db->exec('UPDATE image SET image_order = NULL WHERE image_id = '.$this->get('image_id'));
                $this->db->exec('UPDATE image SET image_order = image_order - 1 WHERE galerie_id = '.$this->get('galerie_id').' AND image_order > '.$this->get('image_order').' ORDER BY image_order ASC');
            }
            parent::delete();
        }
        
        // on supprime le fichier et sa miniature
        $config = $this->conf->get('galerie');
        unlink($config['file_upload_dir'].$data['image_url']);
        unlink($config['file_upload_dir'].'thumbnails/'.$data['image_url']);
        unlink($config['file_upload_dir'].'preview/'.$data['image_url']);

        $this->set_redirection('module=Galerie&model=Galerie&action=manage&admin&pk='.$data['galerie_id']);
        return true;
    }
    
    /**
     * Formulaire d'édition d'une image
     * Remarque : voir Galerie::upload() pour la création
     */
    public function editform(){
        $data = Array();
        $data = $this->get_values();

        // on charge les données de la galerie associée
        $query = 'SELECT * FROM galerie WHERE galerie_id = ?';
        $data['galerie'] = $this->db->preparedQuery($query, Array($this->get('galerie_id')), \DB::SINGLE_ROW);
        
        // on charge les autres images avec ordre
        $query = 'SELECT image_id, image_title, image_order, image_url FROM image WHERE galerie_id = ? AND image_order IS NOT NULL ORDER BY image_order';
        $data['order'] = $this->db->preparedQuery($query, Array($this->get('galerie_id')));

        // on charge les mots clés associés
        $data['used_keywords'] = $this->get_keywords();
        $this->conf->add('js', 'core/js/keyword.js');
        
        // on défini le template
        $this->set_template('image_form.tpl', \Model::BACKEND);
        
        // on donne une nouvelle description au site
        $this->conf->set('site_description', 'Modification de l\'image '.$this->get('image_title'));
        $this->conf->set('site_title', 'Modification de l\'image : '.$this->get('image_title'));
        \Controller::load_shadowbox();
        return $data;
    }
    
    /**
     * Modification d'une galerie
     * Remarque : voir Galerie::upload() pour l'insertion
     */
    public function update(){
        $bool = NULL;
        
        // on vérifie qu'on a l'ID de l'image
        $id = $this->get('image_id');
        if(!isset($id)){
            notification('error','Aucun ID précisé');
            redirect('module=Galerie&model=Galerie&action=showlist&admin');
        }
        
        $order = $_POST['img_order'];
        if($order == ''){ $order = null; }
        try {
            // on lance la procédure stockée pour gérer les ordres
            $query = 'CALL image_order_update(?,?,@realOrder)';
            $this->db->preparedQuery($query, Array($id, $order));
            $result= $this->db->query('SELECT @realOrder',\DB::SINGLE_ROW);
            $this->set('image_order', $result['@realOrder']);
        } catch(\Exception $e){
            
            // la procédure n'existe pas... maudit hébergement mutualisé :S
            // on fait les traitements en PHP... plus lourd pour les communication BDD !
            $tmp = $this->db->query('SELECT image_order, galerie_id FROM image WHERE image_id = '.$id, \DB::SINGLE_ROW);
            $oldOrder = $tmp['image_order'];
            $galId = $tmp['galerie_id'];
            
            if($order != null && $oldOrder == null){
                $this->db->exec('UPDATE image SET image_order = image_order + 1 WHERE galerie_id = '.$galId.' AND image_order >= '.$order.' ORDER BY image_order DESC');
            } else if($oldOrder != null && $order == null){
                $this->db->exec('UPDATE image SET image_order = NULL WHERE image_id = '.$id);
                $this->db->exec('UPDATE image SET image_order = image_order - 1 WHERE galerie_id = '.$galId.' AND image_order > '.$oldOrder.' ORDER BY image_order ASC');
            } else if($order != null && $oldOrder != null && $order != $oldOrder){
                $this->db->exec('UPDATE image SET image_order = NULL WHERE image_id = '.$id);
                $this->db->exec('UPDATE image SET image_order = image_order - 1 WHERE galerie_id = '.$galId.' AND image_order > '.$oldOrder.' ORDER BY image_order ASC');
                $this->db->exec('UPDATE image SET image_order = image_order + 1 WHERE galerie_id = '.$galId.' AND image_order >= '.$order.' ORDER BY image_order DESC');
            }
            
            $tmp = $this->db->query('SELECT MAX(image_order) FROM image WHERE galerie_id = '.$galId.' AND image_id != '.$id, \DB::SINGLE_ROW);
            if($tmp['MAX(image_order)'] + 2 == $order){
                $this->set('image_order', $order-1);
            } else {
                $this->set('image_order', $order);
            }
        }
        
        // on sauvegarde
        parent::update();
            
        // on gère les mots clés
        $this->insert_keywords();
        
        // on défini la redirection
        $this->set_redirection('module=Galerie&model=Galerie&action=manage&admin&pk='.$id);
    }
}
?>
