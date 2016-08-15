<?php
namespace Exception;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Exception lancée lorsqu'une action demandée n'est pas autorisée avec un modèle
 */
class ActionNotAllowed extends EurekaException{

    /**
     * Constructeur de la classe ActionNotAllowed
     * @param Action $action l'action en question
     * @param Model $model le modèle en question
     */
    public function __construct(\Action\Action $action, \Model $model){
        $message = 'L\'action '.get_class($action).' n\'est pas autorisée sur le modèle '.get_class($model).'<br/>';
        $message .= 'Pour autoriser cette action sur ce modèle, vous devez implanter la méthode '.$action->get_method_name().' dans le modèle '.get_class($model).'<br/>';
        $message .= 'Si vous souhaitez interdire une certaine action sur un modèle de type ObjectModel, si la méthode correspondant à cette action est implantée par défault dans ObjectModel, vous devrez la surcharger dans le modèle fils et lancer une exception de type ActionNotAllowed.';
        $this->developer_message = $message;
        parent::__construct(401);
    }
}
?>