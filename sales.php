<?php include "header.php"; ?>
<section class="innerpages">
	<div class="container clearfix">
		<div class="row">
			<?php include "filters.php"; ?>
			<div class="col-lg-12 col-md-12 searchprods"></div>
			<?php							
			$prod_que = "SELECT * from code8_products where status=1 AND sale=1 ORDER BY id DESC LIMIT 12";
			$database1 = new Database();
			$dbCon1 = $database1->getConnection();
			$stmt1 = $dbCon1->prepare($prod_que);  
			$stmt1->execute();	
			$rescount = $stmt1->rowCount();
			$prod_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
			if($rescount>0){
			foreach($prod_res as $prod_result){	
				$prodid = 	$prod_result['id'];
				//Get Product Price
				$proprice_que = "SELECT * from code8_prodprices where prodid='$prodid' AND country='$countryid'";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($proprice_que);  
				$stmt1->execute();	
				$proprice_res = $stmt1->fetch(PDO::FETCH_ASSOC);
				$sprod_price = $proprice_res['price'];
			?>
			<div class="col-lg-3 col-md-3 product-box collecnewin">
				<div class="product-thumb">
					<div class="product-holder-img"><a href="product-detail.php?id=<?php echo $prodid; ?>" class="pro-dt-btn"></a>
						<figure class="pro-img1"><img src="<?php echo $prod_result['thumimage1']; ?>" alt="products"></figure>
						<figure class="pro-img2"><img src="<?php echo $prod_result['thumimage2']; ?>" alt="products"></figure>
					</div>
					<div class="product-dtl">
						<div class="product-price-btn"><div class="product-price"><?php echo $sprod_price; ?> <?php echo $currencycode; ?></div></div>
						<h2><?php echo $prod_result['prodtitle']; ?></h2>
					</div>
					<?php if($_SESSION["SESS_CUSTOMER_ID"]!=""){ ?>	
					<!--<a id="moveto_<?php echo $prod_result['id'] ?>" href="javascript:void(0);" class="favrt-div" title="Favourite"><span><img src="images/favourite.png" alt="Favourite"></span></a>-->
					<script>
					$(function(){								
						$("[id^='moveto_']").click(function(){
						var i=$(this).attr('id');		
						var arr=i.split("_");
						var i=arr[1];	   	 		
						 $.ajax({
								type:"POST",
								data:"id="+i,
								url:"deleteprods.php?type=addtowishlist&userid=<?php echo $loginid; ?>&removeid=<?php echo $prod_result['id']; ?>",
								success:function(data)
								{				
									location.reload();				
								}
							});		
						});
					});
					</script>
					<?php } else { ?>
						<a href="javascript:void(0);" class="favrtlog-div wishlist" title="Favourite"><span><img src="images/favourite.png" alt="Favourite"></span></a>
					<?php } ?>					
				</div>
			</div>
			<?php } } else { ?>
			<div class="col-12 load-more" id="show_more_main<?php echo $prodid; ?>">
					<p>Results Not Found!!</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
			</div>
			<?php }	?>	
			<?php if($rescount>0){ ?>	
			<div class="col-12 load-more" id="show_more_main<?php echo $prodid; ?>">
				<a id="<?php echo $prodid; ?>" href="javascript:void(0);" class="load-more-link">Load More +</a>
			</div>
			<?php }	?>	
			<div class="tutorial_list col-12"></div>		
		</div>
	</div>
</section>
<?php include "footer.php"; ?>
<script>
$(document).ready(function(){
    $(document).on('click','.load-more-link',function(){
        var ID = $(this).attr('id');		
        $('.load-more-link').hide();
        $('.loding').show();
        $.ajax({
            type:'POST',
            url:"ajax_more_products_sales.php?mid=<?php echo $id; ?>",
            data:'id='+ID,
            success:function(html){
                $('#show_more_main'+ID).remove();
                $('.tutorial_list').append(html);
            }
        }); 
    });
});

$(".apply-filter").click(function(){
	var sortby 		= $("#sortby li a.active").attr('id');
	var colorsort 	= $("#colorsort li a.active").attr('id');
	var sizesort 	= $("#sizesort li a.active").attr('id');
	var seasonsort 	= $("#seasonsort li a.active").attr('id');
	$('.collecnewin').hide();
	$('.load-more-link').hide();
	//alert(seasonsort);
	$.ajax({
		type:"POST",
		data:"sortby="+sortby+"&colorsort="+colorsort+"&sizesort="+sizesort+"&seasonsort="+seasonsort,
		url:"slaesnewinsearch.php?mid=<?php echo $id; ?>",
		success:function(data)
		{				
			$('.searchprods').html(data);					
		}
	  });	
	return false;
});
</script>