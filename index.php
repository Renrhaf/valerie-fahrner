<?php
define('START_TIME', microtime(true));  // On mémorise le temps au démarrage
define('_G_INCLUDED', 1);               // Sécurisation du Framework
require_once('includes/includes.php');  // Classes générales + Autoloader
ob_start("ob_gzhandler");               // Compression GZIP ou DEFLATE

/**
 * Contrôleur frontal du Framework
 *  - Effectue les redirections vers la bonne action, le bon modèle et module
 *  - Initialise les configurations et l'accès à la base de données
 *  - Unique point d'entrée du système
 */
final class Controller extends MasterClass{
    
    // Module, modèle et action
    public static $module = NULL;
    public static $model = NULL;
    public static $action = NULL;
    // Layout utilisé pour afficher la page
    public static $layout = NULL;
    
    /**
     * Lance le traitement de la requête utilisateur et le chargement de la page
     */
    public function __construct(){       
        try{
            // initialisation config, DB, Smarty, module, model, action
            $this->initialize();

            // on lance l'action sur le modèle
            $data = Controller::$action->perform();
        
            // on récupère le template du modèle
            $template = Controller::$model->get_template();
            
            // on affiche le layout
            Controller::$layout->set_template($template);
            Controller::$layout->display($data);
        
        } catch(Exception $e){
            $this->handle_exception($e);
            $data = Controller::$action->perform(Controller::$model);
            $template = Controller::$model->get_template();
            
            // on affiche le layout
            Controller::$layout->set_template($template);
            Controller::$layout->display($data);
        }
    }
    
    /**
     * Initialisation du Framework
     * @throws ActionNotExists, ModelNotExists, ModuleNotExists
     */
    public function initialize(){
        // Sécurisation des sessions
        ini_set("session.use_trans_sid","0");
        ini_set("url_rewriter.tags","");
        ini_set("arg_separator.output","&amp;");

        // Lancement de la session
        session_start();

        // Définition de la zone temporelle
        date_default_timezone_set('Europe/Paris');
        
        // Initalisation des configurations à partir du XML
        $this->conf = Config::getInstance();
        
        // Affichage des erreurs
        if($this->conf->get('debug')){
            error_reporting(-1);
            Debug::loadFromSession();
        } else {
            error_reporting(0);
        }
        
        // Initialisation de la base de données
        $this->db = DB::getInstance();     
        
        // Initialisation des alertes
        if(!isset($_SESSION['error']))
            $_SESSION['error'] = array();
        if(!isset($_SESSION['info']))
            $_SESSION['info'] = array();
        if(!isset($_SESSION['validation']))
            $_SESSION['validation'] = array();
        
        // Initialisation du layout par défaut
        Controller::$layout = new Layout\DefaultLayout();
        
        // Détermination du module concerné par la requête
        $module = 'Core';
        if(isset($_GET['module']) && ucfirst($_GET['module']) != 'Core' && $_GET['module'] != '')
            $module = ucfirst($_GET['module']);
        
        // L'autoload prend en charge - voir includes.php
        Controller::$module = new $module();
        
        // Détermination du modèle concerné par la requête
        if(isset($_GET['model']) && $_GET['model'] != '')
            $model = $module.'\\'.ucfirst($_GET['model']);
        else
            $model = $module.'\\'.Controller::$module->get_default_model();
        
        // L'autoload prend en charge - voir includes.php
        Controller::$model = new $model(); 
        
        // Détermination de l'action concernée par la requête
        $action = 'Action\\'.Controller::$model->get_default_action();
        if(isset($_GET['action']) && $_GET['action'] != '')
            $action = 'Action\\'.ucfirst($_GET['action']);
        
        // L'autoload prend en charge - voir includes.php
        Controller::$action = new $action(Controller::$model);
    }
    
    /**
     * Traite l'exception passée et affiche les infos
     * @param Exception $e 
     */
    private function handle_exception(Exception $e){
        // si erreur, on l'affiche avec le modèle Error
        Controller::$module = new Core();
        Controller::$model = new Core\Error($e);
        Controller::$action = new Action\Show(Controller::$model);
    }
    
    /**
     * Charge les fichiers nécessaires à l'utilisation de formValidator
     */
    public static function load_form_validator(){
        $conf = Config::getInstance();
        $conf->add('js','libs/formValidator2.5/js/jquery.validationEngine.js');
        $conf->add('js','libs/formValidator2.5/js/languages/jquery.validationEngine-fr.js');
        $conf->add('css','libs/formValidator2.5/css/validationEngine.jquery.css');
        $conf->add('js_script_append','$(\'.formulaire\').validationEngine(\'attach\');');
    }
    
    /**
     * Charge les fichiers nécessaires à l'utilisation de Shadowbox
     */
    public static function load_shadowbox(){
        $conf = Config::getInstance();
        $conf->add('js','libs/shadowbox/shadowbox.js');
        $conf->add('css','libs/shadowbox/shadowbox.css');
        
        $script = 'Shadowbox.init({
                    continuous: true,
                    overlayOpacity: 0.7
                    });';
        $conf->add('js_script_append',$script);
    }
    
    /**
     * Charge les fichiers nécessaires à l'utilisation de prettyPhoto
     */
    public static function load_prettyPhoto(){
        $conf = Config::getInstance();
        $conf->add('js','libs/prettyPhoto/js/jquery.prettyPhoto.js');
        $conf->add('css','libs/prettyPhoto/css/prettyPhoto.css');
        $conf->add('js_script_append','$("a[rel^=\'prettyPhoto\']").prettyPhoto();');
    }
    
    /**
     * Charge les fichiers nécessaires à l'utilisation de TinyMCE
     */
    public static function load_tinyMCE(){
        $conf = Config::getInstance();
        $conf->add('async_js','libs/tinymce/jscripts/tiny_mce/tiny_mce.js');
        $conf->add('async_js', 'core/js/tinyMCE.js');
    }
    
    /**
     * Charge les fichiers nécessaires à l'utilisation de HTMLpurifier
     */
    public static function load_HTMLpurifier(){
        require_once 'libs/htmlpurifier/library/HTMLPurifier.auto.php';
    }
}
new Controller();


/* Fonction de redirection */
function redirect($where = ''){
    if(substr($where,0,4) == 'http'){
        if(Config::getInstance()->get('debug')){
            Debug::add('Redirection',$where); Debug::saveInSession();
        }
        header('Location:'.$where); exit;
    } else { 
        if(Config::getInstance()->get('debug')){
            Debug::add('Redirection',Config::getInstance()->get('realpath').'index.php?'.$where); Debug::saveInSession();
        }
        header('Location:'.Config::getInstance()->get('realpath').'index.php?'.$where); exit;
    }
}

/* Fonction de notification */
function notification($type,$string){
    $conf = Config::getInstance();
    if($conf->get('debug'))
        Debug::add('Notification '.$type, $string);
    if(!$conf->get('ajax'))
        $_SESSION[$type][] = $string;
}
?>