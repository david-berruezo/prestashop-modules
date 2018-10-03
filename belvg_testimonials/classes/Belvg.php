<?php
class Belvg extends ObjectModel{

  public $id_belvg_testimonials = "";  
  public $name                  = "";
  public $email                 = "";
  public $site                  = "";
  public $status                = "";
  //public $id_shop               = "";
  //public $id_product            = "";
  public $date_add              = "";
  public $date_upd              = "";

  public static $definition = array(
  	'table' => 'belvg_testimonials', 'primary' => 'id_belvg_testimonials', 'multilang' => true,
  	'fields' => array(
  		//'id_shop' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
  		//'id_product' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
  		'name' => array('type' => self::TYPE_STRING, 'validate' => 'isName', 'size' => 50),
  		'email' => array('type' => self::TYPE_STRING,  'size' => 50),
      'site' => array('type' => self::TYPE_STRING,  'size' => 50), 
      'status' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
      'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate', 'copy_post' => false),
      'date_upd' => array('type' => self::TYPE_DATE, 'validate' => 'isDate', 'copy_post' => false),  
  	),
  );   
  

/**
   * Get the value of id_belvg_testimonials
   */ 
  public function getId_belvg_testimonials()
  {
    return $this->id_belvg_testimonials;
  }

  /**
   * Set the value of id_belvg_testimonials
   *
   * @return  self
   */ 
  public function setId_belvg_testimonials($id_belvg_testimonials)
  {
    $this->id_belvg_testimonials = $id_belvg_testimonials;

    return $this;
  }

  /**
   * Get the value of name
   */ 
  public function getName()
  {
    return $this->name;
  }

  /**
   * Set the value of name
   *
   * @return  self
   */ 
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }


  /**
   * Get the value of email
   */ 
  public function getEmail()
  {
    return $this->email;
  }

  /**
   * Set the value of email
   *
   * @return  self
   */ 
  public function setEmail($email)
  {
    $this->email = $email;

    return $this;
  }

  /**
   * Get the value of site
   */ 
  public function getSite()
  {
    return $this->site;
  }

  /**
   * Set the value of site
   *
   * @return  self
   */ 
  public function setSite($site)
  {
    $this->site = $site;

    return $this;
  }

  /**
   * Get the value of status
   */ 
  public function getStatus()
  {
    return $this->status;
  }

  /**
   * Set the value of status
   *
   * @return  self
   */ 
  public function setStatus($status)
  {
    $this->status = $status;

    return $this;
  }

  /**
   * Get the value of id_shop
   */ 
  public function getId_shop()
  {
    return $this->id_shop;
  }

  /**
   * Set the value of id_shop
   *
   * @return  self
   */ 
  public function setId_shop($id_shop)
  {
    $this->id_shop = $id_shop;

    return $this;
  }

  /**
   * Get the value of id_product
   */ 
  public function getId_product()
  {
    return $this->id_product;
  }

  /**
   * Set the value of id_product
   *
   * @return  self
   */ 
  public function setId_product($id_product)
  {
    $this->id_product = $id_product;

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
   * Get the value of date_upd
   */ 
  public function getDate_upd()
  {
    return $this->date_upd;
  }

  /**
   * Set the value of date_upd
   *
   * @return  self
   */ 
  public function setDate_upd($date_upd)
  {
    $this->date_upd = $date_upd;

    return $this;
  }
}
?>