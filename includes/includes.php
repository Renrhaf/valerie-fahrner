<?php
if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Inclusion des fichiers généraux
 */
include_once('config/Config.class.php');
include_once('core/classes/MasterClass.class.php');
include_once('core/classes/DB.class.php');
include_once('core/classes/Table.class.php');
include_once('core/classes/Field.class.php');
include_once('core/classes/Model.class.php');
include_once('core/classes/ObjectModel.class.php');
include_once('core/classes/Module.class.php');
include_once('core/classes/Action.class.php');
include_once('core/classes/CheckData.class.php');
include_once('core/classes/Tools.class.php');
include_once('core/classes/Debug.class.php');
include_once('core/classes/Layout.class.php');
include_once('libs/Smarty/Smarty.class.php');

/**
 * Autoload des modules et modèles ainsi que des exceptions en utilisant les namespaces
 * 
 * @example new $class_name();
 * @example new Module();
 * @example new Model();
 * @example new Module\Model();
 * @example new Exception\ObjectNotExists();
 * @param String $class_name
 * 
 * @throws ActionNotExists, ModelNotExists, ModuleNotExists
 */
function autoload($class_name){
    if(Config::getInstance()->get('debug')){
        Debug::add('Autoload', 'chargement de la classe '.$class_name);
    }
    
    // Si la classe utilise les namespaces
    if(strpos($class_name, '\\') != false){
        $class_name = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $class_name);
        $names = explode(DIRECTORY_SEPARATOR, $class_name);
        if(count($names) == 2){
            // 1. On vérifie si c'est un layout
            if($names[0] == 'Layout'){
                if(file_exists('core/layouts/'.$names[1].'.layout.php')){
                    include_once('core/layouts/'.$names[1].'.layout.php');
                } elseif(!(Controller::$module instanceof Core)) {
                    if(file_exists('modules/'.get_class(Controller::$module).'/layouts/'.$names[1].'.layout.php')){
                        include_once('modules/'.get_class(Controller::$module).'/layouts/'.$names[1].'.layout.php');
                    } else {
                        throw new Exception('Le layout '.$names[1].' n\'existe pas !');
                    }
                }
            
            // 2. On vérifie si c'est une exception
            } elseif($names[0] == 'Exception'){
                if(file_exists('core/exceptions/'.$names[1].'.class.php')){
                    include_once('core/exceptions/'.$names[1].'.class.php');
                } else {
                    throw new Exception('L\'exception '.$names[1].' n\'existe pas !');
                }
                
            // 3. On vérifie si c'est une action
            } elseif($names[0] == 'Action'){
                if(Controller::$module instanceof Core){
                    if(file_exists('core/actions/'.$names[1].'.action.php')){
                        include_once('core/actions/'.$names[1].'.action.php');
                    } else {
                        throw new Exception\ActionNotExists($names[1]);
                    }
                } else {
                    if(file_exists('modules/'.get_class(Controller::$module).'/actions/'.$names[1].'.action.php')){
                        include_once('modules/'.get_class(Controller::$module).'/actions/'.$names[1].'.action.php');
                    } else {
                        if(file_exists('core/actions/'.$names[1].'.action.php')){
                            include_once('core/actions/'.$names[1].'.action.php');
                        } else {
                            throw new Exception\ActionNotExists($names[1]);
                        } 
                    }
                }
                
            // 4. On vérifie si c'est le nom d'un module
            } else {
                // Si c'est le module Core on se contente de charger le modèle
                if($names[0] == 'Core'){
                    if(!class_exists('Core', false)){
                        include_once('core/Core.module.php');
                    }

                    if(file_exists('core/models/'.$names[1].'.model.php')){
                        include_once('core/models/'.$names[1].'.model.php');
                    } else {
                        throw new Exception\ModelNotExists('Le modèle '.$names[1].' n\'existe pas !');
                    }
                // Si c'est un autre module, on charge sa config et les fichiers CSS et JS
                } else {
                    if(!class_exists($names[0], false)){
                        if(file_exists('modules/'.$names[0].'/'.$names[0].'.module.php')){
                            include_once('modules/'.$names[0].'/'.$names[0].'.module.php');
                            Config::getInstance()->load_module_config($names[0]);
                            if(file_exists('modules/'.$names[0].'/'.strtolower($names[0]).'.css')){
                                Config::getInstance()->add('css','modules/'.$names[0].'/'.strtolower($names[0]).'.css');
                            }
                            if(file_exists('modules/'.$names[0].'/'.strtolower($names[0]).'.js')){
                                Config::getInstance()->add('async_js','modules/'.$names[0].'/'.strtolower($names[0]).'.js');
                            }
                        } else {
                            throw new Exception\ModuleNotExists('Le module '.$names[0].' n\'existe pas !');
                        }
                    }
                    // Et on charge le modèle demandé
                    if(file_exists('modules/'.$names[0].'/models/'.$names[1].'.model.php')){
                        include_once('modules/'.$names[0].'/models/'.$names[1].'.model.php');
                    } else {
                        throw new Exception\ModelNotExists('Le modèle '.$names[1].' n\'existe pas dans le module '.$names[0].' !');
                    }
                }
            }
        }
    } else {
        // On regarde si on chercher à charger un objet Module sans modèle
        if(file_exists('modules/'.$class_name.'/'.$class_name.'.module.php')){
            if(!class_exists($class_name, false)){
                if(file_exists('modules/'.$class_name.'/'.$class_name.'.module.php')){
                    include_once('modules/'.$class_name.'/'.$class_name.'.module.php');
                    Config::getInstance()->load_module_config($class_name);
                    if(file_exists('modules/'.$class_name.'/'.strtolower($class_name).'.css')){
                        Config::getInstance()->add('css','modules/'.$class_name.'/'.strtolower($class_name).'.css');
                    }
                    if(file_exists('modules/'.$class_name.'/'.strtolower($class_name).'.js')){
                        Config::getInstance()->add('async_js','modules/'.$class_name.'/'.strtolower($class_name).'.js');
                    }
                } else {
                    throw new Exception\ModuleNotExists('Le module '.$class_name.' n\'existe pas !');
                }
            }
        } elseif(file_exists('core/'.$class_name.'.module.php')){
            if(!class_exists('Core', false)){
                include_once('core/Core.module.php');
            }
        } else {
            
            // Sinon on cherche le modèle du Core concerné
            if(file_exists('core/models/'.$class_name.'.model.php')){
                include_once('core/models/'.$class_name.'.model.php');
            } else {
                throw new Exception\ModelNotExists('Le modèle '.$class_name.' n\'existe pas !');
            }
        }
    }
}

/**
 * Enregistrement de la fonction d'autoload
 */
spl_autoload_register('autoload');

?>
