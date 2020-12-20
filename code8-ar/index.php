<?php include "header.php"; ?>
<?php				

	$homepage_que = "SELECT * from code8_homepageheader where id=1";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($homepage_que);  
	$stmt1->execute();	
	$homepage_res = $stmt1->fetch(PDO::FETCH_ASSOC);			s
?>
<style>
.banner-main {
    background: url("../<?php echo $homepage_res['image']; ?>") left top no-repeat;
        background-position-x: left;
        background-position-y: top;
        background-attachment: scroll;
        background-size: auto;
    background-size: 100% auto;
}
</style>
<section class="banner-main parallaxcont">
	<div class="banner-text">
		<div class="container clearfix">
			<div class="row">
				<div class="col-12">
					<div class="banner-contents">
						<h1><?php echo $homepage_res['titlear']; ?></h1>
						<div class="wow fadeInRight" data-wow-delay="0.85s" data-wow-duration="1.5s">
						<p><?php echo $homepage_res['captionar']; ?></p></div>
						<div class="shop-now wow fadeInLeft" data-wow-delay="0.8s" data-wow-duration="1.5s"><a href="<?php echo $homepage_res['shopnowlink']; ?>" class="button">تسوق الآن</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php							
	$homepage_que1 = "SELECT * from code8_homepageheader where id=2";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($homepage_que1);  
	$stmt1->execute();	
	$homepage_res1 = $stmt1->fetch(PDO::FETCH_ASSOC);			
?>
<section class="section01">	
	<div class="linediv padding-192px-147px">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="views-field-main">
						<div class="views-field-div"><div class="views-field-img"><img src="../<?php echo $homepage_res1['image']; ?>" alt="image"></div></div>
						<div class="view-field-contents">
							<h3><?php echo $homepage_res1['titlear']; ?></h3>
							<p><?php echo $homepage_res1['captionar']; ?></p>
							<div class="read-more"><a href="<?php echo $homepage_res1['shopnowlink']; ?>">قراءة المزيد</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php							
	$homepagebody_que = "SELECT * from code8_homepagebody2 where id=1";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($homepagebody_que);  
	$stmt1->execute();	
	$homepagebody_res = $stmt1->fetch(PDO::FETCH_ASSOC);			
?>
<style>
.section02 {
    background: url("../<?php echo $homepagebody_res['bannerimage']; ?>") left bottom no-repeat;
        background-position-x: left;
        background-position-y: bottom;
        background-attachment: scroll;
        background-size: auto;
    background-size: 100% auto;
}
</style>
<section class="section02 parallaxcont">
	<div class="number-div">
		<div class="linediv">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="box-main">
							<div class="box-row">
								<div class="box">								 
								</div>
								<div class="box"><img src="../<?php echo $homepagebody_res['image']; ?>" alt="image"></div>
								<div class="box pink-box content-box"><svg id="Accessories" data-name="Accessories" xmlns="http://www.w3.org/2000/svg"><title><?php echo $homepagebody_res['title1']; ?></title><rect/></svg>
									<div class="box-div">
										<h3><?php echo $homepagebody_res['titlear1']; ?></h3>
										<div class="read-more"><a href="<?php echo $homepagebody_res['link1']; ?>">تسوق الآن</a></div>
									</div>	
								</div>
							</div>
							<div class="box-row">
								<div class="box purple-box content-box"><svg id="fragrance" data-name="fragrance" xmlns="http://www.w3.org/2000/svg"><title><?php echo $homepagebody_res['title3']; ?></title><rect/></svg>
									<div class="box-div">
										<h3><?php echo $homepagebody_res['titlear3']; ?></h3>
										<div class="read-more"><a href="<?php echo $homepagebody_res['link3']; ?>">تسوق الآن</a></div>
									</div>	
								</div>
								<div class="box gold-box content-box"><svg id="Bags" data-name="Bags" xmlns="http://www.w3.org/2000/svg"><title><?php echo $homepagebody_res['title2']; ?></title><rect/></svg>
									<div class="box-div">
										<h3><?php echo $homepagebody_res['titlear2']; ?></h3>
										<div class="read-more"><a href="<?php echo $homepagebody_res['link2']; ?>">تسوق الآن</a></div>
									</div>	
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
</section>
<?php							
	$fashionista_que = "SELECT * from code8_homepageheader where id=3";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($fashionista_que);  
	$stmt1->execute();	
	$fashionista_res = $stmt1->fetch(PDO::FETCH_ASSOC);			
?>
<style>
.section03 {
    background: url(../<?php echo $fashionista_res['image']; ?>) center top no-repeat;
    background-size: auto;
    background-size: 100% auto;
}
</style>
<section class="section03">
	<div class="number-div">
		<div class="linediv">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section03-content">
							<div class="section03-box">
								<h3><?php echo $fashionista_res['titlear']; ?></h3>
								<p><?php echo $fashionista_res['captionar']; ?></p>
								<div class="read-more"><a href="<?php echo $fashionista_res['shopnowlink']; ?>">عرض المزيد</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php							
				$trend_que = "SELECT * from code8_trendingsection where id=1";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($trend_que);  
				$stmt1->execute();	
				$trend_res = $stmt1->fetch(PDO::FETCH_ASSOC);			
			?>
			<div class="section03-round">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="section03-left">
								<h2><?php echo $trend_res['titlear']; ?></h2>
							</div>
							<div class="section03-right">
								<div class="round-main">
									<div class="round-img"><img src="../<?php echo $trend_res['image1']; ?>" alt="image"></div>
								</div>
								<div class="round-main">
									<div class="round-img"><img src="../<?php echo $trend_res['image2']; ?>" alt="image"></div>
								</div>								
								<div class="round-main">
									<div class="round-img"><img src="../<?php echo $trend_res['image3']; ?>" alt="image"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
</section>
<?php							
	$getlook_que = "SELECT * from code8_getthelook where id=1";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($getlook_que);  
	$stmt1->execute();	
	$getlook_res = $stmt1->fetch(PDO::FETCH_ASSOC);			
?>
<style>
.section04 {
    background: url("../<?php echo $getlook_res['image']; ?>") left bottom no-repeat;
        background-position-x: left;
        background-position-y: bottom;
        background-attachment: scroll;
        background-size: auto;
    background-size: 100% auto;
}
</style>
<section class="section04 parallaxcont">
	<div class="number-div">
		<div class="linediv">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="block-gallery">
							<h2><?php echo $getlook_res['titlear']; ?></h2>
							<?php echo $getlook_res['captionar']; ?>
							<div class="read-more"><a href="<?php echo $getlook_res['shopnowlink']; ?>">أكثر</a></div>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
</section>
<?php							
	$footercont_que = "SELECT * from code8_footercontent where id=1";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($footercont_que);  
	$stmt1->execute();	
	$footercont_res = $stmt1->fetch(PDO::FETCH_ASSOC);			
?>
<section class="news-main">
	<div class="shop-store">
		<div class="shop-img"><img src="../<?php echo $footercont_res['storeimage']; ?>" alt="shop"></div>
		<div class="view-our-shop"><a href="#storeModal" data-fancybox data-animation-duration="700"><?php echo $footercont_res['titlear']; ?></a></div>
	</div>
</section>
<?php include "footer.php"; ?>
