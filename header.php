<?php 
session_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

include "connectionpdo.php"; 
include "PHPMailer.php";
include "class.smtp.php"; 
include "functions.php";
include 'project_constants.php';
if(isset($_POST['register']) || isset($_POST['login']) || isset($_POST['forgot'] ))
include "submitregister.php";
//Get page name
$pagename = basename($_SERVER['PHP_SELF']);
//Set Country in Session
if($_SESSION["COUNTRY"]==""){
	$_SESSION["COUNTRY"] = "1";
} else {
	$_SESSION["COUNTRY"];
}
$countryid = $_SESSION["COUNTRY"];
//Get Currency Code
$countrydet   = getCountry($countryid);
$currencycode = $countrydet['currencycode'];
$deliverycharges = $countrydet['delivery_charges'];
//print_r($deliverycharges).exit;
//Get the current path
$url = $_SERVER['REQUEST_URI']; 
$parts = explode('/',$url);
$currentpath = $_SERVER['SERVER_NAME'];
for ($i = 0; $i < count($parts) - 1; $i++) {
 $currentpath .= $parts[$i] . "/";
}
$schema = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
$urlpath = $schema.$currentpath;
//User Login ID
$guestid = $_COOKIE['guestid'];
$loginid = $_SESSION['SESS_CUSTOMER_ID'];

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Code 8</title>
<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0" />
<link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
<link rel="manifest" href="favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<link href="https://fonts.googleapis.com/css?family=Cabin:400,500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Qwigley&display=swap" rel="stylesheet">
<!--<link href="css/jpreloader.css" rel="stylesheet" type="text/css" media="screen"/>-->
<link rel="stylesheet" href="swiper/swiper.min.css" type="text/css" media="all"/>	
<link rel="stylesheet" type="text/css" href="scrollbar/jquery.mCustomScrollbar.min.css" />	
<link rel="stylesheet" type="text/css" href="fancybox-master/jquery.fancybox.min.css" />	
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/webslidemenu.css" rel="stylesheet" type="text/css" media="all" />	
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/sweetalert.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/responsive.css" rel="stylesheet" type="text/css" media="all" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
<header>
	<div class="header-sub">
		<div class="container clearfix">
			<div class="row">
				<div class="col-12">
					<div class="topbar">
						<ul class="location-language">
							<li><span class="lbl">Location :</span>
							<select name="location" id="location" class="form-control">
							<?php							
							$location_que = "SELECT * from code8_countries where 1=1 ORDER BY id DESC";
							$database1 = new Database();
							$dbCon1 = $database1->getConnection();
							$stmt1 = $dbCon1->prepare($location_que);  
							$stmt1->execute();	
							$location_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
							foreach($location_res as $location_result){		
							?>
								<option <?php if($location_result['id']==$_SESSION['COUNTRY']){ echo "selected"; } ?> value="<?php echo $location_result['id']; ?>"><?php echo $location_result['title'].' '.$location_result['currencycode']; ?></option>
							<?php							
							}						
							?>
							</select>
							</li>
                                <li><span class="lbl">Language: </span><a href="<?php echo base_url_ar."index.php";?>" class="language-text">عربى</a></li>

						</ul>
						<a href="index.php" class="code8"><img src="images/code8.png" alt="code8"/></a>
						<ul class="ecommerce-div">
							<?php if($_SESSION["SESS_CUSTOMER_ID"]!="" && $_SESSION["SESS_CUSTOMER_TYPE"]=="2"){ ?>
								<li><a href="my-account.php" class="signin-link" title="My Account">My Account</a></li>
								<li><a href="logout.php" class="signin-link" title="My Account">Logout</a></li>
							<?php } else { ?>
								<li><a href="javascript:void(0);" class="signin-link" title="Sign In" data-fancybox="" data-src="#loginModal" data-animation-duration="700">Sign In</a></li>
							<?php } ?>
							<li>
							<?php if($_SESSION["SESS_CUSTOMER_ID"]!=""){ ?>
							<?php
							$countwish_que = "SELECT count(*) as cartcount from code8_wishlist where userid=$loginid";
							$database1 = new Database();
							$dbCon1 = $database1->getConnection();
							$stmt1 = $dbCon1->prepare($countwish_que);  
							$stmt1->execute();	
							$countwish_res = $stmt1->fetch(PDO::FETCH_ASSOC);
							?>
								<a href="javascript:void(0);" class="favourite-link" title="Favourite"><img src="images/favourite-icon.png" alt="Favourite"><span class="link-span"><?php if($countwish_res['cartcount']!=""){ echo $countwish_res['cartcount']; } else { echo "0"; } ?></span></a>
							<?php } else { ?>
								<a data-src="#wishlistlogpop" data-fancybox="" href="javascript:void(0);" class="favourite-linkguest on-addtocart-btn" title="Favourite"><img src="images/favourite-icon.png" alt="Favourite"><span class="link-span">0</span></a>
							<?php } ?>
								<div class="favourite-popup">
									<div class="favourite-popup-sub">
										<h3>My Wishlist</h3>
										<div class="favourite-scroll mCustomScrollbar">
											<ul class="product-div">
											<?php
											$wish_que = "SELECT * from code8_wishlist where userid=$loginid";
											$database1 = new Database();
											$dbCon1 = $database1->getConnection();
											$stmt1 = $dbCon1->prepare($wish_que);  
											$stmt1->execute();	
											$wish_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
											foreach($wish_res as $wish_result){	
												$wishproddata  = getProductData($wish_result['prodid']);	
												$wishprodpricedata = getProductPrice($wish_result['prodid'],$countryid);
											?>
												<li class="favourite-product">
													<div class="product-thumb">
														<div class="product-holder-img"><a href="product-detail.php?id=<?php echo $wish_result['prodid'] ?>" class="pro-dt-btn"></a>
															<figure class="pro-img1"><img src="<?php echo $wishproddata['thumimage1']; ?>" alt="products"></figure>
															<figure class="pro-img2"><img src="<?php echo $wishproddata['thumimage2']; ?>" alt="products"></figure>
														</div>
														<div class="product-dtl">
															<div class="product-price-btn"><div class="product-price"><?php echo $wishprodpricedata; ?></div></div>
															<h2><?php echo $wishproddata['prodtitle']; ?></h2>
														</div>
														<a href="product-detail.php?id=<?php echo $wish_result['prodid'] ?>" title="Add to Cart" class="fav-addtocart-item"><span></span></a>
														<a id="deletewish_<?php echo $wish_result['id'] ?>" href="javascript:void(0);" title="Remove Item" class="remove-item"></a>
														<script>
														$(function(){
															$("[id^='deletewish_']").click(function(){
															var i=$(this).attr('id');		
															var arr=i.split("_");
															var i=arr[1];	   	 		
															 $.ajax({
																	type:"POST",
																	data:"id="+i,
																	url:"deleteprods.php?type=delwishprod",
																	success:function(data)
																	{				
																		location.reload();				
																	}
																});		
															});	
														});
														</script>
													</div>
												</li>	
											<?php } ?>
											</ul>
										</div>
										<a href="wishlist.php" class="button">See My Wishlist</a>
									</div>
								</div>
							</li>
							<?php							
							if($loginid==""){
							   $countcart_que = "SELECT count(*) as cartcount from code8_cart where status=1 AND guestid=$guestid";
							} else {
								$countcart_que = "SELECT count(*) as cartcount from code8_cart where status=1 AND customerid=$loginid";
							}						
							$database1 = new Database();
							$dbCon1 = $database1->getConnection();
							$stmt1 = $dbCon1->prepare($countcart_que);  
							$stmt1->execute();	
							$countcart_res = $stmt1->fetch(PDO::FETCH_ASSOC);	
                                                        print_r($countcart_res);
							?>
							<li><a href="javascript:void(0);" class="cart-link" title="Shopping Bag"><img src="images/icon-cart.png" alt="cart"><span class="link-span" id="cart_count"><?php if($countcart_res['cartcount']!=""){ echo $countcart_res['cartcount']; } else { echo "0"; } ?></span></a></li>
							<li><a href="javascript:void(0);" class="search-link" title="Search"><img src="images/icon-search.svg" alt="search"></a></li>
						</ul>
					</div>
				</div>	
			</div>	
		</div>
		<?php							
		$menutitle_que = "SELECT * from code8_menutitles where id=1";
		$database1 = new Database();
		$dbCon1 = $database1->getConnection();
		$stmt1 = $dbCon1->prepare($menutitle_que);  
		$stmt1->execute();	
		$menutitle_res = $stmt1->fetch(PDO::FETCH_ASSOC);			
		?>
		<div class="navigation">
			<div class="wsmenucontainer clearfix">
				<div class="overlapblackbg"></div>
				<div class="wsmobileheader clearfix">
					<a id="wsnavtoggle" class="animated-arrow"><span></span></a>
				</div>
				<div class="wsmain">
					<nav class="wsmenu clearfix">
						<ul class="mobile-sub wsmenu-list">
							<li><a href="index.php" class="active"><?php echo $menutitle_res['title1']; ?></a></li>
							<li><a href="javascript:void(0);" class="main-link"><?php echo $menutitle_res['title2']; ?></a>
								<ul class="wsmenu-submenu collection-menu">
									<li>
										<div class="container clearfix submenu-div">
											<div class="navi-left"><img src="<?php echo $menutitle_res['collectionimage']; ?>" alt="collection"/></div>
											<div class="navi-right">
											<ul class="menu-items five-part">
											
												<li class="item-bunch">
													<a href="javascript:void(0)" class="sub-menu-title">New Arrivals</a>
													<ul>
														<li><a href="collections_newin.php">New In</a></li>
														<?php							
														$brandmenu_que = "SELECT * from code8_brands where status=1 AND collectionorwomen=1 ORDER BY id ASC";
														$database1 = new Database();
														$dbCon1 = $database1->getConnection();
														$stmt1 = $dbCon1->prepare($brandmenu_que);  
														$stmt1->execute();	
														$brandmenu_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
														foreach($brandmenu_res as $brandmenu_result){
														?>	
															<li><a href="brands.php?id=<?php echo $brandmenu_result['id']; ?>"><?php echo $brandmenu_result['title']; ?></a></li>
														<?php } ?>
													</ul>
												</li>
												<?php							
												$colllocation_que = "SELECT * from code8_collectionsmenu where status=1 AND menutype=1 ORDER BY id ASC";
												$database1 = new Database();
												$dbCon1 = $database1->getConnection();
												$stmt1 = $dbCon1->prepare($colllocation_que);  
												$stmt1->execute();	
												$colllocation_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
												foreach($colllocation_res as $colllocation_result){	
													$colllmenid  = $colllocation_result['id'];
												?>	
												<li class="item-bunch">
													<a href="javascript:void(0)" class="sub-menu-title"><?php echo $colllocation_result['title']; ?></a>
													<ul>
														<?php							
														$subcolocation_que = "SELECT * from code8_collectionssubmenu where status=1 AND menutype=1 AND menuid=$colllmenid ORDER BY id ASC";
														$database1 = new Database();
														$dbCon1 = $database1->getConnection();
														$stmt1 = $dbCon1->prepare($subcolocation_que);  
														$stmt1->execute();	
														$subcolocation_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
														foreach($subcolocation_res as $subcolocation_result){		
														?>	
															<li><a href="products.php?id=<?php echo $subcolocation_result['id']; ?>"><?php echo $subcolocation_result['title']; ?></a></li>
														<?php } ?>
													</ul>
												</li>								  
											<?php } ?>
											</ul>
											</div>
										</div>		
									</li>
								</ul>
							</li>
							<li><a href="sales.php"><?php echo $menutitle_res['title3']; ?></a></li>
							<li><a href="javascript:void(0);" class="main-link"><?php echo $menutitle_res['title4']; ?></a>
								<ul class="wsmenu-submenu collection-menu">
									<li>
										<div class="container clearfix submenu-div">
											<div class="navi-left"><img src="<?php echo $menutitle_res['desiggnerwearimage']; ?>" alt="collection"/></div>
											<div class="navi-right">
											<ul class="menu-items three-part">
												<li class="item-bunch">
													<a href="javascript:void(0)" class="sub-menu-title">RECENT</a>
													<ul>
														<li><a href="javascript:void(0)">Givenchy Atelier</a></li>
														<li><a href="javascript:void(0)">Arivenchy</a></li>
														<li><a href="javascript:void(0)">The Eden Bag</a></li>
													</ul>
												</li>
												<li class="item-bunch">
													<a href="javascript:void(0)" class="sub-menu-title">MILESTONES</a>
													<ul>
														<li><a href="javascript:void(0)">Hubert de Givenchy</a></li>
														<li><a href="javascript:void(0)">Clare Waight Keller</a></li>
														<li><a href="javascript:void(0)">Paris: George V</a></li>
													</ul>
												</li>
											  <li class="item-bunch">
												  <a href="javascript:void(0)" class="sub-menu-title">BY TOPIC</a>
													<ul>
														<li><a href="javascript:void(0)">Givenchy Stories</a></li>
														<li><a href="javascript:void(0)">Clare Waight Keller</a></li>
														<li><a href="javascript:void(0)">History</a></li>
														<li><a href="javascript:void(0)">Red Carpet</a></li>
														<li><a href="javascript:void(0)">Collaborations</a></li>
														<li><a href="javascript:void(0)">Architecture</a></li>
														<li><a href="javascript:void(0)">Savoir-Faire</a></li>
													</ul>
											  </li>
											</ul>
											</div>
										</div>		
									</li>
								</ul>	
							</li>
							<li><a href="javascript:void(0);" class="main-link"><?php echo $menutitle_res['title5']; ?></a>
								<ul class="wsmenu-submenu collection-menu">
									<li>
										<div class="container clearfix submenu-div">
											<div class="navi-left"><img src="<?php echo $menutitle_res['womenimage']; ?>" alt="collection"/></div>
											<div class="navi-right">
											<ul class="menu-items five-part">
												<li class="item-bunch">
													<a href="javascript:void(0)" class="sub-menu-title">New Arrivals</a>
													<ul>								
														<li><a href="womens_newin.php">New In</a></li>
														<?php							
														$brandmenu_que = "SELECT * from code8_brands where status=1 AND collectionorwomen=2 ORDER BY id ASC";
														$database1 = new Database();
														$dbCon1 = $database1->getConnection();
														$stmt1 = $dbCon1->prepare($brandmenu_que);  
														$stmt1->execute();	
														$brandmenu_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
														foreach($brandmenu_res as $brandmenu_result){
														?>	
															<li><a href="brands.php?id=<?php echo $brandmenu_result['id']; ?>"><?php echo $brandmenu_result['title']; ?></a></li>
														<?php } ?>
													</ul>
												</li>
												<?php							
												$wcolllocation_que = "SELECT * from code8_collectionsmenu where status=1 AND menutype=2 ORDER BY id ASC";
												$database1 = new Database();
												$dbCon1 = $database1->getConnection();
												$stmt1 = $dbCon1->prepare($wcolllocation_que);  
												$stmt1->execute();	
												$wcolllocation_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
												foreach($wcolllocation_res as $wcolllocation_result){	
													$colllmenid  = $wcolllocation_result['id'];
												?>	
												<li class="item-bunch">
													<a href="javascript:void(0)" class="sub-menu-title"><?php echo $wcolllocation_result['title']; ?></a>
													<ul>
														<?php							
														$wsubcolocation_que = "SELECT * from code8_collectionssubmenu where status=1 AND menutype=2 AND menuid=$colllmenid ORDER BY id ASC";
														$database1 = new Database();
														$dbCon1 = $database1->getConnection();
														$stmt1 = $dbCon1->prepare($wsubcolocation_que);  
														$stmt1->execute();	
														$wsubcolocation_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
														foreach($wsubcolocation_res as $wsubcolocation_result){			
														?>	
															<li><a href="products.php?id=<?php echo $wsubcolocation_result['id']; ?>"><?php echo $wsubcolocation_result['title']; ?></a></li>
														<?php } ?>
													</ul>
												</li>								  
											<?php } ?>
											</ul>
											</div>
										</div>		
									</li>
								</ul>
							</li>
							<li><a href="find-our-store.php"><?php echo $menutitle_res['title6']; ?></a></li>
							<li><a href="contact-us.php"><?php echo $menutitle_res['title7']; ?></a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>	
	<div class="search-main">
		<div class="container clearfix">
			<div class="row">
				<div class="col-12">
				<form name="search" method="post" action="search.php">
					<div class="search-group">
					<div class="form-div">
					<input type="text" class="form-control" placeholder="Search Your Product..." name="searchkeyword"><button type="submit" class="button">Search</button><a href="javascript:void(0);" class="close-search"> </a></div></div>
				</form>	
				</div>
			</div>
		</div>
	</div>
