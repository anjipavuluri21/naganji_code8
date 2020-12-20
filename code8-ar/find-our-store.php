<?php include "header.php"; ?>
<section class="innerpages">
	<div class="container clearfix">	
			<div class="row">							
				<div class="col-12 title-sort">
					<h1>Find Our <span>Store</span></h1>
					
				</div>												
				<?php							
				$store_que = "SELECT * from code8_stores where status=1 ORDER BY id ASC LIMIT 2";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($store_que);  
				$stmt1->execute();	
				$store_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				foreach($store_res as $store_result){
					$storeid = 	$store_result['id'];
				?>								
				<div class="col-lg-6 col-md-6 store-box">
					<div class="product-thumb gold-color-bg">
						<div class="product-holder-img"><img src="../<?php echo $store_result['image']; ?>" alt="products"></div>
						<div class="store-dtl">
							<h2><?php echo $store_result['titlear']; ?></h2>
							<p><?php echo $store_result['addressar']; ?></p>
							<p><?php echo $store_result['timingsar']; ?></p>
							<div class="store-btn-div"><a href="javascript:void(0);" class="button fancyIframe" data-src="<?php echo $store_result['mapsar']; ?>">Google Map Location</a></div>
						</div>
					</div>
				</div>				
				<?php } ?>							
				<div class="col-12 load-more" id="show_more_main<?php echo $storeid; ?>">
					<a id="<?php echo $storeid; ?>" href="javascript:void(0);" class="load-more-link">تحميل المزيد +</a>
				</div>
			<div class="tutorial_list col-12"></div>
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
            url:'ajax_more_stores.php',
            data:'id='+ID,
            success:function(html){
                $('#show_more_main'+ID).remove();
                $('.tutorial_list').append(html);
            }
        }); 
    });
});
</script>
<?php include "footer.php"; ?>