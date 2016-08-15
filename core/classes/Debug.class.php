<?php
if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Gestion et affichage d'informations de débuggage
 */
abstract class Debug{
    private static $infos = Array();
    private static $start_time = START_TIME;
    
    /**
     * Ajoute des infos de débug
     * @param String $class le nom de la classe ou du fichier
     * @param String $message le message de débug à afficher
     */
    public static function add($class, $message){
        Debug::$infos[] = Array('title' => $class, 'message' => $message, 'time' => microtime(true) - Debug::$start_time);
    }
    
    /**
     * Sauvegarde en Session les infos, avant une redirection
     */
    public static function saveInSession(){
        $_SESSION['debug'] = Array();
        foreach(Debug::$infos as $info){
            $_SESSION['debug'][] = $info;
        }
        $_SESSION['debug_last_request_nb'] = DB::getInstance()->getNumberRequest();
        $_SESSION['debug_last_start_time'] = Debug::$start_time;
    }
    
    /**
     * Restaure les infos depuis la Session, après une redirection
     */
    public static function loadFromSession(){
        if(isset($_SESSION['debug'])){
            foreach($_SESSION['debug'] as $saved_debug_info){
                Debug::$infos[] = Array('title' => $saved_debug_info['title'], 'message' => $saved_debug_info['message'], 'time' => $saved_debug_info['time']);
            }
            unset($_SESSION['debug']);
            
            Debug::$start_time = (float)$_SESSION['debug_last_start_time'];            
            unset($_SESSION['debug_last_start_time']);
        }
    }
    
    /**
     * Renvoi les infos de débug
     */
    public static function getInfos(){
        return Debug::$infos;
    }
}
?>
