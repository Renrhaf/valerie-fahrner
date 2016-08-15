<?php
namespace Galerie;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Objet définissant une galerie photo
 * \author renrhaf
 */
class Galerie extends \ObjectModel{

    public function __construct(Array $data = NULL){
        $table = new \Table('galerie','galerie');
        \Field::create('Identifiant', 'galerie_id', \Field::INT, true, 1)->add_primary($table);
        \Field::create('Titre', 'galerie_title', \Field::STRING, true, 1, 64)->add($table);
        \Field::create('Description', 'galerie_description', \Field::STRING, false, 1, 255)->add($table);
        \Field::create('Date de création', 'galerie_created', \Field::TIMESTAMP, false)->add($table);
        \Field::create('Date de dernière modification', 'galerie_updated', \Field::TIMESTAMP, false)->add($table);
        \Field::create('Utilisateur', 'user_id', \Field::INT, false, 1)->add($table);
        \Field::create('Visibilité', 'galerie_active', \Field::INT, false, 0, 1)->add($table);
        $this->set_table($table);
        
        $this->redirect = Array(\Model::FRONTEND => 'module=Galerie&model=Galerie&action=showlist', \Model::BACKEND => 'module=Galerie&model=Galerie&action=showlist&admin');
    
        parent::__construct($data);
    }
    
    /**
     * Affichage d'une galerie
     */
    public function show(){
        $data = Array();
        
        // récupèration des infos de la galerie
        $data['galerie'] = $this->get_values();
        
        // On vérifie que l'url est bien la bonne : galeries/id/title
        $data['urlrw'] = \Tools::formatURLRewrite($this->get('galerie_title'));
        if(isset($_GET['urlrwtxt']) && $_GET['urlrwtxt'] != $data['urlrw']){
            header('HTTP/1.1 301 Moved Permanently');
            $location = $this->conf->get('realpath').'galeries/'.$this->get('galerie_id').'/'.$data['urlrw'];
            header('Location: '.$location);
            header('Connection: close');
        }
        
        // récupèration des infos du multipage
        $this->conf->set('elem_per_page',40);
        $tmp = $this->db->preparedQuery('SELECT COUNT(*) FROM image WHERE galerie_id = ? AND image_active = 1', Array($this->get('galerie_id')), \DB::SINGLE_ROW);
        $data['multipage'] = $this->get_multipage_data($tmp['COUNT(*)']);
        
        // récupèration des images
        $query = 'SELECT * FROM image WHERE galerie_id = ? AND image_active = 1 ORDER BY -image_order DESC';
        $query = $this->add_order_limit($query, $data['multipage']);
        $data['images'] = $this->db->preparedQuery($query, Array($this->get('galerie_id')));
        
        $this->set_template('galerie.tpl');
        $this->conf->set('site_description', $this->get('galerie_title').' : '.$this->get('galerie_description'));
        $this->conf->set('site_title', 'Galerie : '.$this->get('galerie_title'));
        \Controller::load_prettyPhoto();
        return $data;
    }
    
    /**
     * Affichage de la liste des galeries
     */
    public function showlist(){
        $data = Array();
        
        if($this->mode == \Model::FRONTEND){
            $query = 'SELECT * FROM galerie LEFT JOIN user ON galerie.user_id = user.user_id WHERE galerie_active = 1';
            $tmp = $this->db->query('SELECT COUNT(*) FROM galerie WHERE galerie_active = 1', \DB::SINGLE_ROW);
            $this->conf->set('site_title', 'Galeries : poteries, céramiques, expos, etc');
        } else {
            $query = 'SELECT * FROM galerie LEFT JOIN user ON galerie.user_id = user.user_id';
            $tmp = $this->db->query('SELECT COUNT(*) FROM galerie', \DB::SINGLE_ROW);
            $this->conf->set('site_title', 'Gestion des galeries');
        }
        
        $data['multipage'] = $this->get_multipage_data($tmp['COUNT(*)']);
        $query = $this->add_order_limit($query, $data['multipage']);
        $data['galeries'] = $this->db->query($query);
        
        // chargement d'une image
        if($this->mode == \Model::FRONTEND){
            foreach($data['galeries'] as $num => $galerie){
                // on prend une image aléatoire si on a pas défini d'ordre
                $query = 'SELECT * FROM image WHERE image_active = 1 AND galerie_id = ? ORDER BY -image_order DESC, RAND() LIMIT 1';
                $data['galeries'][$num]['image'] = $this->db->preparedQuery($query, Array($galerie['galerie_id']), \DB::SINGLE_ROW);
                $data['galeries'][$num]['urlrw'] = \Tools::formatURLRewrite($galerie['galerie_title']);
            }
        }
        
        $this->set_template('galerie_list.tpl', \Model::FRONTEND);
        $this->set_template('galerie_list_admin.tpl', \Model::BACKEND);
        
        $this->conf->set('site_description', 'Galeries photo des poteries et céramiques de Valérie, des expositions et bien d\'autres choses.');
        return $data;
    }
    
