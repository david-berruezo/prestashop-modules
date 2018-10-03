<?php
require_once(dirname(__FILE__).'/classes/Listproducts.php');

class Listproducts extends Module{
    public function __construct(){
        $this->name      = 'listproducts';
        $this->tab       = "front_office_features";
        $this->version   = "0.1";
        $this->author    = "David Berruezo";
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.5', 'max' => '1.7');
        $this->bootstrap = true;
        parent::__construct(); 
        $this->displayName = $this->l('My Module of product list');
	    $this->description = $this->l('With this module, you can list your products');  
    }
    public function install(){
        // actionProductUpdate && displayAdminProduct extra es para los tabs
        // del admin panel que vayan al modulo preciso
        return parent::install() && 
        $this->registerHook("displayTop") && 
        $this->registerHook('displayProductTabContent') && 
        $this->registerHook('displayProductTab') &&
        $this->registerHook('displayNav') &&
        $this->registerHook('displayAdminProductExtra') && 
        $this->registerHook('actionProductUpdate') &&
        $this->registerHook('leftColumn') && 
        $this->registerHook('rightColumn');
        $this->installTab('AdminCatalog', 'AdminListproducts', 'listproducts');
        Configuration::updateValue('LISTPRODUCTS', "listproducts");
        return true;    
    }
    public function uninstall(){
        if (!parent::uninstall())
            return false;
        // All went well!
		return true;    
    }

    public function installTab($parent, $class_name, $name)
	{
        $tab = new Tab();
        // Define the title of your tab that will be displayed in BO
        $tab->name[$this->context->language->id] = $name; 
        // Name of your admin controller 
        $tab->class_name = $class_name;
        // Id of the controller where the tab will be attached
        // If you want to attach it to the root, it will be id 0 (I'll explain it below)
        $tab->id_parent = (int) Tab::getIdFromClassName($parent);
        // Name of your module, if you're not working in a module, just ignore it, it will be set to null in DB
        $tab->module = $this->name;
        // Other field like the position will be set to the last, if you want to put it to the top you'll have to modify the position fields directly in your DB
        return $tab->add();
        
        /*
        // Create new admin tab
		$tab = new Tab();
		$tab->id_parent = (int)Tab::getIdFromClassName($parent);
		$tab->name = array();
		foreach (Language::getLanguages(true) as $lang)
			$tab->name[$lang['id_lang']] = $name;
		$tab->class_name = $class_name;
		$tab->module = $this->name;
		$tab->active = 1;
        return $tab->add();
        */

        /*
        $langs = Language::getLanguages();
        $id_lang = (int)Configuration::get('PS_LANG_DEFAULT');
        $ndiaga_tab = new Tab();
        $ndiaga_tab->class_name = 'AdminListproducts';
        $ndiaga_tab->module = 'listproducts';
        $ndiaga_tab->id_parent = 0;
        foreach($langs as $l){
            $ndiaga_tab->name[$l['id_lang']] = 'listproducts';
        }
        $ndiaga_tab->save();
        $tab_id = $ndiaga_tab->id;
        //@copy(dirname(__FILE__).'/AdminHomeSlider.gif',_PS_ROOT_DIR_.'/img/t/AdminHomeSlider.gif'); 
        //Configuration::updateValue('HOME_SLIDER_TAB_ID',$tab_id);             
        return true;
        */
    }

    public function uninstallTab($class_name)
	{
		// Retrieve Tab ID
		$id_tab = (int)Tab::getIdFromClassName($class_name);
		// Load tab
		$tab = new Tab((int)$id_tab);
		// Delete it
		return $tab->delete();
	}

    public function getContent(){
        return "David escribiendo un modulo";
    }

    /*
     * Hook Display 
     */

    public function getHookController($hookName){
        require_once(dirname(__FILE__). '/controllers/hook/'. $hookName. '.php');
        $controllerName = ucfirst($this->name).ucfirst($hookName).'Controller';
        //ListproductsDisplayProductTabContentController
        //echo "El controller name es: ".$controllerName."<br>"; 
        $controller = new $controllerName($this,__FILE__,$this->_path);
        return $controller;
    }


    public function hookDisplayTop($params){
          //echo "Hola top<br>";  
    }

    public function hookDisplayProductTabContent($params){
        //echo "Hola Product tab content<br>";
        $controller = $this->getHookController('displayProductTabContent');
        return $controller->run($params);
    }

    public function hookDisplayAdminProductsExtra($params)
	{
		$controller = $this->getHookController('displayAdminProductsExtra');
        return $controller->run();
        
        /*
        $id_product = Tools::getValue('id_product');
        $sampleObj = Belvg_Sample::loadByIdProduct($id_product);
        if(!empty($sampleObj) && isset($sampleObj->id)){
            $this->context->smarty->assign(array(
                'belvg_textarea' => $sampleObj->textarea,
            ));
        }
 
        return $this->display(__FILE__, 'views/admin/sample.tpl');
        */

	}

    public function hookDisplayProductTab($params){
          //echo "Hola Product tab<br>";  
    }


    public function hookDisplayNav($params){
        //echo "Hola Display nav<br>";
    }    

    public function hookDisplayLeftColumn($params){
        echo "Hola Left column<br>";
    }

    public function hookDisplayRightColumn($params){
        echo "Hola Right column<br>";
    }
}
?>