
<div class="col-12 title-sort">
	<?php
	if($pagename=='search.php'){
		$category_name = "Search Results";
	} else if($pagename=='brands.php'){
		$category_name = getBrand($id);
	} else if($pagename=='sales.php'){
		$category_name = "Products in <span>Sales</span>";
	} else if($pagename=='womens_newin.php'){
		$category_name = "Women <span>New In</span>";
	} else if($id!=""){
		$category_name = getCollectionsSubmenu($id);
	} else {
		$category_name = "Products <span>New In</span>";
	}
	?>
	<h1><?php echo $category_name; ?></h1>
	<ul class="sorting">
		<li><a href="javascript:void(0);" data-id="1">Sort By</a></li>
		<li><a href="javascript:void(0);" data-id="2">Color</a></li>
		<li><a href="javascript:void(0);" data-id="3">Size</a></li>
		<li><a href="javascript:void(0);" data-id="4">Season</a></li>
	</ul>
	<div class="sorting-main">
		<div class="sorting-div" id="ids1">
			<ul id="sortby" class="sorting-ul sort-by-ul">
				<li><a id="new" href="javascript:void(0);" title="New in">New in</a></li>
				<li><a id="asc" href="javascript:void(0);" title="Price Low to High">Price Low to High</a></li>
				<li><a id="desc" href="javascript:void(0);" title="Price High to Low">Price High to Low</a></li>
			</ul>
			<ul class="result-clearall">
				<li><span class="no-filter">No Filters Selected</span></li>
				<li><a href="javascript:void(0);" class="apply-filter">Apply</a> <a href="javascript:location.reload();" class="clearall">Clear All</a></li>
			</ul>
		</div>
		<div class="sorting-div" id="ids2">
			<ul id="colorsort" class="sorting-ul color-ul">
			<?php
			$i = 1;						
			$fil_color_que = "SELECT * from code8_colors where 1=1 ORDER BY id DESC";
			$database1 = new Database();
			$dbCon1 = $database1->getConnection();
			$stmt1 = $dbCon1->prepare($fil_color_que);  
			$stmt1->execute();	
			$fil_color_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
			foreach($fil_color_res as $fil_color_result)
			{				
			?>
				<li><a id="<?php echo $fil_color_result['id']; ?>" href="javascript:void(0);"><?php echo $fil_color_result['title']; ?></a></li>
			<?php } ?>	
			</ul>
			<ul class="result-clearall">
				<li><span class="no-filter">No Filters Selected</span></li>
				<li><a href="javascript:void(0);" class="apply-filter">Apply</a> <a href="javascript:location.reload();" class="clearall">Clear All</a></li>
			</ul>
		</div>
		<div class="sorting-div" id="ids3">
			<ul id="sizesort" class="sorting-ul size">
				<?php								
				$fil_size_que = "SELECT * from code8_sizes where 1=1 ORDER BY id DESC";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($fil_size_que);  
				$stmt1->execute();	
				$fil_size_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				foreach($fil_size_res as $fil_size_result)
				{				
				?>
					<li><a id="<?php echo $fil_size_result['id']; ?>" href="javascript:void(0);"><?php echo $fil_size_result['title']; ?></a></li>
				<?php } ?>	
			</ul>
			<ul class="result-clearall">
				<li><span class="no-filter">No Filters Selected</span></li>
				<li><a href="javascript:void(0);" class="apply-filter">Apply</a> <a href="javascript:location.reload();" class="clearall">Clear All</a></li>
			</ul>
		</div>
		<div class="sorting-div" id="ids4">
			<ul id="seasonsort" class="sorting-ul season">
			<?php								
			$fil_sea_que = "SELECT * from code8_seasons where 1=1 ORDER BY id DESC";
			$database1 = new Database();
			$dbCon1 = $database1->getConnection();
			$stmt1 = $dbCon1->prepare($fil_sea_que);  
			$stmt1->execute();	
			$fil_sea_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
			foreach($fil_sea_res as $fil_sea_result)
			{				
			?>
				<li><a id="<?php echo $fil_sea_result['id']; ?>" href="javascript:void(0);"><?php echo $fil_sea_result['title']; ?></a></li>
			<?php } ?>	
			</ul>
			<ul class="result-clearall">
				<li><span class="no-filter">No Filters Selected</span></li>
				<li><a href="javascript:void(0);" class="apply-filter">Apply</a> <a href="javascript:location.reload();" class="clearall">Clear All</a></li>
			</ul>
		</div>
	</div>
</div>
