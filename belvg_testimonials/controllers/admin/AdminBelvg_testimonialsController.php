<?php
class AdminBelvg_testimonialsController extends ModuleAdminController
{
	public function __construct()
	{
		// Important variables table,classname, field_list
		// Set variables
		$this->table = 'belvg_testimonials';
		$this->className = 'Belvg_testimonials';
		$this->fields_list = array(
			'id_belvg_testimonials' => array('title' => 'ID', 'align' => 'center', 'width' => 25),
			'name' => array('title' => 'Nombre', 'width' => 150),
			'email' => array('title' => 'Email', 'width' => 150),
			'site' => array('title' => 'Site', 'width' => 150),
			'status' => array('title' => 'Status', 'width' => 150),
			'date_add' => array('title' => 'Date add', 'width' => 100, 'type' => 'date'),
			'date_upd' => array('title' => 'Date upd', 'align' => 'right', 'width' => 80, 'type' => 'date'),
	    );

		$this->fields_form = array(
			'legend' => array('title' => 'Add / Edit Comment', 'image' => '../img/admin/contact.gif'),
			'input' => array(
				array('type' => 'text', 'label' => 'Name', 'name' => 'name', 'size' => 150, 'required' => true),
				array('type' => 'text', 'label' => 'Email', 'name' => 'email', 'size' => 150, 'required' => true),
				array('type' => 'text', 'label' => 'Site', 'name' => 'site', 'size' => 150, 'required' => true),
				array('type' => 'text', 'label' => 'Status', 'name' => 'status', 'size' => 150,'required' => true),
			),
			'submit' => array('title' => 'Guardar')
		);

        $this->context = Context::getContext();
		$this->context->controller = $this;

        // Enable bootstrap
		$this->bootstrap = true;

		// Call of the parent constructor method
		parent::__construct();
		
		// Add actions
		$this->addRowAction('view');
		$this->addRowAction('delete');
		$this->addRowAction('edit');

	}
	
	public function renderView()
	{
		/*
		// Build delete link
		$admin_delete_link = $this->context->link->getAdminLink('AdminBelvg_testimonials').'&deletebelvg_testimonials&id_belvg_testimonials='.(int)$this->object->id;

		// Build admin product link
		$admin_product_link = $this->context->link->getAdminLink('AdminProducts').'&updateproduct&id_product='.(int)$this->object->id_product.'&key_tab=ModuleBelvg_testimonials';

		// If author is known as a customer, build admin customer link
		$admin_customer_link = '';
		$customers = Customer::getCustomersByEmail($this->object->email);
		if (isset($customers[0]['id_customer']))
			$admin_customer_link = $this->context->link->getAdminLink('AdminCustomers').'&viewcustomer&id_customer='.(int)$customers[0]['id_customer'];

		// Add delete shortcut button to toolbar
		$this->page_header_toolbar_btn['delete'] = array(
			'href' => $admin_delete_link,
			'desc' => $this->l('Delete it'),
			'icon' => 'process-icon-delete',
			'js' => "return confirm('".$this->l('Are you sure you want to delete it ?')."');",
		);

		$this->object->loadProductName();

		*/

		
		$belvg = new Belvg($this->object->id);
		
		$tpl = $this->context->smarty->createTemplate(dirname(__FILE__). '/../../views/templates/admin/view.tpl');
		$tpl->assign('objeto', $belvg);

		/*
		$tpl->assign('mymodcomment', $this->object);
		$tpl->assign('admin_product_link', $admin_product_link);
		$tpl->assign('admin_customer_link', $admin_customer_link);
		*/

		return $tpl->fetch();
	}

	public function renderForm(){
		$belvg = new Belvg($this->object->id);
		
		$tpl = $this->context->smarty->createTemplate(dirname(__FILE__). '/../../views/templates/admin/edit.tpl');
		$tpl->assign('objeto', $belvg);
		return $tpl->fetch();
	}

}