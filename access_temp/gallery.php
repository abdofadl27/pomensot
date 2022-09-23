<?php include 'configs/headl.inc.php';if(isUserLoggedIn()){if(getUser()['level'] < 4){$school_id = 1; $admino = getUser();?><!DOCTYPE html>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="IoT Farm Dashboard">
    <meta name="keywords" content="IoT Farm Dashboard">
    <meta name="author" content="Mohamed Elshaikh">
    <title>IoT Farm Dashboard</title>
    <link rel="apple-touch-icon" href="theme-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="theme-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="theme-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="theme-assets/vendors/css/charts/chartist.css">
    
    <link rel="stylesheet" type="text/css" href="theme-assets/css/app-lite.css">
    
    <link rel="stylesheet" type="text/css" href="theme-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="theme-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="theme-assets/css/pages/dashboard-ecommerce.css">
   
  </head>
  <body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-chartbg" data-col="2-columns">

    <!-- fixed-top-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light">
      <div class="navbar-wrapper">
        <div class="navbar-container content">
          <div class="collapse navbar-collapse show" id="navbar-mobile">
             <h2 style="color: whitesmoke; margin-top: 2%;"> Welcome [<?php echo $admino['name']; ?>]</h2>
          </div>
        </div>
      </div>
    </nav>

    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <?php include 'configs/prints.php';    printSide('gallery') ?>

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- Chart -->
            <!-- Table head options start -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Gallery</h4>
                                <form action="gallery_add.php" method="POST">
                                        <input type="hidden" name="file_id" value="12">
                                        <input type="submit" class="btn btn-amber" name="del_file" value="Add to Gallery">
                                    </form>
				<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>				
			</div>
                            <?php
                            $ProductList = getAllGalleryByCat('product');
                        $testList = getAllGalleryByCat('testimony');
                        $NewsList = getAllGalleryByCat('news');
                        if(!is_null($ProductList)){                            
                            ?>
                    <div class="card-header">
                        <h2>Products List</h2>
                    </div>
			<div class="card-content collapse show">
				<div class="table-responsive">
					<table class="table table-striped">
						<thead class="thead-dark">
							<tr>
								<th scope="col">[File ID]</th>
								<th scope="col">Type #</th>
                                                                        <th scope="col">Details</th>
								<th scope="col">Preview</th>
								<th scope="col">Delete</th>
							</tr>
						</thead>
						<tbody>
                                                    <?php while($apro = $ProductList->fetch_assoc()){ ?>
							<tr>
								<td><?php echo $apro['id']; ?></td>
								<td><?php echo $apro['type_id']; ?></td>
                                                                        <td><?php echo $apro['about']; ?></td>
                                                                        <td><img class="img img-thumbnail" style="width: 10%; height: auto;"src="../gallery/<?php echo $apro['file']; ?>"></td>
                                                                        <td>DEL</td>
							</tr>
                                                    <?php } ?>
						</tbody>
					</table>
				</div>
			</div>
                        <?php } if(!is_null($testList)){                            
                            ?>
                    <div class="card-header">
                        <h2>Testimonies List</h2>
                    </div>
			<div class="card-content collapse show">
				<div class="table-responsive">
					<table class="table">
						<thead class="thead-dark">
							<tr>
								<th scope="col">[File ID]</th>
								<th scope="col">Type #</th>
                                                                <th scope="col">Details</th>
								<th scope="col">Preview</th>
								<th scope="col">Delete</th>
							</tr>
						</thead>
						<tbody>
                                                    <?php while($apro = $testList->fetch_assoc()){ ?>
							<tr>
								<td><?php echo $apro['id']; ?></td>
								<td><?php echo $apro['type_id']; ?></td>
                                                                <td><?php echo $apro['about']; ?></td>
                                                                        <td><img class="img img-thumbnail" style="width: 10%; height: auto;"src="../gallery/<?php echo $apro['file']; ?>"></td>
                                                                        <td>DEL</td>
							</tr>
                                                    <?php } ?>
						</tbody>
					</table>
				</div>
			</div>
                        <?php } if(!is_null($NewsList)){                            
                            ?>
                    <div class="card-header">
                        <h2>News List</h2>
                    </div>
			<div class="card-content collapse show">
				<div class="table-responsive">
					<table class="table">
						<thead class="thead-dark">
							<tr>
								<th scope="col">[File ID]</th>
								<th scope="col">Type #</th>
                                                                <th scope="col">Details</th>
								<th scope="col">Preview</th>
								<th scope="col">Delete</th>
							</tr>
						</thead>
						<tbody>
                                                    <?php while($apro = $NewsList->fetch_assoc()){ ?>
							<tr>
								<td><?php echo $apro['id']; ?></td>
								<td><?php echo $apro['type_id']; ?></td>
                                                                        <td><?php echo $apro['about']; ?></td>
                                                                        <td><img class="img img-thumbnail" style="width: 10%; height: auto;"src="../gallery/<?php echo $apro['file']; ?>"></td>
                                                                        <td>DEL</td>
							</tr>
                                                    <?php } ?>
						</tbody>
					</table>
				</div>
			</div>
                        <?php } ?>
		</div>
	</div>
</div>
<!-- Table head options end -->

        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <?php printfooter(); ?>

    <!-- BEGIN VENDOR JS-->
    <script src="theme-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="theme-assets/vendors/js/charts/chartist.min.js" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN CHAMELEON  JS-->
    <script src="theme-assets/js/core/app-menu-lite.js" type="text/javascript"></script>
    <script src="theme-assets/js/core/app-lite.js" type="text/javascript"></script>
    <!-- END CHAMELEON  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="theme-assets/js/scripts/pages/dashboard-lite.js" type="text/javascript"></script>
    <script src="theme-assets/js/scripts/charts/chartjs/line/line.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
  </body>
</html><?php
}}else {
     echo '<form action="../index.php" method="get">
          <input type="hidden" name="err" value="Please Login"/>
          <input type="submit" name="login" value="Please Login"/>
      </form>';    
} 
?>