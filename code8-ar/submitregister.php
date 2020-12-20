<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="fancybox-master/jquery.fancybox.min.css" />
<?php
ob_start();
//session_sstart();
//include "connectionpdo.php";
//include "functions.php";
//include "PHPMailer.php";
//include "class.smtp.php"; 
//User Login ID
$guestid = $_COOKIE['guestid'];
$loginid = $_SESSION['SESS_CUSTOMER_ID'];

//Get the current path
$url = $_SERVER['REQUEST_URI']; 
$parts = explode('/',$url);
$currentpath = $_SERVER['SERVER_NAME'];
for ($i = 0; $i < count($parts) - 1; $i++) {
 $currentpath .= $parts[$i] . "/";
}
$schema = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
$urlpath = $schema.$currentpath;

if(isset($_POST['register'])){	
//    print_r($_POST).exit;
	$fullname 	= filter_var($_POST['fullname'], FILTER_SANITIZE_STRING);
	$mobile 	= filter_var($_POST['mobile'], FILTER_SANITIZE_STRING);
	$emailid 	= filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	$password 	= ($_POST['password']);
	$cpassword	= ($_POST['cpassword']);		
	$newpass 	= (md5($password));	
						
	$checkquery = "SELECT * from code8_customers where email='$emailid' OR mobile='$mobile'";
	$database1 = new Database();
	$dbCon = $database1->getConnection();
	$stmt = $dbCon->prepare($checkquery);  
	$stmt->execute();	
	$checkres = $stmt->fetch(PDO::FETCH_ASSOC);
//        print_r($checkres).exit;
	if($checkres['email'] == $emailid || $checkres['mobile']==$mobile)
	{			
		echo '<a class="useralreadyexist"></a>';	
		echo '<script> $(document).ready(function(){ $(".useralreadyexist").trigger("click"); });</script>';
		echo '<a class="on-addtocart-btn useralreadyexist" href="javascript:void(0);" data-src="#useralreadyexist" data-fancybox=""></a>';
		
	} else {		
		if($password == $cpassword){
			
			$regquery = "INSERT INTO code8_customers (fullname, email, mobile, password, secretcode, status, registereddate, customertype) VALUES ('$fullname','$emailid','$mobile','$newpass','$password',0,NOW(),2)";
			$database1 = new Database();
			$dbCon1 = $database1->getConnection();
			$stmt1 = $dbCon1->prepare($regquery);  
			$stmt1->execute();	
                        $regstatus = $stmt1->rowCount();
			$last_id = $dbCon1->lastInsertId();
                        
			
			//Insert Address
			$regquery = "INSERT INTO code8_customeraddresses (custid) VALUES ('$last_id')";
			$database1 = new Database();
			$dbCon1 = $database1->getConnection();
			$stmt1 = $dbCon1->prepare($regquery);  
			$stmt1->execute();				
			$regstatus = $stmt1->rowCount();
			$encrypted = my_simple_crypt($last_id, 'e');
				
			$mail = new PHPMailer;					 
			$mail->SMTPDebug = 3;
			$mail->isSMTP();			                   
			$mail->Host = "smtp.gmail.com";			
			$mail->SMTPAuth = true;
			$mail->Username = "code8.ecom@gmail.com";  
			$mail->Password = "code8@code8";
			$mail->SMTPSecure = "tls";
			$mail->Port = 587;
			$mail->From = "code8.ecom@gmail.com";
			$mail->FromName = "Code8 e-commerce website";
			$mail->addAddress($emailid, $fullname);
			$mail->isHTML(true);
			$mail->Subject = "Code8 e-commerce website - Account activation mail";
			$mail->Body = '<html>
			<head>
			<meta charset="utf-8">
			<title>Code8 e-commerce website</title>
			<style type="text/css">
				a:hover{background:#ac5e2a!important;border:1px solid #ac5e2a!important }
			</style>
			</head>

			<body style="margin: 0px;padding: 0px">
			<table cellpadding="0" cellspacing="0" border="0">
				<tr><td style="padding: 25px;background:#eee ">
			<table cellpadding="0" cellspacing="0" border="0" style="background: #ffffff">
				<tr>
					<td style="padding:10px 20px;"><div style="border-bottom:1px solid #d1b555;padding-bottom:15px "><img src="'.$urlpath.'/images/logo.png" width="177" height="130" alt="Code8" /></div></td>
				</tr>
				<tr>
					<td style="-moz-hyphens: none;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;word-break: break-word;-webkit-hyphens: none;-ms-text-size-adjust: 100%;hyphens: none;font-family:Open Sans,Arial,Helvetica,sans-serif;font-size:20px;line-height: 25px;color: #000;border-collapse: collapse;padding: 15px;padding:10px 20px">Welcome to Code8</td>
				</tr>
				<tr>
					<td style="-moz-hyphens: none;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;word-break: break-word;-webkit-hyphens: none;-ms-text-size-adjust: 100%;hyphens: none;font-family:Open Sans,Arial,Helvetica,sans-serif;font-size:20px;line-height: 25px;color: #ac5e2a;border-collapse: collapse;padding: 15px;padding:10px 20px">Hello '.$fullname.',</td>
				</tr>
				<tr>		
					<td style="-moz-hyphens: none;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;word-break: break-word;-webkit-hyphens: none;-ms-text-size-adjust: 100%;hyphens: none;font-family:Open Sans,Arial,Helvetica,sans-serif;font-size: 15px;line-height: 25px;color: #000;border-collapse: collapse;padding:10px 20px">
						Thank you for registering at Code8 e-commerce website. Please click on the link below to activate your account. <br>
					</td>
				</tr>	
				<tr>		
					<td style="padding:10px 20px 15px 20px">
						<a href="'.$urlpath.'verification.php?id='.$encrypted.'" style="-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;font-family:Poppins,Open Sans,Arial,Helvetica,sans-serif;color:#ffffff;padding-top: 7px;padding-right:18px;padding-bottom:10px;padding-left:18px;display:inline-block;border:1px solid #red;text-decoration:none;cursor:pointer;background:red;font-size:16px">Activate Your Account</a>
					</td>
				</tr>
				<tr>		
					<td style="-moz-hyphens: none;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;word-break: break-word;-webkit-hyphens: none;-ms-text-size-adjust: 100%;hyphens: none;font-family:Open Sans,Arial,Helvetica,sans-serif;font-size: 15px;line-height: 25px;color: #000;border-collapse: collapse;padding:10px 20px">
						Click on the link below if you are unable to click the Activation button. <br>						
						<p>'.$urlpath.'verification.php?id='.$encrypted.'</b></p>
					</td>
				</tr>
				<tr>		
					<td style="-moz-hyphens: none;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;word-break: break-word;-webkit-hyphens: none;-ms-text-size-adjust: 100%;hyphens: none;font-family:Open Sans,Arial,Helvetica,sans-serif;font-size: 15px;line-height: 25px;color: #000;border-collapse: collapse;padding:10px 20px 10px 20px">
						Thanks,<br>Code8.
					</td>
				</tr>	
			</table>
			</td></tr>
			</table>
			</body>
			</html>';
			$mail->send();				
								
			if($regstatus == 1){				
				echo '<a class="regsuccess"></a>';	
				echo '<script> $(document).ready(function(){ $(".regsuccess").trigger("click"); });</script>';
				echo '<a class="on-addtocart-btn regsuccess" href="javascript:void(0);" data-src="#regsuccess" data-fancybox=""></a>';
			} else {					
				echo '<a class="somethingwrong"></a>';	
				echo '<script> $(document).ready(function(){ $(".somethingwrong").trigger("click"); });</script>';
				echo '<a class="on-addtocart-btn somethingwrong" href="javascript:void(0);" data-src="#somethingwrong" data-fancybox=""></a>';
			}						
		} else {				
			echo '<a class="confpassnotmatch"></a>';	
			echo '<script> $(document).ready(function(){ $(".confpassnotmatch").trigger("click"); });</script>';	
			echo '<a class="on-addtocart-btn confpassnotmatch" href="javascript:void(0);" data-src="#confpassnotmatch" data-fancybox=""></a>';
		}
			
	}
			
}


if(isset($_POST['login'])){		
//		echo "welcome";exit;
	$emailid 	= filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	$password 	= $_POST['password'];			
	$newpass 	= md5($password);	
	
	$loginquery = "SELECT * from code8_customers where email='$emailid' OR mobile='$emailid' AND status=1";
	$database1 = new Database();
	$dbCon = $database1->getConnection();
	$stmt = $dbCon->prepare($loginquery);  
	$stmt->execute();	
	$loginres = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$db_username 	= strtolower($loginres['email']);
	$dbusermobile 	= $loginres['mobile'];
	$db_password 	= $loginres['password'];
	$customerid 	= $loginres['id'];
	$customertype 	= $loginres['customertype'];
	
	if(($emailid==$db_username || $emailid==$dbusermobile) && $newpass==$db_password)
	{			
		$_SESSION["SESS_CUSTOMER_ID"] = $customerid;
		$_SESSION["SESS_CUSTOMER_TYPE"] = $customertype;

		$updaqtyquery = "SELECT * from thefoodfund_cart WHERE status=1 AND guestid='$guestid'";
		$database1 = new Database();
		$dbCon1 = $database1->getConnection();
		$stmt1 = $dbCon1->prepare($updaqtyquery);  
		$stmt1->execute();	
		$cartcount = $stmt1->rowCount();
		$updateqtyres = $stmt1->fetchAll(PDO::FETCH_ASSOC);			
		foreach($updateqtyres as $updateqtyresult){
		
			/* Update Qty */			
			$upprodid = $updateqtyresult['prodid'];
			$upqty = $updateqtyresult['quantity'];
			
			$dbupdaqtyquery = "SELECT * from code8_cart WHERE status=1 AND customerid='$customerid' AND prodid=$upprodid";
			$database1 = new Database();
			$dbCon1 = $database1->getConnection();
			$stmt1 = $dbCon1->prepare($dbupdaqtyquery);  
			$stmt1->execute();	
			$cartcount = $stmt1->rowCount();
			$dbupdateqtyresult = $stmt1->fetch(PDO::FETCH_ASSOC);
			
			$dbupdaprodid   = $dbupdateqtyresult['prodid'];
			$dbupdaqty 		= $dbupdateqtyresult['quantity'];
			
			if($dbupdaprodid==$upprodid){
				$updatedqty = $upqty+$dbupdaqty;												$dbupdaqtyquery1 = "UPDATE code8_cart SET `quantity`='$updatedqty' WHERE status=1 AND guestid='$guestid' AND prodid='$upprodid'";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($dbupdaqtyquery1);  
				$stmt1->execute();		
					
			}						
		}	

		$updquery = "UPDATE code8_cart SET guestid='0', customerid = REPLACE(customerid, '0', '$customerid') WHERE guestid='$guestid' AND status=1";
		$database1 = new Database();
		$dbCon = $database1->getConnection();
		$stmt = $dbCon->prepare($updquery);  
		$stmt->execute();
		
		$deldquery = "DELETE t1 FROM code8_cart t1, code8_cart t2 WHERE t1.id < t2.id AND t1.prodid = t2.prodid AND t1.status=1 AND t1.customerid='$customerid'";
		$database1 = new Database();
		$dbCon = $database1->getConnection();
		$stmt = $dbCon->prepare($deldquery);  
		$stmt->execute();
								
		$cartprod_que = "SELECT * from code8_cart WHERE status=1 AND customerid='$customerid'";
		$database1 = new Database();
		$dbCon1 = $database1->getConnection();
		$stmt1 = $dbCon1->prepare($cartprod_que);  
		$stmt1->execute();	
		$cartcount = $stmt1->rowCount();
		$cartprod_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);							
		foreach($cartprod_res as $result){	
			$id 		= $result['id'];
			$customerid = $result['customerid'];
			$prodid 	= $result['prodid'];
			$quantity 	= $result['quantity'];
			$price 		= $result['price'];			
			$tax 		= $result['tax'];
			$shipping 	= $result['shipping'];
			$color 		= $result['color'];
			$size 		= $result['size'];					
			$tax 		= $result['tax'];					
			$shipping	= $result['shipping'];				
			$prod_res 	= getProductData($prodid);			
			$prodname 	= addslashes($prod_res['prodtitle']);
			$color_name	= getColor($result['color']);		
			$size_name	= getSize($result['size']);			
									
			$query3 = "SELECT * from code8_cartproducts WHERE status=1 AND customerid='$customerid' AND prodid='$prodid' AND sizeid='$size' AND colorid='$color'";			
			$database1 = new Database();
			$dbCon1 = $database1->getConnection();
			$stmt1 = $dbCon1->prepare($query3);  
			$stmt1->execute();	
			$count3 = $stmt1->rowCount();
			
			if($count3==0){					
				$query34 = "INSERT INTO code8_cartproducts(`invoice`, `orderid`, `cartid`,`customerid`,`prodid`,`prodname`, `product_price`, `quantity`, `colorid`, `colorname`, `sizeid`, `sizename`, `status`, `remarks`, `date`, `paystatus`,`billaddress`,`shipaddress`,`tax`,`shipping`) VALUES ('','','$id','$customerid','$prodid','$prodname','$price','$quantity','$color','$color_name','$size','$size_name','1','',NOW(),'','','','$tax','$shipping')";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($query34);  
				$stmt1->execute();				
			} else {				
				$query34 = "UPDATE code8_cartproducts SET `quantity`='$quantity' WHERE status=1 AND customerid='$customerid' AND prodid='$prodid' AND size='$size' AND color='$color'";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($query34);  
				$stmt1->execute();
			}
		}		
//		header("location:$_SERVER[HTTP_REFERER]");
		
	} 
        else if(($emailid==$db_username || $emailid==$dbusermobile) && $newpass!=$db_password){		
		echo '<a class="invalidpassword"></a>';	
		echo '<script> $(document).ready(function(){ $(".invalidpassword").trigger("click"); });</script>';
		echo '<a class="on-addtocart-btn invalidpassword" href="javascript:void(0);" data-src="#invalidpassword" data-fancybox=""></a>';
	}
        else {	
		echo '<a class="invalidcredentials"></a>';	
		echo '<script> $(document).ready(function(){ $(".invalidcredentials").trigger("click"); });</script>';
		echo '<a class="on-addtocart-btn invalidcredentials" href="javascript:void(0);" data-src="#invalidcredentials" data-fancybox=""></a>';	
	}
	
}

