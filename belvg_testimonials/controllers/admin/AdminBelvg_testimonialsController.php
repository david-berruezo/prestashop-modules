<?php
class AdminBelvg_testimonialsController extends ModuleAdminController
{
	public function __construct()
	{
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
			'legend' => array('title' => $this->l('Add / Edit Comment'), 'image' => '../img/admin/contact.gif'),
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
}