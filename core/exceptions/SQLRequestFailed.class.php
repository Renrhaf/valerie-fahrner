<?php
namespace Exception;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Exception lancée lorsque la requête SQL échoue
 * \author renrhaf
 */
class SQLRequestFailed extends EurekaException{

    /**
     * Constructeur de la classe SQLRequestFailed
     */
    public function __construct($message){
        $this->developer_message = $message;
        $this->visitor_message = 'Une erreur technique est survenue lors de la recherche de données dans la base de données. Veuillez nous excuser pour la gène occasionnée.<br/>Vous pouvez retourner à la page précédente avec le bouton ci-contre.';
        parent::__construct(500);
    }
}
?>