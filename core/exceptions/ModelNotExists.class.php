<?php
namespace Exception;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Exception lancée lorsqu'un modèle demandé n'existe pas
 * \author renrhaf
 */
class ModelNotExists extends EurekaException{

    /**
     * Constructeur de la classe ModelNotExists
     */
    public function __construct($message){
        $this->developer_message = $message.'<br/> Peu-être vous êtes vous trompé de module ?<br/> N\'oubliez pas lors de la création d\'un objet de spécifier new Module\Model();';
        parent::__construct(404);
    }
}
?>