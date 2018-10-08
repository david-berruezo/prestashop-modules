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

        <li class="active">
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



      <div>
        <h4 class="heading-inline">Dashboard</h4>
      </div>

      <br>
<?php

define('DEBUG', false);

define('PS_SHOP_PATH', 'http://www.prestashop17.net');							// Root path of your PrestaShop store
define('PS_WS_AUTH_KEY', 'VWZXENB8GVIKPNR5XXJF6Q5K3CCT8YV5');	// Auth key (Get it in your Back Office)

require_once('./PSWebServiceLibrary.php');
error_reporting(E_ERROR);

try {
  $webService = new PrestaShopWebservice(PS_SHOP_PATH, PS_WS_AUTH_KEY, DEBUG);
  
  $opt1['resource']  = 'customers';
  $opt2['resource']  = 'products';
  $opt3['resource']  = 'manufacturers';
  $opt4['resource']  = 'suppliers';
  $opt5['resource']  = 'employees';
  $opt6['resource']  = 'stocks';
  $opt7['resource']  = 'groups';
  $opt8['resource']  = 'guests';
  $opt9['resource']  = 'orders';
  $opt10['resource'] = 'zones';
  $opt11['resource'] = 'stores';
  $opt12['resource'] = 'customer_messages';

  $xml1 = $webService->get($opt1);
  $xml2 = $webService->get($opt2);
  $xml3 = $webService->get($opt3);
  $xml4 = $webService->get($opt4);
  $xml5 = $webService->get($opt5);
  $xml6 = $webService->get($opt6);
  $xml7 = $webService->get($opt7);
  $xml8 = $webService->get($opt8);
  $xml9 = $webService->get($opt9);
  $xml10 = $webService->get($opt10);
  $xml11 = $webService->get($opt11);
  $xml12 = $webService->get($opt12);

  $r1 = $xml1->children()->children();
  $r2 = $xml2->children()->children();
  $r3 = $xml3->children()->children();
  $r4 = $xml4->children()->children();
  $r5 = $xml5->children()->children();
  $r6 = $xml6->children()->children();
  $r7 = $xml7->children()->children();
  $r8 = $xml8->children()->children();
  $r9 = $xml9->children()->children();
  $r10 = $xml10->children()->children();
  $r11 = $xml11->children()->children();
  $r12 = $xml12->children()->children();

} catch (PrestaShopWebserviceException $e) {
  $trace = $e->getTrace();
  if($trace[0]['args'][0] == 404) echo 'Bad ID';
  else if ($trace[0]['args'][0] == 401) echo 'Bad auth key';
  else echo 'Other error <br />'.$e->getMessage();
}

?>
      <div class="row">

        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">Employees</p>
            <h3 class="row-stat-value"><strong> <?php echo count($r5);  ?></strong> </h3>
            <span class="label label-success row-stat-badge">employees</span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->

        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">Customers</p>
            <h3 class="row-stat-value"><strong> <?php echo count($r1);  ?></strong></h3>
            <span class="label label-success row-stat-badge">customers</span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->

        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">Guests</p>
            <h3 class="row-stat-value"><strong> <?php echo count($r8);  ?></strong></h3>
            <span class="label label-success row-stat-badge">guests</span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->

        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">Groups</p>
            <h3 class="row-stat-value"><strong> <?php echo count($r7);  ?></strong></h3>
            <span class="label label-success row-stat-badge">groups</span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->

      </div> <!-- /.row -->

      <div class="row">

        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">Manufacturers</p>
            <h3 class="row-stat-value"><strong> <?php echo count($r3);  ?></strong> </h3>
            <span class="label label-danger row-stat-badge">manufacturers</span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->

        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">Suppliers</p>
            <h3 class="row-stat-value"><strong> <?php echo count($r4);  ?></strong></h3>
            <span class="label label-danger row-stat-badge">suppliers</span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->

        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">Stocks</p>
            <h3 class="row-stat-value"><strong> <?php echo count($r6);  ?></strong></h3>
            <span class="label label-danger row-stat-badge">stocks</span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->

        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">Stores</p>
            <h3 class="row-stat-value"><strong> <?php echo count($r11);  ?></strong></h3>
            <span class="label label-danger row-stat-badge">stores</span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->

      </div> <!-- /.row -->

      <div class="row">

        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">Products</p>
            <h3 class="row-stat-value"><strong> <?php echo count($r2);  ?></strong> </h3>
            <span class="label label-info row-stat-badge">products</span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->

        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">Orders</p>
            <h3 class="row-stat-value"><strong> <?php echo count($r9);  ?></strong></h3>
            <span class="label label-info row-stat-badge">orders</span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->

        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">Zones</p>
            <h3 class="row-stat-value"><strong> <?php echo count($r10);  ?></strong></h3>
            <span class="label label-info row-stat-badge">zones</span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->

        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">Customer's Messages</p>
            <h3 class="row-stat-value"><strong> <?php echo count($r12);  ?></strong></h3>
            <span class="label label-info row-stat-badge">messages</span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->

      </div> <!-- /.row -->

      <br>



      <div class="row">





      <h3 >  Hello and Welcome to ENSAT's Shop :D <br/> </h3>
      <p>
        <a href="./R-Products.php"><input type="button" class="btn btn-default"  value="Products"/></a>
        <a href="./R-Customers.php"><input type="button" class="btn btn-default"  value="Customers"/></a>
      </p>

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
  <script src="./js/plugins/icheck/jquery.icheck.js"></script>
  <script src="./js/plugins/select2/select2.js"></script>
  <script src="./js/libs/raphael-2.1.2.min.js"></script>
  <script src="./js/plugins/morris/morris.min.js"></script>
  <script src="./js/plugins/sparkline/jquery.sparkline.min.js"></script>
  <script src="./js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="./js/plugins/fullcalendar/fullcalendar.min.js"></script>

  <!-- App JS -->
  <script src="./js/target-admin.js"></script>

  <!-- Plugin JS -->
  <script src="./js/demos/dashboard.js"></script>
  <script src="./js/demos/calendar.js"></script>
  <script src="./js/demos/charts/morris/area.js"></script>
  <script src="./js/demos/charts/morris/donut.js"></script>





</body>
</html>
