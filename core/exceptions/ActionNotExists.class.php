<?php
namespace Exception;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Exception lancée lorsqu'une action demandée n'existe pas
 */
class ActionNotExists extends EurekaException{

    /**
     * Constructeur de la classe ActionNotExists
     * @param String $action_name le nom de l'action
     */
    public function __construct($action_name){
        $this->developer_message = 'L\'action '.$action_name.' n\'existe pas.';
        parent::__construct(404);
    }
}
?>