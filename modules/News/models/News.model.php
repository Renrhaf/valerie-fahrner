<?php
namespace News;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Objet définissant une news
 * \author renrhaf
 */
class News extends \ObjectModel{

    public function __construct(Array $data = NULL){
        $table = new \Table('news','actualité');
        \Field::create('Identifiant', 'news_id', \Field::INT, true, 1)->add_primary($table);
        \Field::create('Titre', 'news_title', \Field::STRING, true, 1, 64)->add($table);
        \Field::create('Contenu', 'news_content', \Field::HTML, true)->add($table);
        \Field::create('Date de création', 'news_created', \Field::TIMESTAMP, false)->add($table);
        \Field::create('Date de dernière modification', 'news_updated', \Field::TIMESTAMP, false)->add($table);
        \Field::create('Catégorie', 'news_categ_id', \Field::INT, false, 1)->add($table);
        \Field::create('Utilisateur', 'user_id', \Field::INT, false, 1)->add($table);
        \Field::create('Galerie', 'galerie_id', \Field::INT, false, 1)->add($table);
        \Field::create('Chemin vers l\'image', 'news_image_url', \Field::STRING, false, 1, 255)->add_unique($table, 'uk_news_image_url');
        \Field::create('Visibilité', 'news_active', \Field::INT, false, 0, 1)->add($table);
        $this->set_table($table);
        
        $this->redirect = Array(\Model::FRONTEND => 'module=News&model=News&action=showlist', \Model::BACKEND => 'module=News&model=News&action=showlist&admin');
    
        parent::__construct($data);
    }
    
    /**
     * Affiche la news
     */
    public function show(){
        $data = Array();
        
        // récupèration des infos de la news
        $data['news'] = $this->get_values();
        
        // On vérifie que l'url est bien la bonne : news/id/title
        $data['urlrw'] = \Tools::formatURLRewrite($this->get('news_title'));
        if(isset($_GET['urlrwtxt']) && $_GET['urlrwtxt'] != $data['urlrw']){
            header('HTTP/1.1 301 Moved Permanently');
            $location = $this->conf->get('realpath').'news/'.$this->get('news_id').'/'.$data['urlrw'];
            header('Location: '.$location);
            header('Connection: close');
        }
        
        // chargement des infos de l'utilisateur créateur
        $query = 'SELECT * FROM user WHERE user_id = ?';
        $data['news']['user'] = $this->db->preparedQuery($query, Array($this->get('user_id')), \DB::SINGLE_ROW);
        
        // chargement de la catégorie
        $query = 'SELECT * FROM news_categ WHERE news_categ_id = ?';
        $data['news']['categ'] = $this->db->preparedQuery($query, Array($this->get('news_categ_id')), \DB::SINGLE_ROW);
        if(isset($data['news']['categ']['news_categ_title'])){
            $data['news']['categ']['urlrw'] = \Tools::formatURLRewrite($data['news']['categ']['news_categ_title']);
        }
        
        // chargement des images de la galerie si définie
        if(isset($data['news']['galerie_id'])){
            $module_galerie = new \Galerie();
            $query = 'SELECT * FROM image WHERE image_active = 1 AND galerie_id = ? ORDER BY IF(ISNULL(image_order),1,0), image_order ASC LIMIT 0, 8';
            $data['news']['images'] = $this->db->preparedQuery($query, Array($this->get('galerie_id')));
            $query = 'SELECT galerie_title FROM galerie WHERE galerie_id = '.$data['news']['galerie_id'];
            $tmp = $this->db->query($query, \DB::SINGLE_ROW);
            $data['news']['galerie']['urlrw'] = \Tools::formatURLRewrite($tmp['galerie_title']);
        }
        
        $this->set_template('news.tpl');
        $this->conf->set('site_description', $this->get('news_content'));
        $this->conf->set('site_title', $this->get('news_title'));
        \Controller::load_shadowbox();
        \Controller::load_prettyPhoto();
        return $data;
    }
    