</header>
<a class="on-addtocart-btn locchange" href="javascript:void(0);" data-src="#addtocartpop" data-fancybox=""></a>
<div id="addtocartpop" class="popup-hidden animated-modal added-cart-model locchange">
	<p class="anim1"><strong id="country_title_alert">Added to Cart !!</strong></p>
	<p class="anim2"><a href="javascript:void(0);" onclick="$.fancybox.close();" class="button">OK</a></p>
</div>
<a class="on-addtocart-btn addddccaartt" href="javascript:void(0);" data-src="#addtocartpop" data-fancybox=""></a>
<div id="addtocartpop" class="popup-hidden animated-modal added-cart-model addddccaartt">
	<p class="anim1"><strong>Product added to Cart!!</strong></p>
	<p class="anim2"><a href="javascript:void(0);" onclick="$.fancybox.close();" class="button">OK</a></p>
</div>
<script>
$('#location').change(function() {
	var contryval = $('#location').val();

     $.ajax({
		type:"POST",
		data:"contryval="+contryval,
		url:"setcountrysession.php",
		success:function(data)
		{	
                    $("#country_title_alert").html("country changes to "+ data +" successfully");
        	$(".locchange").trigger("click");
    setTimeout(function(){ location.reload() }, 2000);

							
		}
	});
});


</script>

