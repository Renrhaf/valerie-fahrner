<?php
namespace Core;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Modèle de la page principale d'administration du site
 * \author renrhaf
 */
class Home extends \Model{

    public function __construct(){
        parent::__construct();
    }
    
    public function show(){
        $data = Array();
        
        // On contrôle l'accès
        if(!isset($_SESSION['user'])){
            throw new \Exception\AccessDenied('Vous devez être connecté');
        }
        
        // On charge les données de l'utilisateur
        $data['user'] = $_SESSION['user'];
        
        // On charge la profession
        $query = 'SELECT * FROM profession WHERE profession_id = ?';
        $data['profession'] = $this->db->preparedQuery($query, Array($data['user']['profession_id']), \DB::SINGLE_ROW);
        
        // On charge le nombre d'utilisateurs
        $query = 'SELECT COUNT(*) AS total_users, MAX(user_created) AS last_date FROM user';
        $data['miscellaneous'] = $this->db->query($query, \DB::SINGLE_ROW);
        
        // On charge la profession la plus utilisée
        $query = 'SELECT profession_name, COUNT(*) FROM profession INNER JOIN user ON user.profession_id = profession.profession_id GROUP BY profession_name ORDER BY COUNT(*) DESC LIMIT 1';
        $tmp = $this->db->query($query, \DB::SINGLE_ROW);
        if(isset($tmp['profession_name']))
            $data['miscellaneous']['most_used_prof'] = $tmp['profession_name']; 
        
        $data['site_status'] = Site::get_site_status();
        
        
        // On charge les données des galeries
        $data['galerie'] = \Galerie\Galerie::getHomeData();
        
        // On charge les données des news
        $data['news'] = \News\News::getHomeData();
        
        $this->set_template('home.tpl');
        $this->conf->set('site_description', $_SESSION['user']['user_fname'].' '.$_SESSION['user']['user_lname'].', bienvenue dans votre espace personnel sur le site');
        $this->conf->set('site_title', 'Administration du site');
        return $data;
    }
}
?>