    public function editform(){
        $res = Array();
        $res = $this->get_values();
            
        $res['galerie_images'] = $this->db->preparedQuery('SELECT * FROM image WHERE galerie_id = ?', Array($this->get('galerie_id')));

        // on charge les mots clés associés
        $res['used_keywords'] = $this->get_keywords();

        $this->conf->set('site_description', 'Modification de la galerie photo '.$this->get('galerie_title')); 
        $this->conf->set('site_title', 'Modification de la galerie : '.$this->get('galerie_title'));
        $this->conf->add('js', 'core/js/keyword.js');
        $this->set_template('galerie_form.tpl',\Model::BACKEND);
        return $res;
    }
    
    public function createform(){
        $res = Array();
        $this->conf->set('site_description', 'Création d\'une nouvelle galerie photo'); 
        $this->conf->set('site_title', 'Création d\'une galerie');
        $this->conf->add('js', 'core/js/keyword.js');
        $this->set_template('galerie_form.tpl',\Model::BACKEND);
        return $res;
    }
    
    /**
     * Insertion d'une galerie
     */
    public function create(){
        $this->set('user_id', $_SESSION['user']['user_id']);
        $this->set('galerie_active', 0);

        // attention hébergement mutualisé n'autorise pas les TRIGGER
        // vérification existence trigger...
        $tmp = $this->db->query('SELECT EVENT_MANIPULATION FROM INFORMATION_SCHEMA.TRIGGERS WHERE TRIGGER_NAME = "galerie_created"', \DB::SINGLE_ROW);
        if($tmp == Array()){
            // le trigger n'existe pas ! on simule son comportement
            $this->set('galerie_created', date("Y-m-d H:i:s"));
            // on passe outre la validation
            $this->set('galerie_created', true);
        }

        if(parent::create()){
            notification('validation', 'Galerie créée avec succès !');
            $this->insert_keywords();
        }
        
        $this->set_redirection('module=Galerie&model=Galerie&action=showlist&admin');
    }
    
    /**
     * Modification d'une galerie
     */
    public function update(){
        $bool = parent::update();
        $this->insert_keywords();
        $this->set_redirection('module=Galerie&model=Galerie&action=showlist&admin');
        return $bool;
    }
    
    /**
     * Gestion des images de la galerie
     */
    public function manage(){
        $res = NULL;
        
        // données multipage
        $query = 'SELECT COUNT(*) FROM image WHERE galerie_id = ?';
        $tmp = $this->db->preparedQuery($query, Array($this->get('galerie_id')), \DB::SINGLE_ROW);
        $res['multipage'] = $this->get_multipage_data($tmp['COUNT(*)']);
        
        // récupèration des données de la galerie
        $res['galerie'] = $this->get_values();

        // récupèration des images
        $query = 'SELECT * FROM image LEFT JOIN user ON image.user_id = user.user_id WHERE galerie_id = ?';
        $query = $this->add_order_limit($query, $res['multipage'], Array('image_id','image_title','image_description','image_created','image_order'));
        if(($pos = strpos($query, 'image_order ASC')) != false){
            $query = substr_replace($query, '-image_order DESC', $pos, 15);
        } else if(($pos = strpos($query, 'image_order DESC')) != false){
            $query = substr_replace($query, 'ISNULL(image_order), image_order DESC', $pos, 16);
        }
        $res['images'] = $this->db->preparedQuery($query, Array($this->get('galerie_id')));
        
        $this->set_template('galerie_manage.tpl', \Model::BACKEND);
        $this->conf->set('site_description', 'Gestion des images de la galerie '.$this->get('galerie_title').' : '.$this->get('galerie_description'));
        $this->conf->set('site_title', 'Gestion des images de la galerie : '.$this->get('galerie_title'));
        
        $tmp = $this->conf->get('galerie');
        $res['max_file_size'] = $tmp['max_file_size'];
        ini_set("upload_max_filesize", $tmp['max_file_size']); 
        
        \Controller::load_shadowbox();
        return $res;
    }
    