if(isset($_POST['forgot'])){
$emailid 	= filter_var($_POST['email'], FILTER_SANITIZE_STRING);
	
	$checkquery = "SELECT * from code8_customers where email='$emailid' OR mobile='$emailid'";
	$database1 = new Database();
	$dbCon = $database1->getConnection();
	$stmt = $dbCon->prepare($checkquery);  
	$stmt->execute();	
	$checkres = $stmt->fetch(PDO::FETCH_ASSOC);
	$customerid = $checkres['id'];
	$decrypted 	= my_simple_crypt($customerid, 'e' );
	
	if($checkres['email'] == $emailid || $checkres['mobile']==$emailid)
	{
		$mail = new PHPMailer;					 
		$mail->SMTPDebug = 3;
		$mail->isSMTP();					                   
		$mail->Host = "smtp.gmail.com";					
		$mail->SMTPAuth = true;
		$mail->Username = "code8.ecom@gmail.com";          
		$mail->Password = "code8@code8";
		$mail->SMTPSecure = "tls";
		$mail->Port = 587;
		$mail->From = "code8.ecom@gmail.com";
		$mail->FromName = "Code8 e-commerce website";
		$mail->addAddress($emailid, $username);
		$mail->isHTML(true);
		$mail->Subject = "Code8 e-commerce website - Forgot Password";
		$mail->Body = '<html>
		<head>
		<meta charset="utf-8">
		<title>Code8 e-commerce website</title>
		<style type="text/css">
			a:hover{background:#ac5e2a!important;border:1px solid #ac5e2a!important }
		</style>
		</head>

		<body style="margin: 0px;padding: 0px">
		<table cellpadding="0" cellspacing="0" border="0">
			<tr><td style="padding: 25px;background:#eee ">
		<table cellpadding="0" cellspacing="0" border="0" style="background: #ffffff">
			<tr>
				<td style="padding:10px 20px;"><div style="border-bottom:1px solid #d1b555;padding-bottom:15px "><img src="'.$urlpath.'/images/logo.png" width="177" height="130" alt="Code8 e-commerce website" /></div></td>
			</tr>
			<tr>
				<td style="-moz-hyphens: none;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;word-break: break-word;-webkit-hyphens: none;-ms-text-size-adjust: 100%;hyphens: none;font-family:Open Sans,Arial,Helvetica,sans-serif;font-size:20px;line-height: 25px;color: #000;border-collapse: collapse;padding: 15px;padding:10px 20px">Welcome to Code8 e-commerce website</td>
			</tr>
			<tr>
				<td style="-moz-hyphens: none;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;word-break: break-word;-webkit-hyphens: none;-ms-text-size-adjust: 100%;hyphens: none;font-family:Open Sans,Arial,Helvetica,sans-serif;font-size:20px;line-height: 25px;color: #ac5e2a;border-collapse: collapse;padding: 15px;padding:10px 20px">Hello,</td>
			</tr>
			<tr>		
					<td style="-moz-hyphens: none;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;word-break: break-word;-webkit-hyphens: none;-ms-text-size-adjust: 100%;hyphens: none;font-family:Open Sans,Arial,Helvetica,sans-serif;font-size: 15px;line-height: 25px;color: #000;border-collapse: collapse;padding:10px 20px">
						You recently requested to reset your password. Please click on the below link to reset your password <br>
					</td>
				</tr>	
				<tr>		
					<td style="padding:10px 20px 15px 20px">
						<a href="'.$urlpath.'recoverpassword.php?id='.$decrypted.'" style="-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;font-family:Poppins,Open Sans,Arial,Helvetica,sans-serif;color:#ffffff;padding-top: 7px;padding-right:18px;padding-bottom:10px;padding-left:18px;display:inline-block;border:1px solid #red;text-decoration:none;cursor:pointer;background:red;font-size:16px">Reset Password</a>
					</td>
				</tr>
				<tr>		
					<td style="-moz-hyphens: none;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;word-break: break-word;-webkit-hyphens: none;-ms-text-size-adjust: 100%;hyphens: none;font-family:Open Sans,Arial,Helvetica,sans-serif;font-size: 15px;line-height: 25px;color: #000;border-collapse: collapse;padding:10px 20px 10px 20px">
						Thanks,<br>Code8 e-commerce website.
					</td>
				</tr>	
		</table>
		</td></tr>
		</table>
		</body>
		</html>';		
		$mail->send();
				
		echo '<a class="senttoregemail"></a>';	
		echo '<script> $(document).ready(function(){ $(".senttoregemail").trigger("click"); });</script>';
		echo '<a class="on-addtocart-btn senttoregemail" href="javascript:void(0);" data-src="#senttoregemail" data-fancybox=""></a>';
	} 
	else {
		echo '<a class="emailnotmatch"></a>';	
		echo '<script> $(document).ready(function(){ $(".emailnotmatch").trigger("click"); });</script>';
		echo '<a class="on-addtocart-btn emailnotmatch" href="javascript:void(0);" data-src="#emailnotmatch" data-fancybox=""></a>';	
	}
}
?>
<div id="invalidcredentials" class="popup-hidden animated-modal added-cart-model invalidcredentials">
	<p class="anim1"><strong>Invalid Credentials!!!</strong></p>
	<p class="anim2"><a href="javascript:void(0);" onclick="$.fancybox.close();" class="button">OK</a></p>
</div>


<div id="invalidpassword" class="popup-hidden animated-modal added-cart-model invalidpassword">
	<p class="anim1"><strong>Invalid Password!!!</strong></p>
	<p class="anim2"><a href="javascript:void(0);" onclick="$.fancybox.close();" class="button">OK</a></p>
</div>


<div id="senttoregemail" class="popup-hidden animated-modal added-cart-model senttoregemail">
	<p class="anim1"><strong>Email sent to registered email address!!</strong></p>
	<p class="anim2"><a href="javascript:void(0);" onclick="$.fancybox.close();" class="button">OK</a></p>
</div>


<div id="emailnotmatch" class="popup-hidden animated-modal added-cart-model emailnotmatch">
	<p class="anim1"><strong>Email or Mobile number not matching with the records!!</strong></p>
	<p class="anim2"><a href="javascript:void(0);" onclick="$.fancybox.close();" class="button">OK</a></p>
</div>


<div id="regsuccess" class="popup-hidden animated-modal added-cart-model regsuccess">
	<p class="anim1"><strong>Registered successfully!!</strong></p>
	<p class="anim2"><a href="javascript:void(0);" onclick="$.fancybox.close();" class="button">OK</a></p>
</div>


<div id="somethingwrong" class="popup-hidden animated-modal added-cart-model somethingwrong">
	<p class="anim1"><strong>Something went wrong!!</strong></p>
	<p class="anim2"><a href="javascript:void(0);" onclick="$.fancybox.close();" class="button">OK</a></p>
</div>


<div id="confpassnotmatch" class="popup-hidden animated-modal added-cart-model confpassnotmatch">
	<p class="anim1"><strong>Confirm password not matching!!!!!!</strong></p>
	<p class="anim2"><a href="javascript:void(0);" onclick="$.fancybox.close();" class="button">OK</a></p>
</div>


<div id="useralreadyexist" class="popup-hidden animated-modal added-cart-model useralreadyexist">
	<p class="anim1"><strong>User already exist!!</strong></p>
	<p class="anim2"><a href="javascript:void(0);" onclick="$.fancybox.close();" class="button">OK</a></p>
</div>




<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!--start fancybox-->	
<script type="text/javascript" src="fancybox-master/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="fancybox-master/fancybox.js"></script>
<!--end fancybox-->	
