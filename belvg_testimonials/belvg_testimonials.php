<?php
require_once(dirname(__FILE__)."/classes/Belvg.php");

class Belvg_testimonials extends Module{
    // var option 
    public $option                 = 0;
    // var class
    public $belvg                  = "";
    public $id_belvg_testimonials  = "";
    public $id_product             = "";
    public $name                   = "";
    public $email                  = "";
    public $site                   = "";
    public $status                 = "";
    public $date_add               = "";
    public $date_upd               = "";

    public function __construct(){
        $this->name      = 'belvg_testimonials';
        $this->tab       = "front_office_features";
        $this->version   = "0.1";
        $this->author    = "David";
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.5', 'max' => '1.7');
        $this->bootstrap = true;
        $this->displayName = 'My Module of belvg_testimonials';
	    $this->description = 'With this module, you can belvg_testimonials';  
        parent::__construct(); 
    }

    public function install(){
        parent::install();
        // Install admin tab
		if (!$this->installTab('AdminCatalog', 'AdminBelvg_testimonials', 'testimonials'))
        return false;
        $this->instalarHook();
        return true;    
    }

    public function uninstall(){
        if (!parent::uninstall())
            return false;
        // All went well!
		return true;    
    }

    public function instalarHook(){
        // Register hooks
        $this->registerHook('displayBackOfficeHeader');
    }

    public function getHookController($hook_name)
	{	
		// Include the controller file
		require_once(dirname(__FILE__).'/controllers/hook/'. $hook_name.'.php');
		// Build dynamically the controller name
		$controller_name = $this->name.$hook_name.'Controller';
		// Instantiate controller
		$controller = new $controller_name($this, __FILE__, $this->_path);
		// Return the controller
		return $controller;
	}

    public function hookDisplayBackOfficeHeader($params)
	{
		$controller = $this->getHookController('displayBackOfficeHeader');
        $controller->add_css_js();
        return $controller->run($params);
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
        $html = "";
        if (Tools::isSubmit("opcion_boton")){
            $opcion = Tools::getValue("opciones");
            switch ($opcion){
                case 1:$html = $this->crear_formulario(1);
                break;
                case 2:$html = $this->crear_formulario(2);
                break;
                case 3:$html = $this->crear_formulario(3);
                break;    
                case 4:$html = $this->get_all_records();
                break;    
                case 5:$html = $this->get_all_records();
                break;   
            }
            return $html;
        }else if(Tools::isSubmit("insertar")){
            $opcion = Tools::getValue("opcion");
            switch ($opcion){
                case 1:$this->insertar_formulario(1);
                break;
                case 2:$this->insertar_formulario(2);
                break;
                case 3:$this->insertar_formulario(3);
                break;    
            }
        }else if(Tools::isSubmit("ver")){
            $id        = Tools::getValue("seleccionado");    
            $operacion = Tools::getValue("operacion");
            if ($operacion == "editar"){
                $html = $this->ver_formulario($id);
            }else if($operacion == "editar_dos"){
                $html = $this->ver_formulario_dos($id);    
            }else if($operacion == "eliminar"){
                $html = $this->eliminar_formulario($id);
            }else if($operacion == "eliminar_dos"){
                $html = $this->eliminar_dos_formulario($id);
            }
            return $html;   
        }else if(Tools::isSubmit("ver_guardar")){
            $html = $this->guardar_formulario();
            return $html;  
        }else if(Tools::isSubmit("ver_guardar_dos")){
            $html = $this->guardar_formulario_dos();
            return $html;
        }else{
            $html = "";
            $html.= "<div class='row'>";
            $html.= "<div class='col-md-6'>";
            $html.= "<div class='panel'><div class='panel-heading'>Selecciona una opcion</div></div>";
            $html.= "<div class='form-group'>";
            $html.= "<form action '".$_SERVER['REQUEST_URI']."' method='post' name='form1'>";                
            $html.= "<select name='opciones' id='opciones'>";
            $html.= "<option value='1'>Insertar datos mediante sql</option>";
            $html.= "<option value='2'>Insertar datos mediante metodo add</option>";
            $html.= "<option value='3'>Insertar datos mediante metodo save</option>";
            $html.= "<option value='4'>Actualizar datos mediante sql</option>";
            $html.= "<option value='5'>Actualizar datos mediante metodo update</option>";
            $html.= "<option value='6'>Ver datos mediante select en la tabla del modulo</option>";
            $html.= "</select>";
            $html.= "<input type='submit' value='Guardar' id='opcion_boton' name='opcion_boton'>";
            $html.= "</form>";
            $html.= "</div>";
            $html.= "</div>";
            $html.= "</div>";
            return $html;    
        }
    }

