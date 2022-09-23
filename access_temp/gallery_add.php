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
<?php
include 'configs/config.php';
if(isset($_POST['addGallery'])){
 $extensions_video= array("mp4","ogv","webm");
 $extensions_image= array("png","jpeg","gif","tiff","jpg");
 $max_video_size = 125829120;
 $max_image_size = 125829120;
 $new_sql = "INSERT INTO `gallery` (`id`, `file`, `type_id`, `about`, `cat_id`) "
         . "VALUES (NULL, 'file', '".$_POST['gallery_type_id']."', '".$_POST['galllery_info']."', '".$_POST['gallery_cat_id']."');";
 if($_POST['gallery_type_id'] <= 100)
    { $extensions = $extensions_image;
    $max_file_size = $max_image_size;
    }
    else{
        $extensions = $extensions_video;
        $max_file_size = $max_video_size;
    }
           $errors= array();
    if($res = $db->query($new_sql))
    {
                $FileID = $db->insert_id;//$dbo->lastInsertId();                
                $video_file_name = $_FILES['galllery_item']['name'];
                $video_file_size =$_FILES['galllery_item']['size'];
                $video_file_tmp =$_FILES['galllery_item']['tmp_name'];
                $video_file_type=$_FILES['galllery_item']['type'];
//                $aax = $_FILES['galllery_item']['name'];
                $tmp = explode('.',$video_file_name);
                              $video_file_ext = end($tmp);
                if(in_array($video_file_ext,$extensions)=== false){
                   $errors[]="extension not allowed, please choose a mp4, ogv or webm file.";
                }
                if($video_file_size > $max_file_size){
                   $errors[]='uploaded file must be less than ['.($video_file_size/1000000).'] MB';
                }
                if(empty($errors)==true){
                    $thenotefile = 'file_'.$FileID.'.'.$video_file_ext;
                    move_uploaded_file($video_file_tmp,"../gallery/".$thenotefile);
                    $sql = "UPDATE `gallery` SET `file` = '".$thenotefile."' WHERE `gallery`.`id` = ".$FileID;
                    $db->query($sql);
                    $errors = "Success upload note";
                }else{
                    $sql = "DELETE FROM `gallery` WHERE `gallery`.`id` = ".$FileID;
                    $db->query($sql);
                }   
                
        }   
    }?>  
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
                                    <form action="gallery_add.php">
                                        <input type="hidden" name="file_id" value="12">
                                        <input type="submit" class="btn btn-amber" name="del_file" value="Add to Gallery">
                                    </form>
				<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>				
			</div>
                    
			<div class="card-content collapse show">
				<div class="table-responsive">
					<table class="table">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Item</th>
								<th scope="col">Value</th>
							</tr>
						</thead>
						<tbody>
                                                <form method="POST" action="gallery_add.php"  enctype="multipart/form-data">
							<tr>
								<td>File Name</td>
								<td><input type="file" name="galllery_item" id="fileToUpload"></td>
							</tr>
                                                                <tr>
								<td>Info</td>
                                                                <td>
                                                                    <textarea type="text" name="galllery_info" rows="4">
                                                                    </textarea>
                                                                </td>
							</tr>
                                                                <tr>
								<td>Gallery Category</td>
                                                                <td><select name="gallery_cat_id">
                                                                        <?php $cats = getGalleryCats();
                                                                        while ($acat = $cats->fetch_assoc()){ ?>
                                                                        <option value="<?php echo $acat['id'] ?>"><?php echo $acat['name'] ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
							</tr>
                                                                <tr>
								<td>File Type</td>
								<td>
                                                                            <select name="gallery_type_id">
                                                                        <?php $types = getGalleryTypes();
                                                                                while ($acat = $types->fetch_assoc()){ ?>
                                                                                <option value="<?php echo $acat['points'] ?>"><?php echo $acat['name'] ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </td>
							</tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <input type="submit" class="btn btn-amber" name="addGallery" value="ADD">
                                                                </td>
                                                            </tr>
                                                </form>
						</tbody>
					</table>
				</div>
			</div>
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