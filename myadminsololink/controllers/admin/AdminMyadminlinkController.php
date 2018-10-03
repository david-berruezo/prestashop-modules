<?php
class AdminMyadminsololinkController extends ModuleAdminController
{
    public function __construct(){
		// Variables minimas y cogemos los datos de la tabla de configuracion
		$this->bootstrap = true;
        $this->context = Context::getContext();
        $this->className = 'Configuration';
		$this->table = 'configuration';
		$this->context->controller = $this;

		// Prevent classes which extend AdminPreferences to load useless data
        if (get_class($this) == 'AdminMyadminlinkController') {

			/*	
			// define list columns
			$this->fields_list = array(
				'id_listproducts' => array(
					'title'    => 'ID',
					'align'    => 'center',
				) 
			);
		
			// Define fields for edit form
			$this->fields_form = array(
				'input' => array(
					array(
						'name'     => 'title',
						'type'     => 'text',
						'label'    => 'Title',
						'desc'     => 'Category title',
						'required' => true,
						'lang'     => true
					),
					'submit' => array(
					'title' => $this->l('Save'),
					),
				),	
			);
			*/
					
			 // Add some record actions
			 $this->addRowAction('edit');
			 $this->addRowAction('delete');

			parent::__construct();
		}	
    }
}
?>    