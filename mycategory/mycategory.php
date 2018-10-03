<?php
require_once(dirname(__FILE__)."/classes/Familia.php");

class Mycategory extends Module{
    // var
    private $name_var    = "";
    private $surname_var = "";
    private $age_var     = "";
    private $familia_var = "";

    public function __construct(){
        $this->name      = 'mycategory';
        $this->tab       = "front_office_features";
        $this->version   = "0.1";
        $this->author    = "David";
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.5', 'max' => '1.7');
        $this->bootstrap = true;
        $this->displayName = 'My Module of product list';
	    $this->description = 'With this module, you can list your products';  
        parent::__construct(); 
    }

    public function install(){
        parent::install();
        $this->instalarHook();
        return true;    
    }

    public function instalarHook(){
        $check = Db::getInstance()->getRow('
			SELECT name
			FROM '._DB_PREFIX_.'hook
			WHERE name = "mycategory"
			');

        if (!$check) {
            $query = "INSERT INTO "._DB_PREFIX_."hook (`id_hook`, `name`, `title`, `description`, `position`, `live_edit`) VALUES (null,'mycategory', 'Mycategory', 'Hooks before the product list in a category',1,1);";
            if(Db::getInstance()->Execute($query))
                return true;
            else
                return false;
        } else {
            return true;
        } 
    }

    public function uninstall(){
        if (!parent::uninstall())
            return false;
        // All went well!
		return true;    
    }

    public function getContent(){
        $html = "";
        $html.= "<div class='row'>";
        $html.= "<div class='col-md-6'>";
        $html.= "<form action '".$_SERVER['REQUEST_URI']."' method='post' name='form1'>";
        $html.= "<div class='panel'><div class='panel-heading'>".$this->displayName."</div></div>";
        $html.= "<div class='form-group'>";
        $html.= "<label for=''>Nombre:</label>";
        $html.= "<br>";
        $html.= "<input type='text' name='nombre' id='nombre'>";
        $html.= "<label for=''>Apellidos:</label>";
        $html.= "<br>";
        $html.= "<input type='text' name='apellidos' id='apellidos'>";
        $html.= "<label for=''>Edad:</label>";
        $html.= "<br>";
        $html.= "<input type='text' name='edad' id='edad'>";
        $html.= "<br>";
        $html.= "<input type='submit' value='Guardar' id='guardar' name='guardar'>";
        $html.= "</div>";
        $html.= "</form>";
        $html.= "</div>";
        $html.= "</div>";
        // Call to function to manage post form
        $this->postProcess();
        return $html;
    }

    public function postProcess(){
        if (Tools::isSubmit("guardar")){
            $this->name_var    = Tools::getValue('nombre');
            $this->surname_var = Tools::getValue('apellidos');
            $this->age_var     = Tools::getValue('edad');
            // Call to functions
            // $this->insertarDatos();
            // $this->addDatos();
            // $this->saveDatos();
            $this->updateDatos();
        }else{
            $this->getDatos();
        }
    }

    /*
     *  add data
     */ 

    public function insertarDatos(){
        $id_shop = (int)Context::getContext()->shop->id;
        $id_product = 0;
        $fecha = date('Y-m-d H:i:s');
        $query = "INSERT INTO "._DB_PREFIX_."familia (`id_familia`, `id_shop`, `id_product`, `firstname`, `lastname`, `age`, `date_add`) VALUES (null,'".$id_shop."', '".$id_product."','".$this->name_var."','".$this->surname_var."','".$this->age_var."','".$fecha."');";
            if(Db::getInstance()->Execute($query))
                return true;
            else
                return false; 
    }

    public function addDatos(){
        $id_shop = (int)Context::getContext()->shop->id;
        $id_product = 1;
        $fecha = date('Y-m-d H:i:s');
        
        $this->familia_var = new Familia();
        $this->familia_var->setId_familia(null);
        $this->familia_var->id_shop = (int)$this->context->shop->id;
        $this->familia_var->id_product = $id_product;
        //$this->familia_var->setId_shop_var($id_shop);
        $this->familia_var->setId_product_var($id_product);
		$this->familia_var->setFirstname($this->name_var);
		$this->familia_var->setLastname($this->surname_var);
		$this->familia_var->setAge($this->age_var);
        //$this->familia_var->setDate_add($fecha);
        $this->familia_var->add();
    }

    public function saveDatos(){
        $id_shop = (int)Context::getContext()->shop->id;
        $id_product = 1;
        $fecha = date('Y-m-d H:i:s');
        $this->familia_var = new Familia();
        $this->familia_var->setId_familia(null);
        $this->familia_var->id_shop = (int)$this->context->shop->id;
        $this->familia_var->id_product = $id_product;
        //$this->familia_var->setId_shop_var($id_shop);
        $this->familia_var->setId_product_var($id_product);
		$this->familia_var->setFirstname($this->name_var);
		$this->familia_var->setLastname($this->surname_var);
		$this->familia_var->setAge($this->age_var);
        //$this->familia_var->setDate_add($fecha);
        $this->familia_var->save();
    }

    /*
     * Udate data
     */ 

    public function updateDatos(){
        $this->familia_var = new Familia(6);
        $id_shop = (int)Context::getContext()->shop->id;
        $id_product = 1;
        $fecha = date('Y-m-d H:i:s');
        $this->familia_var->id_familia = 6;
        $this->familia_var->id_shop = (int)$this->context->shop->id;
        $this->familia_var->id_product = $id_product;
        //$this->familia_var->setId_shop_var($id_shop);
        $this->familia_var->setId_product_var($id_product);
		$this->familia_var->setFirstname($this->name_var);
		$this->familia_var->setLastname($this->surname_var);
		$this->familia_var->setAge($this->age_var);
        //$this->familia_var->setDate_add($fecha);
        $this->familia_var->update();
    }

    public function getDatos(){
        echo "Esta tarde";
        $query = 'SELECT * FROM '._DB_PREFIX_.'familia';
        $results = Db::getInstance()->Execute($query);
        print_r($results);
        /*
        if ($results){
            foreach ($results as $row)
                echo $row['id_familia'].' :: '.$row['firstname'].'<br />';    
        }
        */
    }
}
?>