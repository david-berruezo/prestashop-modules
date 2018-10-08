<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <title>themelock.com - Tables Advanced - Target Admin</title>

  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">

  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,300,700">
  <link rel="stylesheet" href="./css/font-awesome.min.css">
  <link rel="stylesheet" href="./js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.min.css">
  <link rel="stylesheet" href="./css/bootstrap.min.css">

  <!-- Plugin CSS -->
  <link rel="stylesheet" href="./js/plugins/icheck/skins/minimal/blue.css">

  <!-- App CSS -->
  <link rel="stylesheet" href="./css/target-admin.css">
  <link rel="stylesheet" href="./css/custom.css">


  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
</head>

<body>

  <div class="navbar">

  <div class="container">

    <div class="navbar-header">

      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <i class="fa fa-cogs"></i>
      </button>

      <a class="navbar-brand navbar-brand-image" href="./index.php">
        <img src="./img/logo.png" alt="Site Logo">
      </a>

    </div> <!-- /.navbar-header -->

  </div> <!-- /.container -->

</div> <!-- /.navbar -->

  <div class="mainbar">

  <div class="container">

    <button type="button" class="btn mainbar-toggle" data-toggle="collapse" data-target=".mainbar-collapse">
      <i class="fa fa-bars"></i>
    </button>

    <div class="mainbar-collapse collapse">

      <ul class="nav navbar-nav mainbar-nav">

        <li class="">
          <a href="./index.php">
            <i class="fa fa-dashboard"></i>
            Ensat's Shop
          </a>
        </li>

        <li class="dropdown ">
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
            <i class="fa fa-desktop"></i>
            Customers
            <span class="caret"></span>
          </a>

          <ul class="dropdown-menu">
            <li><a href="./R-Customers.php"><i class="fa fa-user nav-icon"></i> Show All Customers</a></li>
            <li><a href="./C-Customers.php"><i class="fa fa-bars nav-icon"></i> Add Customer</a></li>
            <li><a href="./U-Customers.php"><i class="fa fa-asterisk nav-icon"></i> Update Customer</a></li>
            <li><a href="./D-Customers.php"><i class="fa fa-tasks nav-icon"></i> Delete Customer</a></li>

          </ul>
        </li>

        <li class="dropdown active">
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
          <i class="fa fa-align-left"></i>
          Products
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="./R-Products.php"><i class="fa fa-user nav-icon"></i> Show All Products</a></li>
            <li><a href="./C-Products.php"><i class="fa fa-bars nav-icon"></i> Add Product</a></li>
            <li><a href="./U-Products.php"><i class="fa fa-asterisk nav-icon"></i> Update Product</a></li>
            <li><a href="./D-Products.php"><i class="fa fa-tasks nav-icon"></i> Delete Product</a></li>

          </ul>

        </li>

      </ul>

    </div> <!-- /.navbar-collapse -->

  </div> <!-- /.container -->

</div> <!-- /.mainbar -->


<div class="container">

  <div class="content">

    <div class="content-container">



      <div class="content-header">
        <h2 class="content-header-title">Products</h2>
        <ol class="breadcrumb">
          <li><a href="./index.php">Ensat's Shop</a></li>
          <li><a href="./R-Products.php">Products</a></li>
          <li class="active">Delete Products</li>
        </ol>
      </div> <!-- /.content-header -->


      <div class="row">

        <div class="col-md-12">

          <div class="portlet">

            <div class="portlet-header">

              <h3>
                <i class="fa fa-filter"></i>
                Delete Products
              </h3>

            </div> <!-- /.portlet-header -->

            <div class="portlet-content">

              <div class="table-responsive">
<?php

define('DEBUG', false);											// Debug mode
define('PS_SHOP_PATH', 'http://localhost/prestashop');		// Root path of your PrestaShop store http://www.myshop.com/
define('PS_WS_AUTH_KEY', 'CQP84L4R3GB6IV99E5WSP4JPSWXDYE1R');	// Auth key (Get it in your Back Office)ZQ88PRJX5VWQHCWE4EE7SQ7HPNX00RAJ
require_once('./PSWebServiceLibrary.php');