    /**
     * Affiche la liste des news
     */
    public function showlist(){
        $data = Array();
        
        if($this->mode == \Model::BACKEND){
            $query = 'SELECT news.*, user.user_fname, user.user_lname, galerie.galerie_id, news_categ.news_categ_title, galerie.galerie_title FROM news 
                                         LEFT JOIN news_categ ON news.news_categ_id = news_categ.news_categ_id 
                                         LEFT JOIN user ON news.user_id = user.user_id 
                                         LEFT JOIN galerie ON news.galerie_id = galerie.galerie_id';
            if(isset($_GET['news_categ_id']) && \CheckData::checkId($_GET['news_categ_id'])){
                $query .= 'WHERE news_categ.news_categ_id = '.$_GET['news_categ_id'];
            }
            $tmp = $this->db->query('SELECT COUNT(*) FROM news', \DB::SINGLE_ROW);
            $this->conf->set('site_title', 'Gestion des actualités');
        } else {
            $query = 'SELECT news.*, user.user_fname, user.user_lname, galerie.galerie_id, news_categ.news_categ_title FROM news 
                                         LEFT JOIN news_categ ON news.news_categ_id = news_categ.news_categ_id 
                                         LEFT JOIN user ON news.user_id = user.user_id 
                                         LEFT JOIN galerie ON news.galerie_id = galerie.galerie_id
                                         WHERE news_active = 1';
            if(isset($_GET['news_categ_id']) && \CheckData::checkId($_GET['news_categ_id'])){
                $query .= ' AND news_categ.news_categ_id = '.$_GET['news_categ_id'];
            }
            $tmp = $this->db->query('SELECT COUNT(*) FROM news WHERE news_active = 1', \DB::SINGLE_ROW);
            $this->conf->set('site_title', 'Toutes les actualités sur les poteries/céramiques et installations');
        }
        
        // on tri par date de création
        $_GET['tri'] = 'news_created'; $_GET['ord'] = 'DESC';
        
        $data['multipage'] = $this->get_multipage_data($tmp['COUNT(*)']);
        $query = $this->add_order_limit($query, $data['multipage'], Array('news_categ_title'));
        $data['news'] = $this->db->query($query);
        
        foreach($data['news'] as $i => $news){
            $already_loaded = false;
            // chargement des images de la galerie si définie
            if(isset($news['galerie_id'])){
                if(!$already_loaded){
                    $module_galerie = new \Galerie();
                    $already_loaded = true;
                }
                $query = 'SELECT * FROM image WHERE image_active = 1 AND galerie_id = ? ORDER BY RAND() LIMIT 0, 8';
                $data['news'][$i]['images'] = $this->db->preparedQuery($query, Array($news['galerie_id']));
            }
            
            $data['news'][$i]['news_content'] = substr(strip_tags($news['news_content']), 0, 308)."...";
            $data['news'][$i]['urlrw'] = \Tools::formatURLRewrite($news['news_title']);
            $data['news'][$i]['categ_urlrw'] = \Tools::formatURLRewrite($news['news_categ_title']);
        }
        
        if(isset($_GET['news_categ_id']) && \CheckData::checkId($_GET['news_categ_id']) && !isset($data['news'][0])){
            $query = 'SELECT news_categ_title FROM news_categ WHERE news_categ_id = '.$_GET['news_categ_id'];
            $tmp = $this->db->query($query, \DB::SINGLE_ROW);
            if(isset($tmp['news_categ_title']))
            $data['news_categ_title'] = $tmp['news_categ_title'];
            else
                throw new \Exception('la catégorie d\'id '.$_GET['news_categ_id'].' n\'existe pas');
        } else if(isset($_GET['news_categ_id']) && \CheckData::checkId($_GET['news_categ_id'])) {
            $data['news_categ_title'] = $data['news'][0]['news_categ_title'];
        }
        
        
        // Si on tri selon une categorie, on vérifie que l'url est bien la bonne : news/categ-id/title
        if(isset($_GET['news_categ_id']) && \CheckData::checkId($_GET['news_categ_id'])){
            $data['urlrw'] = \Tools::formatURLRewrite($data['news_categ_title']);
            if(isset($_GET['urlrwtxt']) && $_GET['urlrwtxt'] != $data['urlrw']){
                header('HTTP/1.1 301 Moved Permanently');
                $location = $this->conf->get('realpath').'news/categ-'.$_GET['news_categ_id'].'/'.$data['urlrw'];
                header('Location: '.$location);
                header('Connection: close');
            }
        }
        
        $this->set_template('news_list.tpl', \Model::FRONTEND);
        $this->set_template('news_list_admin.tpl', \Model::BACKEND);
        
        $this->conf->set('site_description', 'Tenez-vous informé des nouvelles poteries et céramiques créées par Valérie dans son atelier à Wittisheim en Alsace, ainsi que des installations.');
        \Controller::load_shadowbox();
        return $data;
    }
    