    public function crear_formulario($opcion){
        $html = "";
        $html.= "<div class='row'>";
        $html.= "<div class='col-md-6'>";
        $html.= "<form action '".$_SERVER['REQUEST_URI']."' method='post' name='form1'>";
        $html.= "<div class='panel'><div class='panel-heading'>".$this->displayName."</div></div>";
        $html.= "<div class='form-group'>";
        $html.= "<label for=''>Nombre:</label>";
        $html.= "<br>";
        $html.= "<input type='text' name='nombre' id='nombre'>";
        $html.= "<label for=''>Email:</label>";
        $html.= "<br>";
        $html.= "<input type='text' name='email' id='email'>";
        $html.= "<label for=''>Site:</label>";
        $html.= "<br>";
        $html.= "<input type='text' name='site' id='site'>";
        $html.= "<br>";
        $html.= "<input type='hidden' value='".$opcion."' id='opcion' name='opcion'>";
        $html.= "<input type='submit' value='Guardar' id='insertar' name='insertar'>";
        $html.= "</div>";
        $html.= "</form>";
        $html.= "</div>";
        $html.= "</div>";
        return $html;
        
        /*
        'table' => 'belvg_testimonials', 'primary' => 'id_belvg_testimonials', 'multilang' => true,
            'fields' => array(
                'id_shop' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
                'id_product' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
                'name' => array('type' => self::TYPE_STRING, 'validate' => 'isName', 'size' => 20),
                'email' => array('type' => self::TYPE_STRING, 'validate' => 'isName', 'size' => 20),
                'site' => array('type' => self::TYPE_STRING, 'validate' => 'isName', 'size' => 20), 
                'status' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
                'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate', 'copy_post' => false),
                'date_upd' => array('type' => self::TYPE_DATE, 'validate' => 'isDate', 'copy_post' => false),  
            ),
        */
    }

    public function insertar_formulario($opcion){
        switch($opcion){
             case 1:$this->insertarDatos();
             break;
             case 2:$this->addDatos();
             break;
             case 3:$this->saveDatos();
             break;
        }
    }

    /*
     *  add data
     */ 

    public function insertarDatos(){
        $id_shop    = (int)Context::getContext()->shop->id;
        $id_product = 1;
        $fecha_add  = date('Y-m-d H:i:s');
        $fecha_upd  = date('Y-m-d H:i:s');
        $name       = Tools::getValue("nombre");
        $email      = Tools::getValue("email");
        $site       = Tools::getValue("site");
        $status     = 1;

        $query = "INSERT INTO "._DB_PREFIX_."belvg_testimonials (`id_belvg_testimonials`, `name`, `email`, `site`, `status`, `date_add` , `date_upd`) VALUES (null,'".$name."','".$email."','".$site."','".$status."','".$fecha_add."','".$fecha_upd."');";
            if(Db::getInstance()->Execute($query))
                return true;
            else
                return false; 
    }

    public function addDatos(){
        $this->belvg             = new Belvg();
        //$this->belvg->id_shop    = (int)Context::getContext()->shop->id;
        //$this->belvg->id_product = 1;
        $this->belvg->fecha_add  = date('Y-m-d H:i:s');
        $this->belvg->fecha_upd  = date('Y-m-d H:i:s');
        $this->belvg->name       = Tools::getValue("nombre");
        $this->belvg->email      = Tools::getValue("email");
        $this->belvg->site       = Tools::getValue("site");
        $this->belvg->status     = 1;
        $this->belvg->add();
    }


