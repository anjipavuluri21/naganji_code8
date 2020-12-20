<?php ob_start(); ?>
<?php include "header.php"; ?>
<?php
$id = $_REQUEST['id'];
$prodet_que = "SELECT * from code8_products where id=$id AND status=1";
$database1 = new Database();
$dbCon1 = $database1->getConnection();
$stmt1 = $dbCon1->prepare($prodet_que);
$stmt1->execute();
$prodet_res = $stmt1->fetch(PDO::FETCH_ASSOC);
$subcat = $prodet_res['subcat'];

//Get Product Price
$proprice_que = "SELECT * from code8_prodprices where prodid='$id' AND country='$countryid'";
$database1 = new Database();
$dbCon1 = $database1->getConnection();
$stmt1 = $dbCon1->prepare($proprice_que);
$stmt1->execute();
$proprice_res = $stmt1->fetch(PDO::FETCH_ASSOC);
$prod_price = $proprice_res['price'];

//Get Tax & Shipping Price
$tax_que = "SELECT * from code8_taxesandshipping where country='$countryid'";
$database1 = new Database();
$dbCon1 = $database1->getConnection();
$stmt1 = $dbCon1->prepare($tax_que);
$stmt1->execute();
$tax_res = $stmt1->fetch(PDO::FETCH_ASSOC);
$tax_price = $tax_res['taxes'];
$ship_price = $tax_res['shipping'];

$pid = $_REQUEST['id'];
//Get Customer Details	
$cust_query = "SELECT * FROM code8_customers WHERE id='$loginid' AND status=1";
$database1 = new Database();
$dbCon1 = $database1->getConnection();
$stmt1 = $dbCon1->prepare($cust_query);
$stmt1->execute();
$cust_res = $stmt1->fetch(PDO::FETCH_ASSOC);

//Get Stock Details	
$fullstockquery = "SELECT sum(quantity) as totstock FROM code8_stocks WHERE prodid='$pid'";
$database1 = new Database();
$dbCon1 = $database1->getConnection();
$stmt1 = $dbCon1->prepare($fullstockquery);
$stmt1->execute();
$fullstocks = $stmt1->fetch(PDO::FETCH_ASSOC);
$fullstocks['totstock'];
if ($fullstocks['totstock'] == "") {
    $totstockqty = 0;
} else {
    $totstockqty = $fullstocks['totstock'];
}

//Get Available Stock Details	
$availstockquery = "SELECT sum(quantity) as totsum FROM code8_cartproducts WHERE prodid='$pid' AND status='2'";
$database1 = new Database();
$dbCon1 = $database1->getConnection();
$stmt1 = $dbCon1->prepare($availstockquery);
$stmt1->execute();
$fullstockres = $stmt1->fetch(PDO::FETCH_ASSOC);
$totqty = $fullstockres['totsum'];