    public function editform(){
        $data = Array();
        $data = $this->get_values();  
        // on charge les mots clés associés
        $data['used_keywords'] = $this->get_keywords();
        $this->conf->set('site_description', $this->conf->get('site_title').' : modification d\'une actualité '.$this->get('news_title')); 
        $this->conf->set('site_title', 'Modification d\'une actualité - '.$this->conf->get('site_title'));
        
        // on charge les catégories
        $this->db->setFetchMode(\DB::TWO_COLUMNS);
        $data['categs'] = $this->db->query('SELECT news_categ_id, news_categ_title FROM news_categ');
        // et les galeries
        $data['galeries'] = $this->db->query('SELECT galerie_id, galerie_title FROM galerie');
        $this->db->setFetchMode(\DB::ARRAY_ASSOC);

        \Controller::load_shadowbox();
        \Controller::load_tinyMCE();
        $this->conf->add('js', 'core/js/keyword.js');
        $this->set_template('news_form.tpl', \Model::BACKEND);
        return $data;
    }
    
    public function createform(){
        $data = Array();
        $this->conf->set('site_description', 'Création d\'une nouvelle actualité');
        $this->conf->set('site_title', 'Création d\'une actualité'); 
        
        // on charge les catégories
        $this->db->setFetchMode(\DB::TWO_COLUMNS);
        $data['categs'] = $this->db->query('SELECT news_categ_id, news_categ_title FROM news_categ');
        // et les galeries
        $data['galeries'] = $this->db->query('SELECT galerie_id, galerie_title FROM galerie');
        $this->db->setFetchMode(\DB::ARRAY_ASSOC);
        
        \Controller::load_shadowbox();
        \Controller::load_tinyMCE();
        $this->conf->add('js', 'core/js/keyword.js');
        $this->set_template('news_form.tpl', \Model::BACKEND);
        return $data;
    }
    
    
    /**
     * Création d'une actualité
     */
    public function create(){
        $this->set('user_id', $_SESSION['user']['user_id']);
        $this->set('news_active', 0);

        // attention hébergement mutualisé n'autorise pas TRIGGER
        // vérification existence trigger...
        $tmp = $this->db->query('SELECT EVENT_MANIPULATION FROM INFORMATION_SCHEMA.TRIGGERS WHERE TRIGGER_NAME = "news_created"', \DB::SINGLE_ROW);
        if($tmp == Array()){
            // le trigger n'existe pas ! on simule son comportement
            $this->set('news_created', date("Y-m-d H:i:s"));
            // on passe outre la validation
            $this->get_field('news_created')->set_valid(true);
        }

        $bool = parent::create();
        if($bool){
            notification('validation', 'Actualité créée avec succès !');
            // enregistrement de l'image
            if(isset($_FILES['image']) && $_FILES['image']['name'] != ''){
                $url = $this->get('news_image_url');
                if(isset($url)){
                    $config = $this->conf->get('news');
                    unlink($config['file_upload_dir'].$url);
                    unlink($config['file_upload_dir'].'thumbnails/'.$url);
                }
                $this->upload_image();
            }
            // on gère les mots clés
            $this->insert_keywords();
        }
        return $bool;
    }
    