    public function saveDatos(){
        $this->belvg             = new Belvg();
        //$this->belvg->id_shop    = (int)Context::getContext()->shop->id;
        //$this->belvg->id_product = 1;
        $this->belvg->fecha_add  = date('Y-m-d H:i:s');
        $this->belvg->fecha_upd  = date('Y-m-d H:i:s');
        $this->belvg->name       = Tools::getValue("nombre");
        $this->belvg->email      = Tools::getValue("email");
        $this->belvg->site       = Tools::getValue("site");
        $this->belvg->status     = 1;
        $this->belvg->save();
    }

    /*
     *  select data
     */
    public function get_all_records(){
        $query = 'SELECT * FROM '._DB_PREFIX_.'belvg_testimonials';
        $results = Db::getInstance()->ExecuteS($query);
        if ($results){
            $html = "<form action '".$_SERVER['REQUEST_URI']."' method='post' name='form1'>";
            $html.= "<table class='table'>";
                $html.= "<caption>List</caption>";
                $html.= "<thead>";
                    $html.= "<tr>";
                    $html.= "<th scope='col'>#</th>";
                    $html.= "<th scope='col'>Name</th>";
                    $html.= "<th scope='col'>Email</th>";
                    $html.= "<th scope='col'>Site</th>";
                    $html.= "<th scope='col'>Status</th>";
                    $html.= "<th scope='col'>Date add</th>";
                    $html.= "<th scope='col'>Date upd</th>";
                    $html.= "<th scope='col'>Editar Sql</th>";
                    $html.= "<th scope='col'>Editar Metodo Update</th>";
                    $html.= "<th scope='col'>Borrar sql</th>";
                    $html.= "<th scope='col'>Borrar Metodo Delete</th>";
                    $html.= "</tr>";
                $html.= "</thead>";  
                $html.= "<tbody>"; 
                foreach($results as $row){
                    $html.= "<tr>";    
                        $html.= "<th scope='row'>".$row['id_belvg_testimonials']."</th>";
                        $html.= "<th scope='row'>".$row['name']."</th>";
                        $html.= "<th scope='row'>".$row['email']."</th>";
                        $html.= "<th scope='row'>".$row['site']."</th>";
                        $html.= "<th scope='row'>".$row['status']."</th>";
                        $html.= "<th scope='row'>".$row['date_add']."</th>";
                        $html.= "<th scope='row'>".$row['date_upd']."</th>";
                        $html.= "<th class='seleccionar' data-id='".$row['id_belvg_testimonials']."' scope='row'>ver</th>";
                        $html.= "<th class='seleccionar_dos' data-id='".$row['id_belvg_testimonials']."' scope='row'>ver update</th>";
                        $html.= "<th class='seleccionar_borrar' data-id='".$row['id_belvg_testimonials']."' scope='row'>borrar sql</th>";
                        $html.= "<th class='seleccionar_borrar_dos' data-id='".$row['id_belvg_testimonials']."' scope='row'>borrar metodo delete</th>";
                    $html.= "</tr>";
                }
                $html.= "</tbody>";
            $html.= "</table>";
            $html.= "<input type='hidden' value='0' id='seleccionado' name='seleccionado'>";
            $html.= "<input type='hidden' value='editar' id='operacion' name='operacion'>";
            $html.= "<input type='submit' value='Guardar' id='ver' name='ver'>";
            $html.= "</form>";
            return $html;
        }
    }


    public function ver_formulario($id){
        
        $sql = 'SELECT * FROM '._DB_PREFIX_.'belvg_testimonials WHERE id_belvg_testimonials = '.$id;
        $results = Db::getInstance()->ExecuteS($sql);
        if ($results){
            $html = "<form action '".$_SERVER['REQUEST_URI']."' method='post' name='form1'>";
            $html.= "<table class='table'>";
                $html.= "<caption>List</caption>";
                $html.= "<thead>";
                    $html.= "<tr>";
                    $html.= "<th scope='col'>#</th>";
                    $html.= "<th scope='col'>Name</th>";
                    $html.= "<th scope='col'>Email</th>";
                    $html.= "<th scope='col'>Site</th>";
                    $html.= "<th scope='col'>Status</th>";
                    $html.= "</tr>";
                $html.= "</thead>";  
                $html.= "<tbody>"; 
                foreach($results as $row){
                    $html.= "<tr>";    
                        $html.= "<th scope='row'>".$row['id_belvg_testimonials']."</th>";
                        $html.= "<th scope='row'><input name='name' id='name' type='text' value='".$row['name']."'></th>";
                        $html.= "<th scope='row'><input name='email' id='email' type='text' value='".$row['email']."'></th>";
                        $html.= "<th scope='row'><input name='site' id='site' type='text' value='".$row['site']."'></th>";
                        $html.= "<th scope='row'><input name='status' id='status' type='text' value='".$row['status']."'></th>";
                        $html.= "<input type='hidden' value=".$row['id_belvg_testimonials']." id='seleccionado' name='seleccionado'>";    
                        $html.= "</tr>";
                }
                $html.= "</tbody>";
            $html.= "</table>";
            $html.= "<input type='submit' value='Guardar' id='ver_guardar' name='ver_guardar'>";
            $html.= "</form>";
            return $html;
        }    
    }

