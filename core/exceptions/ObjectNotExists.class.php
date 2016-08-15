<?php
namespace Exception;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Exception lancée lorsqu'un objet n'existe pas en base de données
 * Egalement lancée si une page demandée n'existe pas
 * \author renrhaf
 */
class ObjectNotExists extends EurekaException{

    /**
     * Constructeur de la classe ObjectNotExists
     */
    public function __construct(\Table $object_table, $code = 0){
        $message = 'Il n\'existe aucun(e) '.$object_table->get_display_name().' en base de données qui réponde au(x) critère(s) :<br/><span style="margin:20px;">';
        foreach($object_table->get_fields() as $field){
            if($field->has_been_set()){
                $message .= $field->get_name().' => '.$field->get_value().' <br/>';
            }
        }
        $message .= '</span>';
        $this->developer_message = $message;
        parent::__construct(404);
    }
}
?>