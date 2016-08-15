<?php
namespace Exception;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Classe mère de toutes les exceptions du framework
 */
class EurekaException extends \Exception{
    
    protected $visitor_message = NULL;
    protected $developer_message = NULL;

    /**
     * Constructeur de la classe EurekaException
     */
    public function __construct($code = 404){
        if(\Config::getInstance()->get('debug'))
            $message = $this->developer_message;
        else
            $message = $this->visitor_message;
        parent::__construct($message, $code);
    }
}
?>