if (isset($_GET['DeleteID']))
{
  try
  {
    $webService = new PrestaShopWebservice(PS_SHOP_PATH, PS_WS_AUTH_KEY, DEBUG);
    // Call for a deletion, we specify the resource name and the id of the resource in order to delete the item
    $webService->delete(array('resource' => 'products', 'id' => intval($_GET['DeleteID'])));
    // If there's an error we throw an exception

    echo 'Successfully deleted !<meta http-equiv="refresh" content="5"/>';
  }
  catch (PrestaShopWebserviceException $e)
  {
    // Here we are dealing with errors
    $trace = $e->getTrace();
    if ($trace[0]['args'][0] == 404) echo 'Bad ID';
    else if ($trace[0]['args'][0] == 401) echo 'Bad auth key';
    else echo 'Other error<br />'.$e->getMessage();
  }
  }
  else
  {
    try
  	{
  		$webService = new PrestaShopWebservice(PS_SHOP_PATH, PS_WS_AUTH_KEY, DEBUG);
  		$opt = array('resource' => 'products');
  		$xml = $webService->get($opt);
  		$resources = $xml->children()->children();
  	}
  	catch (PrestaShopWebserviceException $e)
  	{
  		// Here we are dealing with errors
  		$trace = $e->getTrace();
  		if ($trace[0]['args'][0] == 404) echo 'Bad ID';
  		else if ($trace[0]['args'][0] == 401) echo 'Bad auth key';
  		else echo 'Other error';
  	}


?>
              <table
                class="table table-striped table-bordered table-hover"
                data-provide="datatable"
                data-info="true"
              >

                    <?php
                        if(isset($resources)) {
                          if(!isset($DeletionID)) {
                            ?>
                            <thead>
                              <tr>
                                <th data-filterable="true">Product's Id</th>
                                <th data-filterable="true">Manufacturer</th>
                                <th data-filterable="true">Supplier</th>
                                <th data-filterable="true">Price</th>
                                <th data-filterable="false" class="hidden-xs hidden-sm">Delete</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($resources as $resource ) {
                              $opt['id'] = $resource->attributes();
                              $xml = $webService->get($opt);
                            	$r = $xml->children()->children();

                              $opt1['resource'] = 'manufacturers';
                              $opt1['id'] = $r->id_manufacturer;
                              $xml = $webService->get($opt1);
                            	$r2 = $xml->children()->children();

                              $opt2['resource'] = 'suppliers';
                              $opt2['id'] = $r->id_supplier;
                              $xml = $webService->get($opt2);
                            	$r3 = $xml->children()->children();
                              //print_r($r2);
                              //print_r($r);
                              echo '<tr>';
                              echo '<td>'.$r->id.'</td>';
                              echo '<td>'.$r2->name.'</td>';
                              echo '<td>'.$r3->name.'</td>';
                              echo '<td>'.$r->price.'</td>';
                              echo '<td><a href="?DeleteID='.$resource->attributes().'">Delete</a></td>';
                              echo '</tr>';
                            }
                          }
                          }
                        }
                    ?>


                  </tbody>
                </table>
              </div> <!-- /.table-responsive -->


            </div> <!-- /.portlet-content -->

          </div> <!-- /.portlet -->



        </div> <!-- /.col -->

      </div> <!-- /.row -->


















    </div> <!-- /.content-container -->

  </div> <!-- /.content -->

</div> <!-- /.container -->
<footer class="footer">

  <div class="container">

    <div class="row">

      <div class="col-sm-3">

        <hr>

        <p>&copy; 2016 Ensat's Shop <br>ZIANI Leila - ENSAT.</p>

      </div> <!-- /.col -->

    </div> <!-- /.row -->

  </div> <!-- /.container -->

</footer>


  <script src="./js/libs/jquery-1.10.1.min.js"></script>
  <script src="./js/libs/jquery-ui-1.9.2.custom.min.js"></script>
  <script src="./js/libs/bootstrap.min.js"></script>

  <!--[if lt IE 9]>
  <script src="./js/libs/excanvas.compiled.js"></script>
  <![endif]-->

  <!-- Plugin JS -->
  <script src="./js/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="./js/plugins/datatables/DT_bootstrap.js"></script>
  <script src="./js/plugins/tableCheckable/jquery.tableCheckable.js"></script>
  <script src="./js/plugins/icheck/jquery.icheck.min.js"></script>

  <!-- App JS -->
  <script src="./js/target-admin.js"></script>




</body>
</html>
