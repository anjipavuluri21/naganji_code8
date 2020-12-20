<?php include "header.php"; ?>
<?php 
$id = $_REQUEST['id'];
//Get Fashionista
$fashion_que = "SELECT * from code8_fashionistas where id='$id'";
$database1 = new Database();
$dbCon1 = $database1->getConnection();
$stmt1 = $dbCon1->prepare($fashion_que);  
$stmt1->execute();	
$fashion_res = $stmt1->fetch(PDO::FETCH_ASSOC);
?>
<section class="innerpages">
	<div class="container clearfix">
		<div class="row">
			<div class="col-12">
				<h1><?php echo $fashion_res['name']; ?></h1>
			</div>
			<div class="col-lg-6 col-md-6 noha-left-column">
				<div class="left-column">
					<a href="<?php echo $fashion_res['videolink']; ?>" data-fancybox class="video-link"><img src="<?php echo $fashion_res['image']; ?>" alt="<?php echo $fashion_res['name']; ?>"><span></span></a>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 noha-right-column">
				<div class="right-column">
					<h2><?php echo $fashion_res['title']; ?></h2>
					<?php echo $fashion_res['description']; ?>
				</div>
			</div>
			<div class="col-12 relative-main">
				<h3><?php echo $fashion_res['name']; ?> Products</h3>
				<div class="carousel-main">
					<div class="designer-container swiper-container">
						<div class="swiper-wrapper">
						<?php							
						$fashionprod_que = "SELECT * from code8_fashionistaprodimages where fashionistaid=$id ORDER BY id DESC";
						$database1 = new Database();
						$dbCon1 = $database1->getConnection();
						$stmt1 = $dbCon1->prepare($fashionprod_que);  
						$stmt1->execute();	
						$fashionprod_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
						foreach($fashionprod_res as $fashionprod_result){	
						?>
							<div class="swiper-slide designer-box">
								<div class="product-thumb">
									<div class="designer-img"><img src="<?php echo $fashionprod_result['prodimages']; ?>" alt="designer"></div>
								</div>
							</div>
						<?php } ?>	
						</div>
					</div>
					<div class="designer-button-next swiper-button-next"></div>
					<div class="designer-button-prev swiper-button-prev"></div>
				</div>
			</div>
			<div class="col-12 designer-text"><p>“<?php echo $fashion_res['comments']; ?>”</p></div>
			<div class="col-12 discovery-title">
				<a href="<?php echo $fashion_res['collectionlink']; ?>">
					<img src="<?php echo $fashion_res['collectionimage']; ?>" alt="products">
					<span><?php echo $fashion_res['collectiontitle']; ?></span>
				</a>
			</div>
			<div class="col-12 portfolio-designer">
				<h3>Other Designer & Portfolio</h3>
				<div class="row">
				<?php							
				$moreprod_que = "SELECT * from code8_fashionistas WHERE 1=1 ORDER BY id DESC LIMIT 3";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($moreprod_que);  
				$stmt1->execute();	
				$moreprod_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				foreach($moreprod_res as $moreprod_result){
					$fashionistaid = $moreprod_result['id'];
				?>
					<div class="col-lg-4 col-md-4 portfolio-box">
						<div class="portfolio-thumb">
							<div class="portfolio-holder"><a href="fashionista_page.php?id=<?php echo $moreprod_result['id']; ?>" class="portfolio-link"></a>
								<div class="portfolio-img"><img src="<?php echo $moreprod_result['image']; ?>" alt="products"></div>
								<h2><?php echo $moreprod_result['portfoliotitle']; ?></h2>	
							</div>
							<div class="portfolio-date-dsnr">
								<div class="date-uplaod"><?php echo $moreprod_result['date']; ?></div>
								<a href="fashionista_page.php?id=<?php echo $moreprod_result['id']; ?>" class="portfolio-maker"><?php echo $moreprod_result['name']; ?></a>
							</div>
						</div>
					</div>
				<?php } ?>
				</div>				
				<div id="tutorial_list"></div>
			</div>
			<div class="col-12 load-more" id="show_more_main<?php echo $fashionistaid; ?>">
				<a id="<?php echo $fashionistaid; ?>" href="javascript:void(0);" class="load-more-link">Load More +</a>
			</div>
				
		</div>
	</div>
</section>
<script>
$(document).ready(function(){
    $(document).on('click','.load-more-link',function(){
        var ID = $(this).attr('id');		
        $('.load-more-link').hide();
        $('.loding').show();
        $.ajax({
            type:'POST',
            url:"ajax_more_fashionistas.php",
            data:'id='+ID,
            success:function(html){
                $('#show_more_main'+ID).remove();
                $('#tutorial_list').append(html);
            }
        }); 
    });
});
</script>
<?php include "footer.php"; ?>
