<?php
namespace Exception;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Exception lancée lorsqu'un module demandé n'existe pas
 * \author renrhaf
 */
class ModuleNotExists extends EurekaException{

    /**
     * Constructeur de la classe ModuleNotExists
     */
    public function __construct($message,$code = 0){
        $this->developer_message = $message;
        parent::__construct(404);
    }
}
?>