    /**
     * Modification d'une actualité 
     */
    public function update(){
        $bool = parent::update();
        if($bool){
            // enregistrement de l'image
            if(isset($_FILES['image']) && $_FILES['image']['name'] != ''){
                $url = $this->get('news_image_url');
                if(isset($url)){
                    $config = $this->conf->get('news');
                    unlink($config['file_upload_dir'].$url);
                    unlink($config['file_upload_dir'].'thumbnails/'.$url);
                }
                $this->upload_image();
            }
            $this->insert_keywords();
        }
        return $bool;
    }
    
    
    /**
     * Téléchargement de l'image de l'actualité
     */
    private function upload_image(){  
        $config = $this->conf->get('news');
        $FILE = $_FILES['image'];
        $FILE['max_file_size'] = $config['max_file_size']; 
        
        $ext = strtolower(substr(strrchr($FILE['name'],'.'),1));
        $name = substr($FILE['name'],0,strrpos($FILE['name'],'.'));
        $nomfichier = uniqid('nimg').'.'.$ext;

        $cible_redim = $config['file_upload_dir'] . $nomfichier;
        $cible_thumb = $config['file_upload_dir'] . 'thumbnails/' . $nomfichier;

        if($config['keep_original_img']){
            $cible = $this->conf->get('user_files_dir') . $nomfichier;
        } else {
            $cible = $cible_redim;
        }

        if(\Tools::uploadImage($FILE, $cible)){
            $ok = true;
            $ok &= \Tools::resizeImage($cible, $cible_thumb, $FILE['type'], $config['thumb_width'], $config['thumb_height'], $config['thumb_quality'], $config['img_color_background']);
            $ok &= \Tools::resizeImage($cible, $cible_redim, $FILE['type'], $config['img_width'], $config['img_height'], $config['img_quality'], $config['img_color_background']);
                        
            if($ok){
                $this->set('news_image_url', $nomfichier);
                parent::update();
            }
        }
    }
    
    /**
     * Suppression d'une actualité
     */
    public function delete(){
        // suppression de l'image
        $url = $this->get('news_image_url');
        if(isset($url) && $url != ''){
            $config = $this->conf->get('news');
            unlink($config['file_upload_dir'].$url);
            unlink($config['file_upload_dir'].'thumbnails/'.$url);
        }
        
        // suppression de l'actualité
        return parent::delete();
    }
    
    /**
     * Supprime l'image associée à une actualité
     */
    public function remove_image(){
        // suppression de l'image
        $id = $this->get('news_id');
        $url = $this->get('news_image_url');
        if(isset($url) && $url != ''){
            $config = $this->conf->get('news');
            @unlink($config['file_upload_dir'].$url);
            @unlink($config['file_upload_dir'].'thumbnails/'.$url);
        }
        
        // on réinitialise pour sauvegarde
        $this->reset();
        $this->set('news_id', $id);
        $this->set('news_image_url', NULL);
        $tmp = parent::update();
        if($this->conf->get('ajax')){
            echo($tmp);exit;
        }
        return $tmp;
    }
    
    
    /**
     * Fonction appelée par le modèle Home notamment
     * pour récupèrer les données nécessaires pour l'espace perso
     * @return Array
     */
    public static function getHomeData(){
        $data = Array();
        $db = \DB::getInstance();
        
        // On charge les statistiques : nbr de news, nbr de categories, categorie principale
        $query = 'SELECT COUNT(*) FROM news';
        $tmp = $db->query($query, \DB::SINGLE_ROW);
        $data['nb_news'] = $tmp['COUNT(*)'];
        
        $query = 'SELECT COUNT(*) FROM news_categ';
        $tmp = $db->query($query, \DB::SINGLE_ROW);
        $data['nb_news_categ'] = $tmp['COUNT(*)'];
        
        // On charge la categorie la plus utilisée
        $query = 'SELECT news_categ_title, COUNT(*) FROM news_categ INNER JOIN news ON news.news_categ_id = news_categ.news_categ_id GROUP BY news_categ_title ORDER BY COUNT(*) DESC LIMIT 1';
        $tmp = $db->query($query, \DB::SINGLE_ROW);
        if(isset($tmp['news_categ_title']))
            $data['most_used_categ'] = $tmp['news_categ_title']; 
        else 
            $data['most_used_categ'] = 'Aucune catégorie pour le moment';
        
        return $data;
    }
}
?>
