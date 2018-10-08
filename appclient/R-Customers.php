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

        <li class="dropdown active">
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

        <li class="dropdown ">
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
        <h2 class="content-header-title">Customers</h2>
        <ol class="breadcrumb">
          <li><a href="./index.php">Ensat's Shop</a></li>
          <li><a href="./R-Customers.php">Customers</a></li>
          <li class="active">Show All Customers</li>
        </ol>
      </div> <!-- /.content-header -->


      <div class="row">

        <div class="col-md-12">

          <div class="portlet">

            <div class="portlet-header">

              <h3>
                <i class="fa fa-filter"></i>
                All Customers
              </h3>

            </div> <!-- /.portlet-header -->

            <div class="portlet-content">

              <div class="table-responsive">
<?php

define('DEBUG', false);											// Debug mode

define('PS_SHOP_PATH', 'http://www.prestashop17.net');							// Root path of your PrestaShop store
define('PS_WS_AUTH_KEY', 'VWZXENB8GVIKPNR5XXJF6Q5K3CCT8YV5');	// Auth key (Get it in your Back Office)

require_once('./PSWebServiceLibrary.php');

try
{
	$webService = new PrestaShopWebservice(PS_SHOP_PATH, PS_WS_AUTH_KEY, DEBUG);
	$opt['resource'] = 'customers';
  $opt['id'] = 1;
  /*
  if (isset($_GET['id'])) {
		$opt['id'] = (int)$_GET['id'];
		}
 */
	$xml = $webService->get($opt);

	$resources = $xml->children()->children();
  //print_r($resources);
}
catch (PrestaShopWebserviceException $e)
{
	$trace = $e->getTrace();
	if ($trace[0]['args'][0] == 404) echo 'Bad ID';
	else if ($trace[0]['args'][0] == 401) echo 'Bad auth key';
	else echo 'Other error<br />'.$e->getMessage();
}
?>
              <table
                class="table table-striped table-bordered table-hover"
                data-provide="datatable"
                data-info="true"
              >

                    <?php
                        if(isset($resources)) {
                          if (!$opt['id']){
                          //if(!isset($_GET['id'])) {
                            ?>
                            <thead>
                              <tr>
                                <th data-filterable="true">Customer's Id</th>
                                <th data-filterable="true">Firstname</th>
                                <th data-filterable="true">Lastname</th>
                                <th data-filterable="true">Email</th>
                                <th data-filterable="false" class="hidden-xs hidden-sm">Details</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($resources as $resource ) {
                              $opt['id'] = $resource->attributes();
                              $xml = $webService->get($opt);
                            	$r = $xml->children()->children();
                              //print_r($r);
                              echo '<tr>';
                              echo '<td>'.$r->id.'</td>';
                              echo '<td>'.$r->firstname.'</td>';
                              echo '<td>'.$r->lastname.'</td>';
                              echo '<td>'.$r->email.'</td>';
                              echo '<td><a href="?id='.$resource->attributes().'">Details</a></td>';
                              echo '</tr>';
                            }
                          } else {
                            foreach ($resources as $key => $resource) {
                              echo '<tr>';
                              echo '<th>'.$key.'</th>';
                              echo '<td>'.$resource.'</td>';
                              echo '</tr>';
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