    /**
     * Téléchargement d'images dans la galerie
     */
    public function upload(){
        if(!isset($_FILES['file'])){
            notification('error','Aucune image n\'a pu être transférée, vérifiez que vous n\'envoyez pas plus de '.ini_get('max_file_uploads').' fichiers simultanément, ou des fichiers d\'une taille supérieure à '.ini_get('upload_max_filesize').'o');
            redirect('module=Galerie&model=Galerie&action=manage&admin&pk='.$this->get('galerie_id'));
        }

        $config = $this->conf->get('galerie');
        
        foreach($_FILES['file']['name'] as $i => $name){
            $FILE = Array();
            $FILE['name'] = $_FILES['file']['name'][$i];
            $FILE['type'] = $_FILES['file']['type'][$i];
            $FILE['tmp_name'] = $_FILES['file']['tmp_name'][$i];
            $FILE['error'] = $_FILES['file']['error'][$i];
            $FILE['size'] = $_FILES['file']['size'][$i];
            $FILE['max_file_size'] = $config['max_file_size']; 
            
            $ext = strtolower(substr(strrchr($name,'.'),1));
            $name = substr($name,0,strrpos($name,'.'));
            $nomfichier = uniqid('gimg').'.'.$ext;
            
            $cible_redim = $config['file_upload_dir'] . $nomfichier;
            $cible_thumb = $config['file_upload_dir'] . 'thumbnails/' . $nomfichier;
            $cible_preview = $config['file_upload_dir'] . 'preview/' . $nomfichier;
            
            if($config['keep_original_img']){
                $cible = $this->conf->get('user_files_dir') . $nomfichier;
            } else {
                $cible = $cible_redim;
            }
            
            if(\Tools::uploadImage($FILE, $cible)){
                $ok = true;
                $ok &= \Tools::resizeImage($cible, $cible_thumb, $FILE['type'], $config['thumb_width'], $config['thumb_height'], $config['thumb_quality'], $config['img_color_background']);
                $ok &= \Tools::resizeImage($cible, $cible_preview, $FILE['type'], 300, 300, 80, "FFFFFF");
                $ok &= \Tools::resizeImage($cible, $cible_redim, $FILE['type'], $config['img_width'], $config['img_height'], $config['img_quality'], $config['img_color_background']);
                
                if($ok){
                    $query = 'INSERT INTO image(image_title, image_url, user_id, galerie_id, image_size) VALUES(?, ?, ?, ?, ?)';
                    $bool = $this->db->preparedQuery($query, Array($name, $nomfichier, $_SESSION['user']['user_id'], $this->get('galerie_id'), filesize($cible_redim)));
                    if(!$bool){
                        notification('error', $name.' : erreur lors de l\'ajout à la base de données.'); continue;
                    }
                } else {
                    notification('error', $name.' : erreur lors des redimensionnements.'); continue;         
                }
            } else {
                notification('error', $name.' : erreur lors du déplacement du fichier.'); continue;
            }
        }
        
        if(isset($_SERVER['HTTP_REFERER']))
            redirect($_SERVER['HTTP_REFERER']);
        else
            redirect('module=Galerie&model=Galerie&action=manage&pk='.$this->get('galerie_id').'&admin');
    }
    
    /**
     * Suppression d'une galerie
     */
    public function delete(){
        // on supprime les images de la galerie
        $query = 'SELECT * FROM image WHERE galerie_id = ?';
        $data = $this->db->preparedQuery($query, Array($this->get('galerie_id')));
        foreach($data as $image){
            $config = $this->conf->get('galerie');
            unlink($config['file_upload_dir'].$image['image_url']);
            unlink($config['file_upload_dir'].'thumbnails/'.$image['image_url']);
            unlink($config['file_upload_dir'].'preview/'.$image['image_url']);
        }
        
        // on supprime la galerie elle même
        return parent::delete();
    }
    
    /**
     * Fonction appelée par le modèle Home notamment
     * pour récupèrer les données nécessaires pour l'espace perso
     * @return Array
     */
    public static function getHomeData(){
        $data = Array();
        $db = \DB::getInstance();
        
        // On charge les statistiques : nbr de galerie, nbr d'images, poids total
        $query = 'SELECT COUNT(*) FROM galerie';
        $tmp = $db->query($query, \DB::SINGLE_ROW);
        $data['nb_galeries'] = $tmp['COUNT(*)'];
        
        $query = 'SELECT COUNT(*) FROM image';
        $tmp = $db->query($query, \DB::SINGLE_ROW);
        $data['nb_images'] = $tmp['COUNT(*)'];
        
        $query = 'SELECT SUM(image_size) FROM image';
        $tmp = $db->query($query, \DB::SINGLE_ROW);
        $data['total_size'] = $tmp['SUM(image_size)'];
        
        return $data;
    }
}
?>
