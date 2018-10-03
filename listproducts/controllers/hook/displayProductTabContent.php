<?php

class ListproductsDisplayProductTabContentController
{

	public function __construct($module, $file, $path)
	{
		$this->file = $file;
		$this->module = $module;
		$this->context = Context::getContext();
		$this->_path = $path;
		//$this->cache_id = $this->module->smartyGetCacheId($this->module->name.(int)Tools::getValue('id_product'));
	}	

	public function processProductTabContent()
	{
		
		if (Tools::isSubmit('enviar'))
		{
			
			/*
			if (!Validate::isName($firstname) || !Validate::isName($lastname) || !Validate::isEmail($email))
			{
				$this->context->smarty->assign('new_comment_posted', 'error');
				return false;
			}
			*/

			$id_product = Tools::getValue('id_product');
			$id_shop = (int)$this->context->shop->id;
			$firstname = Tools::getValue('nombre');
			$lastname = Tools::getValue('apellido');
			$email = Tools::getValue('email');
			$grade = Tools::getValue('grade');
			$comment = Tools::getValue('comment');
			
			$listproducts = new Listproductsobject();
			$listproducts->id_shop = (int)$this->context->shop->id;
			$listproducts->id_product = (int)$id_product;
			$listproducts->firstname = $firstname;
			$listproducts->lastname = $lastname;
			$listproducts->email = $email;
			$listproducts->grade = (int)$grade;
			$listproducts->comment = nl2br($comment);
			$listproducts->add();

			//$this->context->smarty->assign('new_comment_posted', 'success');
			//$this->module->smartyClearCache('displayProductTabContent.tpl', $this->cache_id);
			
		}
		
	}

	public function assignProductTabContent()
	{
		$sql = 'SELECT * FROM '._DB_PREFIX_.'listproducts';
		if ($results = Db::getInstance()->ExecuteS($sql))
			$this->context->smarty->assign('resultados', $results);
			/*
			foreach ($results as $row)
				echo $row['id_shop'].' :: '.$row['name'].'<br />';
			*/
	}

	public function run($params)
	{
		$variable = array(
			"asociativa" => "valor"
		);
		$this->context->smarty->assign('vector', $variable);
		$this->processProductTabContent();
		$this->assignProductTabContent();
		//Listproductsobject::getData();
		return $this->module->display($this->file,'displayProductTabContent.tpl');
	}
}