    public function ver_formulario_dos($id){
        $sql = 'SELECT * FROM '._DB_PREFIX_.'belvg_testimonials WHERE id_belvg_testimonials = '.$id;
        $results = Db::getInstance()->ExecuteS($sql);
        if ($results){
            $html = "<form action '".$_SERVER['REQUEST_URI']."' method='post' name='form1'>";
            $html.= "<table class='table'>";
                $html.= "<caption>List</caption>";
                $html.= "<thead>";
                    $html.= "<tr>";
                    $html.= "<th scope='col'>#</th>";
                    $html.= "<th scope='col'>Name</th>";
                    $html.= "<th scope='col'>Email</th>";
                    $html.= "<th scope='col'>Site</th>";
                    $html.= "<th scope='col'>Status</th>";
                    $html.= "</tr>";
                $html.= "</thead>";  
                $html.= "<tbody>"; 
                foreach($results as $row){
                    $html.= "<tr>";    
                        $html.= "<th scope='row'>".$row['id_belvg_testimonials']."</th>";
                        $html.= "<th scope='row'><input name='name' id='name' type='text' value='".$row['name']."'></th>";
                        $html.= "<th scope='row'><input name='email' id='email' type='text' value='".$row['email']."'></th>";
                        $html.= "<th scope='row'><input name='site' id='site' type='text' value='".$row['site']."'></th>";
                        $html.= "<th scope='row'><input name='status' id='status' type='text' value='".$row['status']."'></th>";
                        $html.= "<input type='hidden' value=".$row['id_belvg_testimonials']." id='seleccionado' name='seleccionado'>";    
                        $html.= "</tr>";
                }
                $html.= "</tbody>";
            $html.= "</table>";
            $html.= "<input type='submit' value='Guardar' id='ver_guardar_dos' name='ver_guardar_dos'>";
            $html.= "</form>";
            return $html;
        }    
    }

    public function eliminar_formulario($id){
        // codigo
        // DELETE FROM tutorials_tbl WHERE tutorial_id=3;   
        $query = "DELETE FROM "._DB_PREFIX_."belvg_testimonials where id_belvg_testimonials=".$id;
        if(Db::getInstance()->Execute($query))
                return true;
            else
                return false;
    }

    public function eliminar_dos_formulario($id){
        // codigo
        // DELETE FROM tutorials_tbl WHERE tutorial_id=3;   
        $belvg = new Belvg($id);
        $belvg->delete();
        return true;
    }    
        

    public function guardar_formulario(){
        $id      = Tools::getValue("seleccionado");
        $name    = Tools::getValue("name");
        $email   = Tools::getValue("email");
        $site    = Tools::getValue("site");
        $status  = Tools::getValue("status");

        $query = "UPDATE "._DB_PREFIX_."belvg_testimonials SET name='".$name."',email='".$email."',site='".$site."',status='".$status."' where id_belvg_testimonials=".$id;
        if(Db::getInstance()->Execute($query))
                return true;
            else
                return false;
    }

    public function guardar_formulario_dos(){
        $id      = Tools::getValue("seleccionado");
        $name    = Tools::getValue("name");
        $email   = Tools::getValue("email");
        $site    = Tools::getValue("site");
        $status  = Tools::getValue("status");

        $belvg         = new Belvg($id);
        $belvg->name   = $name;
        $belvg->email  = $email;
        $belvg->site   = $site;
        $belvg->status = $status;
        $belvg->update();
        return true;
        
    }
}
?>