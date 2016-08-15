<?php
namespace Exception;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Exception lancée lorsque la connection à la base de données échoue
 * \author renrhaf
 */
class DBConnectFailed extends EurekaException{

    /**
     * Constructeur de la classe DBConnectFailed
     */
    public function __construct($message){
        $this->developer_message = 'Impossible d\'établir la connexion avec la base de données : '.$message;
        $this->visitor_message = 'Impossible d\'établir la connexion avec la base de données, nous faisons notre possible pour la rétablir.<br/> Vous pouvez repasser plus tard pour voir si le site est à nouveau opérationnel, merci de votre patience et de votre compréhension.';
        parent::__construct(500);
    }
}
?>