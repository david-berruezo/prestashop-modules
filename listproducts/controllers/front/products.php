<?php
class ListproductsProductsModuleFrontController extends ModuleFrontController{
    public function __construct(){
        parent::__construct();
        //echo "Hola prestashop";    
    }

    public function init(){
        parent::init();
        //echo "set media";
    }

    public function setMedia(){
        parent::setMedia();
        //echo "set media";
    }

    public function initContent(){
        echo "Hola que tal get";
    }

    public function postProcess(){
        echo "Hola que tal post";    
    }

}
?>