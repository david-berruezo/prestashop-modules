<?php
require_once(dirname(__FILE__)."/classes/Listlinks.php");

class Myadminlink extends Module{
	
	public function __construct()
	{
		$this->name = 'myadminlink';
		$this->tab = 'front_office_features';
		$this->version = '0.4';
		$this->author = 'David Berruezo';
		$this->bootstrap = true;
		parent::__construct();
		$this->displayName = "myadminlink es sistema de menus";
		$this->description = "myadminlink es sistema de menus";
    }
    

    public function install()
	{
		// Call install parent method
		if (!parent::install())
			return false;

		// Install admin tab
		if (!$this->installTab('AdminCatalog', 'AdminMyadminlink', 'myadminlink'))
			return false;
        
        // All went well!
		return true;
    }
    
    public function uninstall()
	{
		// Call uninstall parent method
		if (!parent::uninstall())
			return false;

		// Uninstall admin tab
		if (!$this->uninstallTab('AdminMyadminlink'))
			return false;

		// All went well!
		return true;
	}

    public function installTab($parent, $class_name, $name)
	{
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
		echo "Bienvenido al mundo Ofiprix";
		//$link->getModuleLink('mymodcomments', 'comments',$params);
	}
} 
?>