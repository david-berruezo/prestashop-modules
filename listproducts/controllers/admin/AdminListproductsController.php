<?php 
class AdminListproductsController extends ModuleAdminController{
    public function __construct(){
        // set variables
        $this->table       = 'list_products';
        $this->className   = 'Listproducts';
        $this->fields_list = array(
            'id_listproducts' => array('title' => 'ID', 'align' => 'center', 'width' => 25),
			'shop_name' => array('title' => 'Tienda', 'width' => 120, 'filter_key' => 's!name'),
			'firstname' => array('title' => 'Firstname', 'width' => 120),
			'lastname' => array('title' => 'Lastname', 'width' => 140),
			'email' => array('title' => 'E-mail', 'width' => 150),
			'product_name' => array('title' => 'Product', 'width' => 100, 'filter_key' => 'pl!name'),
			'grade_display' => array('title' => 'Grade', 'align' => 'right', 'width' => 80, 'filter_key' => 'a!grade'),
			'comment' => array('title' => 'Comment', 'search' => false),
			'date_add' => array('title' => 'Date add', 'type' => 'date'),
        ); 
        
        // Set fields form for form view
		$this->context = Context::getContext();
        $this->context->controller = $this;

        $this->fields_form = array(
			'legend' => array('title' => 'Add / Edit Comment', 'image' => '../img/admin/contact.gif'),
			'input' => array(
				array('type' => 'text', 'label' => 'Firstname', 'name' => 'firstname', 'size' => 30, 'required' => true),
				array('type' => 'text', 'label' => 'Lastname', 'name' => 'lastname', 'size' => 30, 'required' => true),
				array('type' => 'text', 'label' => 'E-mail', 'name' => 'email', 'size' => 30, 'required' => true),
				array('type' => 'select', 'label' => 'Product', 'name' => 'id_product', 'required' => true, 'default_value' => 1, 'options' => array('query' => Product::getProducts($this->context->cookie->id_lang, 1, 1000, 'name', 'ASC'), 'id' => 'id_product', 'name' => 'name')),
				array('type' => 'text', 'label' => 'Grade', 'name' => 'grade', 'size' => 30, 'required' => true, 'desc' => 'Grade must be between 1 and 5'),
				array('type' => 'textarea', 'label' => 'Comment', 'name' => 'comment', 'cols' => 50, 'rows' => 5, 'required' => false),
			),
			'submit' => array('title' => 'Save')
        );
        
        // Enable bootstrap
        $this->bootstrap = true;

        // Call of the parent constructor method
        parent::__construct();

        // Add actions
		$this->addRowAction('view');
		$this->addRowAction('delete');
		$this->addRowAction('edit');

    }

	public function init() {
		$tab = new Tab();
		$tab->name[$this->context->language->id] = "My Group of tabs";
		$tab->class_name = "AdminListproducts";
		// This time we set the id to 0, which is the root
		$tab->id_parent = 0;
		$tab->add();
   }

    public function render_view(){
       	$tpl = $this->context->smarty->createTemplate(dirname(__FILE__). '/../../views/templates/admin/view.tpl');
		$tpl->assign('mymodcomment', $this->object);
	    return $tpl->fetch();
    }

}
/*
id_listproducts int(11) AI PK 
id_shop int(11) 
id_product int(11) 
firstname varchar(255) 
lastname varchar(255) 
email varchar(255) 
grade tinyint(1) 
comment text 
date_add datetime
*/
?>