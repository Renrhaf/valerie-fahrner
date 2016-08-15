<?php
namespace Core;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Objet définissant la page d'accueil d'un site
 * \author renrhaf
 */
class Index extends \Model{

    public function __construct(){
        parent::__construct();
    }
    
    public function show(){
        $page = new Page(Array('page_id' => 1));
        $data = $page->show();
        $this->set_template($page->get_template());
        return $data;
    }
}
?>
