<?php
namespace Core;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Modèle du site lui-même, gestion des configurations
 * et mise en maintenance/remise en ligne
 */
class Site extends \Model{

    public function __construct(){
        parent::__construct();
        
        $this->redirect = Array(\Model::FRONTEND => 'model=Home', \Model::BACKEND => 'model=Home&admin');
    }
    
    /**
     * Renvoi vrai si le site et en ligne, faux sinon
     * @return Boolean
     */
    public static function get_site_status(){
        if(file_exists('maintenance/config.xml')){
            return false;
        } else {
            return true;
        }
    }
    
    /**
     * Réalise la mise en maintenance ou la remise en ligne du site
     * @param Boolean $status
     * @param String $estimated_duration
     */
    public function set_maintenance($status, $estimated_duration){
        if($status){
            $date = date('d/m/Y');
            $hour = date('H:i');
            $ip = $_SERVER['REMOTE_ADDR'];
            $ip = str_replace('.','\.', $ip);

            $new_htaccess_content = "";
            $new_htaccess_content .= "Options +FollowSymLinks \n";
            $new_htaccess_content .= "RewriteEngine On \n";
            $new_htaccess_content .= "RewriteBase / \n";
            $new_htaccess_content .= "RewriteCond %{REQUEST_URI} !^/maintenance/maintenance.php [NC] \n";
            $new_htaccess_content .= "RewriteCond %{REMOTE_ADDR} !^$ip \n";
            $new_htaccess_content .= "RewriteRule .* /maintenance/maintenance.php [R=302,L] \n";

            // On met l'ancien .htaccess en backup
            if(!rename('.htaccess', 'real_htaccess.txt')){
                echo(json_encode(Array('error' => 'Impossible de renommer le fichier htaccess')));
                exit;
            }

            // On créé le nouveau .htaccess
            if(!file_put_contents('.htaccess', $new_htaccess_content)){
                echo(json_encode(Array('error' => 'Impossible de créer le nouveau fichier htaccess')));
                exit;
            }

            // On écrit les configs de la maintenance (début, durée)
            $config_content = "";
            $config_content .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?> \n";
            $config_content .= "<root> \n";
            $config_content .= "\t<start_date>$date</start_date> \n";
            $config_content .= "\t<start_hour>$hour</start_hour> \n";
            $config_content .= "\t<estimated_duration>$estimated_duration</estimated_duration> \n";
            $config_content .= "</root> \n";

            if(!file_put_contents('maintenance/config.xml', $config_content)){
                echo(json_encode(Array('error' => 'Impossible de créer le fichier de configuration relatif à la mise en maintenance')));
                exit;
            }
            
            echo(json_encode(Array('validation' => 'Le site est maintenant en maintenance, vous seul pouvez encore y accèder')));
            exit;
            
        } else {
            // on remet en place le fichier htaccess normal
            if(!@unlink('.htaccess')){
                echo(json_encode(Array('error' => 'Impossible de supprimer le fichier htaccess')));
                exit;
            }
            
            if(!rename('real_htaccess.txt', '.htaccess')){
                echo(json_encode(Array('error' => 'Impossible de renommer le fichier backup htaccess')));
                exit;
            }
            
            // On supprime le fichier de config
            @unlink('maintenance/config.xml');
            
            echo(json_encode(Array('validation' => 'Le site est à nouveau en ligne !')));
            exit;
        }
    }
}
?>
