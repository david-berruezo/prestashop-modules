<?php
class Familia extends ObjectModel{

  public $id_familia      = "";
  public $firstname       = "";
  public $lastname        = "";
  public $id_product_var  = "";
  public $id_shop         = "";
  public $id_product      = "";
  public $age             = "";
  public $date_add        = "";
  
  public static $definition = array(
  	'table' => 'familia', 'primary' => 'id_familia', 'multilang' => false,
  	'fields' => array(
  		'id_shop' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
  		'id_product' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
  		'firstname' => array('type' => self::TYPE_STRING, 'validate' => 'isName', 'size' => 20),
  		'lastname' => array('type' => self::TYPE_STRING, 'validate' => 'isName', 'size' => 20),
  		'age' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
  	  'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate', 'copy_post' => false),
  	),
  );   

  /**
   * Get the value of id_familia
   */ 
  public function getId_familia()
  {
    return $this->id_familia;
  }

  /**
   * Set the value of id_familia
   *
   * @return  self
   */ 
  public function setId_familia($id_familia)
  {
    $this->id_familia = $id_familia;

    return $this;
  }

  
  /**
   * Get the value of firstname
   */ 
  public function getFirstname()
  {
    return $this->firstname;
  }

  /**
   * Set the value of firstname
   *
   * @return  self
   */ 
  public function setFirstname($firstname)
  {
    $this->firstname = $firstname;

    return $this;
  }

  /**
   * Get the value of lastname
   */ 
  public function getLastname()
  {
    return $this->lastname;
  }

  /**
   * Set the value of lastname
   *
   * @return  self
   */ 
  public function setLastname($lastname)
  {
    $this->lastname = $lastname;

    return $this;
  }

  /**
   * Get the value of age
   */ 
  public function getAge()
  {
    return $this->age;
  }

  /**
   * Set the value of age
   *
   * @return  self
   */ 
  public function setAge($age)
  {
    $this->age = $age;

    return $this;
  }

  /**
   * Get the value of date_add
   */ 
  public function getDate_add()
  {
    return $this->date_add;
  }

  /**
   * Set the value of date_add
   *
   * @return  self
   */ 
  public function setDate_add($date_add)
  {
    $this->date_add = $date_add;

    return $this;
  }

  /**
   * Get the value of id_product_var
   */ 
  public function getId_product_var()
  {
    return $this->id_product_var;
  }

  /**
   * Set the value of id_product_var
   *
   * @return  self
   */ 
  public function setId_product_var($id_product_var)
  {
    $this->id_product_var = $id_product_var;

    return $this;
  }

  


  /**
   * Get the value of id_shop_var
   */ 
  public function getId_shop_var()
  {
    return $this->id_shop_var;
  }

  /**
   * Set the value of id_shop_var
   *
   * @return  self
   */ 
  public function setId_shop_var($id_shop_var)
  {
    $this->id_shop_var = $id_shop_var;

    return $this;
  }
}
?>