//Add product to Cart
if (isset($_POST['submitaddtocart'])) {
//    include "addtocart.php";
    //user session ID
    $loginid = $_SESSION['SESS_CUSTOMER_ID'];
    if ($loginid != "") {
        include 'auth.php';
    }
    if (isset($_COOKIE['guestid'])) {
        $cookieguestid = $_COOKIE['guestid'];
    }

    $size = $_POST['selsize'];
    $color = $_POST['colorcode'];
    $qty = $_POST['quantity'];
    $tax_price = $_POST['tax_price'];
    $ship_price = $_POST['ship_price'];
    $colorname = getColor($color);
    $sizename = getSize($size);

    if ($_REQUEST['id'] != "") {

        if (($totstockqty == "0") && ($qty > $totstockqty)) {
            echo '<a class="nostock"></a>';
            echo '<script> $(document).ready(function(){ $(".nostock"); });</script>';
        } else {
            if ($loginid != "") {
                //echo "1"; die;
                $pid = $_REQUEST['id'];
                $guest_query2 = "SELECT * FROM code8_cart WHERE customerid=$loginid AND prodid='$pid' AND status=1";
                $database1 = new Database();
                $dbCon1 = $database1->getConnection();
                $stmt1 = $dbCon1->prepare($guest_query2);
                $stmt1->execute();
                $guest_res2 = $stmt1->fetch(PDO::FETCH_ASSOC);
                $DBcustomer = $guest_res2['customerid'];
                $qtyid2 = $guest_res2['quantity'];
                $incqty2 = $qtyid2 + $qty;
                $Dbprodid2 = $guest_res2['prodid'];
                $cacolor = $guest_res2['color'];
                $csize = $guest_res2['size'];

                if ($pid == $Dbprodid2 && $color == $cacolor && $size == $csize) {
                    $updatecartquery = "UPDATE code8_cart SET `quantity`='$incqty2' WHERE customerid='$loginid' AND prodid='$pid' AND status=1";
                    $database1 = new Database();
                    $dbCon1 = $database1->getConnection();
                    $stmt1 = $dbCon1->prepare($updatecartquery);
                    $stmt1->execute();

                    $updatecartprodquery = "UPDATE code8_cartproducts SET `quantity`='$incqty2' WHERE customerid='$loginid' AND prodid='$pid' AND status=1";
                    $database1 = new Database();
                    $dbCon1 = $database1->getConnection();
                    $stmt1 = $dbCon1->prepare($updatecartprodquery);
                    $stmt1->execute();
                } else {
                    $addcartquery = "INSERT INTO code8_cart (`id`,`customerid`,`guestid`,`prodid`,`size`,`color`,`sizename`,`colorname`,`quantity`,`currencycode`,`status`,`date`,`price`,`tax`,`shipping`) VALUES ('','$loginid','$cookieguestid','$pid','$size','$color','$sizename','$colorname','$qty','$currencycode','1',NOW(),'$prod_price','$tax_price','$ship_price')";
                    $database1 = new Database();
                    $dbCon1 = $database1->getConnection();
                    $stmt1 = $dbCon1->prepare($addcartquery);
                    $stmt1->execute();
                    $lastinsid = $dbCon1->lastInsertId();

                    $prod_res = getProductData($pid);
                    $prodname = $prod_res['prodtitle'];
                    $color_name = getColor($cacolor);
                    $size_name = getSize($csize);

                    $addcartquery = "INSERT INTO code8_cartproducts (`id`,`cartid`,`customerid`,`guestid`,`prodid`,`prodname`,`sizeid`,`colorid`,`sizename`,`colorname`,`quantity`,`currencycode`,`status`,`date`,`product_price`,`tax`,`shipping`) VALUES ('','$lastinsid','$loginid','$cookieguestid ','$pid','$prodname','$size','$color','$sizename','$colorname','$qty','$currencycode','1',NOW(),'$prod_price','$tax_price','$ship_price')";
                    $database1 = new Database();
                    $dbCon1 = $database1->getConnection();
                    $stmt1 = $dbCon1->prepare($addcartquery);
                    $stmt1->execute();
                }
            } else if (!isset($_COOKIE['guestid'])) {
                //echo "2"; die;				
                $guestquery = "INSERT INTO code8_guest (`id`,`date`) VALUES ('',NOW())";
                $database1 = new Database();
                $dbCon1 = $database1->getConnection();
                $stmt1 = $dbCon1->prepare($guestquery);
                $stmt1->execute();
                $guestid = $dbCon1->lastInsertId();

                setcookie('guestid', $guestid);
                setcookie('guestid', $guestid, time() + (86400));
                $cookieguestid = $guestid;

                $inscartquery = "INSERT INTO code8_cart (`id`,`customerid`,`guestid`,`prodid`,`size`,`color`,`quantity`,`currencycode`,`status`,`date`) VALUES ('','0','$cookieguestid ','$pid','$size','$color','$qty','$currencycode','1',NOW())";
                $database1 = new Database();
                $dbCon1 = $database1->getConnection();
                $stmt1 = $dbCon1->prepare($inscartquery);
                $stmt1->execute();
            } else {
                //echo "3"; die;
                $ginscartquery = "SELECT * FROM code8_cart WHERE guestid=$cookieguestid AND prodid='$pid' AND status=1";
                $database1 = new Database();
                $dbCon1 = $database1->getConnection();
                $stmt1 = $dbCon1->prepare($ginscartquery);
                $stmt1->execute();
                $guest_res = $stmt1->fetch(PDO::FETCH_ASSOC);
                $DBguestid = $guest_res['guestid'];
                $qtyid = $guest_res['quantity'];
                $cacolor = $guest_res['color'];
                $csize = $guest_res['size'];
                $incqty = $qtyid + $qty;
                $Dbprodid = $guest_res['prodid'];

                if ($pid == $Dbprodid && $cookieguestid == $DBguestid && $color == $cacolor && $size == $csize) {
                    $cginscartquery = "UPDATE code8_cart SET `quantity`='$incqty' WHERE guestid='$cookieguestid' AND prodid='$pid' AND color=$color AND size=$size AND status=1";
                    $database1 = new Database();
                    $dbCon1 = $database1->getConnection();
                    $stmt1 = $dbCon1->prepare($cginscartquery);
                    $stmt1->execute();
                } else {
                    $inscartquery = "INSERT INTO code8_cart (`id`,`customerid`,`guestid`,`prodid`,`size`,`color`,`quantity`,`currencycode`,`status`,`date`) VALUES ('','0','$cookieguestid ','$pid','$size','$color','$qty','$currencycode','1',NOW())";
                    $database1 = new Database();
                    $dbCon1 = $database1->getConnection();
                    $stmt1 = $dbCon1->prepare($inscartquery);
                    $stmt1->execute();
                }
            }
            if ($loginid == "") {
                $countcart_que = "SELECT count(*) as cartcount from code8_cart where status=1 AND guestid=$guestid";
            } else {
                $countcart_que = "SELECT count(*) as cartcount from code8_cart where status=1 AND customerid=$loginid";
            }
            $database1 = new Database();
            $dbCon1 = $database1->getConnection();
            $stmt1 = $dbCon1->prepare($countcart_que);
            $stmt1->execute();
            $countcart_res = $stmt1->fetch(PDO::FETCH_ASSOC);
            echo '<a class="addtocart"></a>';
            echo '<script> $(document).ready(function(){ $("#cart_count").html('.$countcart_res['cartcount'].');$(".addtocart").trigger("click");});</script>';
        }
    }
}
?>
<section class="innerpages">
    <div class="container clearfix">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="product-gallery">
                    <div class="carousel-main">
                            <!--<div class="main-img"><img src="<?php echo $prodet_res['thumimage1']; ?>" alt="Product"/></div>-->
                        <div class="product-container swiper-container">
                            <div class="swiper-wrapper">
                                <?php
                                $prodimg_que = "SELECT * from code8_prodimages where prodid=$id ORDER BY id DESC";
                                $database1 = new Database();
                                $dbCon1 = $database1->getConnection();
                                $stmt1 = $dbCon1->prepare($prodimg_que);
                                $stmt1->execute();
                                $res12 = $stmt1->rowCount();
                                $prodimg_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($prodimg_res as $proding_res) {
                                    $extension1 = strtolower(pathinfo($proding_res['image'], PATHINFO_EXTENSION));
                                    ?>
                                    <div class="swiper-slide">
                                        <div class="product-img <?php if ($extension1 == 'mp4') {
                                    echo "video-div";
                                } ?>" data-fancybox="product" data-src="../<?php echo $proding_res['image']; ?>">
                                            <?php if ($extension1 != 'mp4') { ?>
                                                <img src="../<?php echo $proding_res['image']; ?>" alt="Product"/>
    <?php } else { ?>
                                                <video id="myVideo<?php echo $proding_res['id']; ?>" controls>
                                                    <source src="../<?php echo $proding_res['image']; ?>" type="video/mp4">
                                                    <source src="../<?php echo $proding_res['image']; ?>" type="video/ogg">
                                                    Your browser does not support the video tag.
                                                </video>
    <?php } ?>
                                        </div>
                                    </div>
