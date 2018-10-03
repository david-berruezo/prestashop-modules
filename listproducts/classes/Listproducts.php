<?php
class Listproductsobject extends ObjectModel{
    //var
    public $id_listproducts;
	public $id_shop;
	public $id_product;
	public $product_name;
	public $firstname;
	public $lastname;
	public $email;
	public $grade;
	public $comment;
    public $date_add;
    
    /**
	 * @see ObjectModel::$definition
	 */
	public static $definition = array(
		'table' => 'listproducts', 'primary' => 'id_listproducts', 'multilang' => false,
		'fields' => array(
			'id_shop' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
			'id_product' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
			'firstname' => array('type' => self::TYPE_STRING, 'validate' => 'isName', 'size' => 20),
			'lastname' => array('type' => self::TYPE_STRING, 'validate' => 'isName', 'size' => 20),
			'email' => array('type' => self::TYPE_STRING, 'validate' => 'isEmail'),
			'grade' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
			'comment' => array('type' => self::TYPE_HTML, 'validate' => 'isCleanHtml'),
			'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate', 'copy_post' => false),
		),
	);
	
	public function loadProductName()
	{
		$product = new Product($this->id_product, true, Context::getContext()->cookie->id_lang);
		$this->product_name = $product->name;
	}

    public static function getData(){
		$sql = 'SELECT * FROM '._DB_PREFIX_.'mymod_comment';
		if ($results = Db::getInstance()->ExecuteS($sql))
			foreach ($results as $row)
				echo $row['id_mymod_comment'].' :: '.$row['firstname'].'<br />';
			 
	}		
}
?>