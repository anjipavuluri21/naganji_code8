<?php
include "connectionpdo.php";
include "../functions.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Code8 Administrator</title> 
    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
	<!-- Select2 -->
    <link href="vendors/select2/dist/css/select2.min.css" rel="stylesheet">
	<!--<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>-->
	<script src="ckeditor/ckeditor.js"></script>
    <script src="ckeditor/config.js"></script>
	<script src="ckeditor/samples/js/sample.js"></script>
	<link rel="stylesheet" href="ckeditor/samples/css/samples.css">
	<link rel="stylesheet" href="ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">
    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
	
	<!-- Datatables -->
    <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    
    
	
	<style>
	.site_title {
		text-overflow: ellipsis;		
		font-weight: 400;
		font-size: 22px;
		width: 100%;
		color: 
		#ECF0F1 !important;
		margin-left: 0 !important;
		line-height: 59px;
		display: block;
		height: 55px;
		margin: 0;
		padding-left: 10px;
	}
	footer {
		margin-left: 0px;
	}
	</style>
  </head>
<?php
	$loginid = $_SESSION['SESS_MEMBER_ID'];		
	$user_query = "SELECT * from code8_adminuser where id=$loginid";
	$database = new Database();
	$dbCon = $database->getConnection();
	$stmt = $dbCon->prepare($user_query);  
	$stmt->execute();
	$user_res = $stmt->fetch(PDO::FETCH_ASSOC);
?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">		 
            <div class="navbar nav_title" align="center" >
				<div class="site_title" style="border: 0px solid white;padding-left:0px; margin: 10px">
					<img class="site_title" style="border: 0px solid white;padding-left:5px;padding-right:10px;overflow:visible" src="images/logo.png" width="220">
				</div>
			</div>
            <div class="clearfix"></div>
            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
			  <?php if($user_res['profilepic']!=""){ ?>
                <img src="../<?php echo $user_res['profilepic'] ?>" alt="..." class="img-circle profile_img">
			  <?php } else { ?>
				<img src="images/user.png" alt="..." class="img-circle profile_img">
			  <?php } ?>
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo ucwords($user_res['username']) ?></h2>
              </div>
            </div>
            			
			<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">                
                <ul class="nav side-menu">					
					<!--<li><a><i class="fa fa-external-link"></i>Admin Menu Mgmt<span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
						  <li><a href="adminmenu_addnew.php">Add New Menu</a></li>
						  <li><a href="adminmenus.php">View All Menu</a></li> 
						  <li><a href="adminsubmenu_addnew.php">Add New Sub Menu</a></li>
						  <li><a href="adminsubmenus.php">View All Menu</a></li>					  
						</ul>
					</li>-->	
					<li><a href="landingpage.php"><i class="fa fa-external-link"></i>Dashboard</a>
					</li>					
					<?php
					$i = 1;
					$icons = array('','slideshare','newspaper-o','flag','external-link','users','user-plus','pencil-square-o','file-text-o','th-large','university','line-chart','clipboard','dropbox','paper-plane','map','briefcase','database','file-text');
																
					$banner_que = "SELECT * from code8_usermenulist LEFT JOIN code8_adminmenu ON code8_usermenulist.adminmenuid=code8_adminmenu.id where adminmenuid!=0 AND code8_usermenulist.userid=$loginid AND code8_usermenulist.status=1 ORDER BY corder ASC";
					$database = new Database();
					$dbCon = $database->getConnection();
					$stmt = $dbCon->prepare($banner_que);  
					$stmt->execute();
					$menbanner_res = $stmt->fetchAll(PDO::FETCH_ASSOC);
					foreach($menbanner_res as $banner_result) {
						$mid 			= 	$banner_result['adminmenuid'];
						$menusubmenurel = 	$banner_result['menusubmenurel'];	
							
						$banner_que1 = "SELECT * from code8_adminmenu where id=$mid ORDER BY corder ASC";
						$database = new Database();
						$dbCon = $database->getConnection();
						$stmt = $dbCon->prepare($banner_que1);  
						$stmt->execute();
						$banner_result1 = $stmt->fetch(PDO::FETCH_ASSOC);
					?>
					<li><a><i class="fa fa-<?php echo $icons[$i] ?>"></i><?php echo $banner_result1['menuname'] ?> <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
						<?php												
							$banner_que2 = "SELECT * from code8_usermenulist where menusubmenurel=$mid AND userid=$loginid AND status=1";
							$database = new Database();
							$dbCon = $database->getConnection();
							$stmt = $dbCon->prepare($banner_que2);  
							$stmt->execute();
							$menbanner_res2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
							foreach($menbanner_res2 as $banner_result2) {
								$subid 	= $banner_result2['adminsubmenuid'];	
									
								$banner_que3 = "SELECT * from code8_adminsubmenu where id=$subid AND status=1";
								$database = new Database();
								$dbCon = $database->getConnection();
								$stmt = $dbCon->prepare($banner_que3);  
								$stmt->execute();
								$banner_result3 = $stmt->fetch(PDO::FETCH_ASSOC);
						?>
							<li><a href="<?php echo $banner_result3['link'] ?>"><?php echo $banner_result3['submenuname'] ?></a></li>
						<?php } ?>						
						</ul>
					</li>
					<?php $i++; } ?>
					<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
				</ul>
              </div>             
            </div>			            
            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top"></a>
              <a data-toggle="tooltip" data-placement="top"></a>
              <a data-toggle="tooltip" data-placement="top"></a>
              <a data-toggle="tooltip" data-placement="top"></a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<?php if($user_res['profilepic']!=""){ ?>
						<img src="../<?php echo $user_res['profilepic'] ?>" alt="">
					<?php } else { ?>
						<img src="images/user.png" alt="">
					<?php } ?>
					<?php echo ucwords($user_res['username']) ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">           
                    <li>
                    <a href="changepassword.php"><i class="fa fa-key pull-right"></i>Profile Settings</a>
                    </li>                   
                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>                
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