<?php } ?>		
                            </div>
                        </div>
                        <div class="product-button-next swiper-button-next"></div>
                        <div class="product-button-prev swiper-button-prev"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="product-detail">
                    <div class="product-detail-sub">
                        <form name="addtocartinprods" id="addtocartinprods" method="post" action=""  onsubmit="return checkValidation();">
                            <input type="hidden" name="prodid" value="<?php echo $id; ?>">
                            <input type="hidden" name="tax_price" value="<?php echo $tax_price; ?>">
                            <input type="hidden" name="ship_price" value="<?php echo $ship_price; ?>">
                            <h2><?php echo $prodet_res['prodtitle'] . $guestid; ?></h2>
                            <?php if ($totstockqty == 0) { ?>
                                <p style="color:red"><strong><img src="images/close.png" height="25px" width="25px" alt="Outofstock" style="margin-top: -5px;"> نفذت الكمية!</strong></p>
<?php } ?>
                            <div class="carousel-main" id="sizeSection">
                                <p><a href="javascript:void(0);" class="size-heading">بحجم</a></p>
                                <div class="size-alert"><span class="alert-danger"><strong>!</strong> الرجاء تحديد الحجم</span></div>
                                <div class="carousel-sub size-carousel">
                                    <div class="size-content-div">
                                        <div class="size-container swiper-container size-link-div">
                                            <input type="hidden" name="selsize" id="selsize">
                                            <div class="swiper-wrapper">
                                                <?php
                                                $size_que = "SELECT * from code8_prodcombinations where prodid=$id GROUP BY sizes";
                                                $database1 = new Database();
                                                $dbCon1 = $database1->getConnection();
                                                $stmt1 = $dbCon1->prepare($size_que);
                                                $stmt1->execute();
                                                $size_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($size_res as $size_result) {
                                                    ?>
                                                    <div class="swiper-slide">		
                                                        <a name="size" id="<?php echo $size_result['sizes']; ?>" href="#" class="size-link"><span><?php echo getSize($size_result['sizes']); ?></span></a>
                                                    </div>										
<?php } ?>
                                            </div>
                                        </div>
                                    </div>	
                                    <div class="size-button-next swiper-button-next"></div>
                                    <div class="size-button-prev swiper-button-prev"></div>
                                </div>
                                <div class="size-guide-div"><a href="#sizeModal" data-fancybox class="size-guide-link">رابط إلى دليل المقاسات</a></div>
                            </div>
                            <div class="carousel-main">
                                <p class="font-size-15">اللون</p>
                                <div class="color-alert"><span class="alert-danger"><strong>!</strong> اختر لونا من فضلك</span></div>
                                <div class="carousel-sub color-select">
                                    <ul class="unstyled color-radios">
                                        <?php
                                        $color_que = "SELECT * from code8_prodcombinations where prodid=$id GROUP BY colors";
                                        $database1 = new Database();
                                        $dbCon1 = $database1->getConnection();
                                        $stmt1 = $dbCon1->prepare($color_que);
                                        $stmt1->execute();
                                        $color_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($color_res as $color_result) {
                                            $color_data = getColorData($color_result['colors']);
                                            if ($color_data['title'] == 'White') {
                                                ?>
                                                <style>
                                                    .color-radios li.white .styled-checkbox + label:before{background:#fff;box-shadow:0 0 0 1px #ccc;}
                                                    .color-radios li.white .styled-checkbox:hover + label:before{background:#fff;box-shadow:0 0 0 1px #ccc;}
                                                    .color-radios li.white .styled-checkbox:focus + label:before{box-shadow:0 0 0 1px #fff;}
                                                    .color-radios li.white .styled-checkbox:checked + label:before{background:#fff;box-shadow:0 0 0 1px #ccc;}
                                                    .color-radios li.white .styled-checkbox:checked + label:after{color:#000;box-shadow:0 0 0 1px #fff;}
                                                </style>
    <?php } else { ?>
                                                <style>
                                                    .color-radios li.<?php echo $color_data['title']; ?> .styled-checkbox + label:before{background:<?php echo $color_data['code']; ?>;box-shadow:0 0 0 1px <?php echo $color_data['code']; ?>;}
                                                    .color-radios li.<?php echo $color_data['title']; ?> .styled-checkbox:hover + label:before{background:<?php echo $color_data['code']; ?>;box-shadow:0 0 0 1px <?php echo $color_data['code']; ?>;}
                                                    .color-radios li.<?php echo $color_data['title']; ?> .styled-checkbox:focus + label:before{box-shadow:0 0 0 1px <?php echo $color_data['code']; ?>;}
                                                    .color-radios li.<?php echo $color_data['title']; ?> .styled-checkbox:checked + label:before{background:<?php echo $color_data['code']; ?>;box-shadow:0 0 0 1px <?php echo $color_data['code']; ?>;}
                                                </style>
    <?php } ?>
                                            <li class="<?php echo getColor($color_result['colors']); ?>">
                                                <input class="styled-checkbox" id="<?php echo getColor($color_result['colors']); ?>" name="colorcode" type="radio" value="<?php echo ($color_result['colors']); ?>">
                                                <label for="<?php echo getColor($color_result['colors']); ?>"><span><?php echo getColor($color_result['colors']); ?></span></label>
                                            </li>
<?php } ?>														
                                    </ul>
                                </div>
                            </div>
                            <div class="carousel-main">
                                <p class="font-size-15">الكمية</p>
                                <div class="carousel-sub quantity-select">
                                    <div class="my-cart-ul-dtl">
                                        <div class="quantity-control-div plus-minus">
                                            <a href="javascript:void(0);" class="minus-btn minusBtn">-</a>
                                            <div class="quantity-control"><input type="text" class="form-control noValue" name="quantity" value="1"></div>
                                            <a href="javascript:void(0);" class="plus-btn plusBtn">+</a>
                                        </div></div>
                                </div>
                            </div>
                            <div class="pricekd-favourite">
                                <span class="pricekd"><?php echo $prod_price; ?> <?php echo $currencycode; ?></span> 

                            </div>

                            <div class="addtocart-detail">
                                <div class="addtocart-div mb-3">							
                                    <button <?php /* if($totstockqty==0){ ?> disabled <?php } onclick="return checkValidation();" */ ?> class="button"  value="Add to Cart"  type="submit" name="submitaddtocart">أضف إلى العربة</button>
                                    <a href="javascript:void(0);" class="addedToCartSuccessfully" data-src="#addedCartModel" data-fancybox></a>
                                </div>
                                <div class="pricekd-favourite">
                                    <?php if ($_SESSION["SESS_CUSTOMER_ID"] != "") { ?>	
                                        <a id="movetowish_<?php echo $id; ?>" href="javascript:void(0);" class="wishlist-link button" title="Favourite"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23.82 20.79"><defs></defs><title>قائمة الرغبات</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_2-2" data-name="Layer 2"><path class="cls-1" d="M10,1.68S2.38-.76,1.09,6.26C0,12.36,9.4,18.87,12,19.73c2.29-.86,9.74-6,10.6-10.6,1.72-6.59-6.3-11.75-11.17-4.87"/></g></g></svg> قائمة الرغبات</a>
                                    <?php } else { ?>
                                        <a data-src="#wishlistlogpop" data-fancybox="" href="javascript:void(0);" class="button" title="Favourite"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23.82 20.79"><defs></defs><title>قائمة الرغبات</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_2-2" data-name="Layer 2"><path class="cls-1" d="M10,1.68S2.38-.76,1.09,6.26C0,12.36,9.4,18.87,12,19.73c2.29-.86,9.74-6,10.6-10.6,1.72-6.59-6.3-11.75-11.17-4.87"/></g></g></svg> قائمة الرغبات</a>
<?php } ?>	
                                </div>	
                                <ul class="detail-product-more">
                                    <li>
                                        <a href="javascript:void(0);" class="dtl-btn">المزيد من التفاصيل <span></span></a>
                                        <div class="more-detail">
<?php echo $prodet_res['description']; ?>
                                            <div class="product-sub-dtl">
                                                <p>Product code: <?php echo $prodet_res['prodcode']; ?></p>
                                                <p>Composition: <?php echo $prodet_res['composition']; ?>.</p>
                                            </div>
                                            <div class="sub-title">SIZE & FIT</div>
                                            <div class="product-sub-dtl">
<?php echo $prodet_res['sizeandfit']; ?>
                                            </div>
                                            <div class="sub-title">OTHER</div>
                                            <div class="product-sub-dtl">
<?php echo $prodet_res['other']; ?>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                    $help_que = "SELECT * from code8_helpcontent where id=1";
                                    $database1 = new Database();
                                    $dbCon1 = $database1->getConnection();
                                    $stmt1 = $dbCon1->prepare($help_que);
                                    $stmt1->execute();
                                    $help_res = $stmt1->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <li>
                                        <a href="javascript:void(0);" class="dtl-btn"><?php echo $help_res['titlear']; ?><span></span></a>
                                        <div class="more-detail">
<?php echo $help_res['contentar']; ?>
                                            <div class="contact-links">
                                                <div class="contact-lt"><a href="tel:<?php echo $help_res['callus']; ?>"><img src="images/icon-phone.svg" alt="phone"/> <span>Call</span></a></div>
                                                <div class="contact-rt"><a href="mailto:<?php echo $help_res['email']; ?>"><img src="images/icon-email.svg" alt="email"/> <span>Email</span></a></div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="dtl-btn">التسليم والإرجاع<span></span></a>
                                        <div class="more-detail">
                                            <table cellpadding="0" cellspacing="0" border="0" class="size-guide-table">
                                                <?php
                                                $del_que = "SELECT * from code8_deliveryterms where id!=1 ORDER BY id DESC";
                                                $database1 = new Database();
                                                $dbCon1 = $database1->getConnection();
                                                $stmt1 = $dbCon1->prepare($del_que);
                                                $stmt1->execute();
                                                $del_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($del_res as $del_result) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $del_result['termcondition']; ?></td>
                                                        <td><?php echo $del_result['charge']; ?></td>
                                                    </tr>
                                            <?php } ?>
                                            </table>
                                            <?php
                                            $del_que1 = "SELECT * from code8_deliveryterms where id=1";
                                            $database1 = new Database();
                                            $dbCon1 = $database1->getConnection();
                                            $stmt1 = $dbCon1->prepare($del_que1);
                                            $stmt1->execute();
                                            $del_res1 = $stmt1->fetch(PDO::FETCH_ASSOC);
                                            ?>
                                            <p><?php echo $del_res1['termcondition']; ?></p>
                                        </div>
                                    </li>
                                    <li><a href="#storeModal" data-fancybox data-animation-duration="700" class="find-in-store-btn">البحث في المتجر<span></span></a></li>
                                </ul>
                            </div>	
                        </form>
                    </div>
                </div>
            </div>
            <!--</form>-->
            <div class="col-12 relative-main">
                <h4>منتجات مماثلة</h4>
                <div class="carousel-main">
                    <div class="relative-container swiper-container">
                        <div class="swiper-wrapper">
                            <?php
                            $prod_que = "SELECT * from code8_products where subcat=$subcat AND status=1 ORDER BY id DESC LIMIT 10";
                            $database1 = new Database();
                            $dbCon1 = $database1->getConnection();
                            $stmt1 = $dbCon1->prepare($prod_que);
                            $stmt1->execute();
                            $prod_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($prod_res as $prod_result) {
                                $prodid = $prod_result['id'];
                                //Get Product Price
                                $proprice_que = "SELECT * from code8_prodprices where prodid='$prodid' AND country='$countryid'";
                                $database1 = new Database();
                                $dbCon1 = $database1->getConnection();
                                $stmt1 = $dbCon1->prepare($proprice_que);
                                $stmt1->execute();
                                $proprice_res = $stmt1->fetch(PDO::FETCH_ASSOC);
                                $sprod_price = $proprice_res['price'];
                                ?>
                                <div class="swiper-slide product-box">
                                    <div class="product-thumb">
                                        <div class="product-holder-img"><a href="product-detail.php?id=<?php echo $prod_result['id']; ?>" class="pro-dt-btn"></a>
                                            <figure class="pro-img1"><img src="../<?php echo $prod_result['thumimage1']; ?>" alt="products"></figure>
                                            <figure class="pro-img2"><img src="../<?php echo $prod_result['thumimage2']; ?>" alt="products"></figure>
                                        </div>
                                        <div class="product-dtl">
                                            <div class="product-price-btn">
                                                <div class="product-price"><?php echo $sprod_price; ?> <?php echo $currencycode; ?></div>
                                                <div class="favrt-sub">
    <?php if ($_SESSION["SESS_CUSTOMER_ID"] != "") { ?>
                                                        <a id="moveto_<?php echo $prod_result['id'] ?>" href="javascript:void(0);" class="favrt-div" title="Favourite">WISHLIST <span><img src="images/favourite.png" alt="Favourite"></span></a>
                                                        <script>
                                                            $(function () {
                                                                $("[id^='moveto_']").click(function () {
                                                                    var i = $(this).attr('id');
                                                                    var arr = i.split("_");
                                                                    var i = arr[1];
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        data: "id=" + i,
                                                                        url: "deleteprods.php?type=addtowishlist&userid=<?php echo $loginid; ?>&removeid=<?php echo $prod_result['id']; ?>",
                                                                        success: function (data)
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
                                            <h2><?php echo $prod_result['prodtitle']; ?></h2>
                                        </div>
                                    </div>
                                </div>
<?php } ?>
                        </div>
                    </div>
                    <div class="relative-button-next swiper-button-next"></div>
                    <div class="relative-button-prev swiper-button-prev"></div>
                </div>
            </div>	
        </div>
    </div>
</section>

<a class="on-addtocart-btn prodcombnotavail" href="javascript:void(0);" data-src="#prodcombnotavail" data-fancybox=""></a>
<div id="prodcombnotavail" class="popup-hidden animated-modal added-cart-model prodcombnotavail">
    <p class="anim1"><strong>مجموعة المنتج ليست متوفرة في المخزون</strong></p>
    <p class="anim2"><a href="javascript:void(0);" onclick="$.fancybox.close();" class="button">OK</a></p>
</div>

<script>//
    $(".addtocart").load("click", function () {
//        $(".addddccaartt").trigger("click");

//        swal("تمت إضافة المنتج إلى عربة التسوق
//!!!", "", "success");
//        var delay = 2000;
//        var url = 'product-detail.php?id=<?php echo $id; ?>';
//        setTimeout(function () {
//            window.location = url; }, delay);
//        return false;
    });
</script>

<script>
    $(function () {
        $('.size-link').click(function () {
            var selsize = $(this).attr('id');
            $('#selsize').val(selsize);
        });
    });
</script>
<script>
    function checkValidation() {
        console.log('hi');
        var valsize = $('#selsize').val();
        var colorcode = $("input[name=colorcode]:checked").length;
        if (valsize == "") {
            $('.size-carousel').slideDown();
            sizeSliderOpen();
            sizeAlertOpen();
            goToSection('sizeSection');
            //swal("يرجى تحديد الحجم
//!", "", "warning");
            return false;
        } else if (colorcode == 0) {
            $('.color-alert').slideDown();
            //swal("الرجاء اختيار اللون
//!", "", "warning");		
            return false;
        }
//	else {			
//		var colorcodea = $("input[name=colorcode]:checked").val();	
//		var quantity  = $("input[name=quantity]").val();		
//		$.ajax({
//			type:'POST',
//			url:"checkstock.php?size="+valsize+"&color="+colorcodea,
//			data:'id=<?php echo $id ?>',
////			success:function(data){
////                            if(data == 0) {
////		//swal("Product combination is not available in Stock!", "", "warning");
////		$(".prodcombnotavail").trigger("click");
////		return false;
////	}else{
////                        		$(".addddccaartt").trigger("click");
////		document.getElementById('addtocartinprods').submit();		
////
////        }
//                        }	
//		});		
//		return false;
//	}	
    }
    function mycounthere(returndata) {
        if (returndata == 0) {
            //swal("Product combination is not available in Stock!", "", "warning");
            $(".prodcombnotavail").trigger("click");
            return false;
        } else {
            $(".addddccaartt").trigger("click");

            document.getElementById('addtocartinprods').submit();
        }
    }

</script>
<?php include "footer.php"; ?>