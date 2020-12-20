<?php include "header.php"; ?>
<?php							
	$contactpage_que = "SELECT * from code8_contactpage where id=1";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($contactpage_que);  
	$stmt1->execute();	
	$contactpage_res = $stmt1->fetch(PDO::FETCH_ASSOC);			
?>
<?php
if(isset($_POST['submit'])){	
	if(isset($_POST["captcha"])&&($_SESSION["captcha"]==$_POST["captcha"]))
	{	
		$fullname 	= $_POST['fullname'];
		$email 		= $_POST['email'];
		$mobile 	= $_POST['mobile'];
		$comments 	= $_POST['comments'];
		
		$mail = new PHPMailer;					 
		$mail->SMTPDebug = 3;
		$mail->isSMTP();					                   
		$mail->Host = "smtp.gmail.com";					
		$mail->SMTPAuth = true;
		$mail->Username = "info@code8.com";                 
		$mail->Password = "P@ss1234";
		$mail->SMTPSecure = "tls";
		$mail->Port = 587;
		$mail->From = "info@code8.com";
		$mail->FromName = "Code8 Feedback";
		$mail->addAddress("info@code8.com", "Code8");
		$mail->isHTML(true);
		$mail->Subject = "Code8 Feedback!";
							
		$mail->Body = '<html>
		<head>
		<meta charset="utf-8">
		<title>Code8 Feedback</title>
		<style type="text/css">
			a:hover{background:#ac5e2a!important;border:1px solid #ac5e2a!important }
		</style>
		</head>
		<body style="margin: 0px;padding: 0px">
		<table cellpadding="0" cellspacing="0" border="0">
			<tr><td style="padding: 25px;background:#eee ">
		<table cellpadding="0" cellspacing="0" border="0" style="background: #ffffff">
			<tr>
				<td style="padding:10px 20px;"><div style="border-bottom:1px solid #d1b555;padding-bottom:15px "><img src="'.$urlpath.'/images/logo.png" width="177" height="130" alt="Code8 Feedback" /></div></td>
			</tr>
			<tr>
				<td style="-moz-hyphens: none;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;word-break: break-word;-webkit-hyphens: none;-ms-text-size-adjust: 100%;hyphens: none;font-family:Open Sans,Arial,Helvetica,sans-serif;font-size:20px;line-height: 25px;color: #000;border-collapse: collapse;padding: 15px;padding:10px 20px">Welcome to Code8</td>
			</tr>
			<tr>
				<td style="-moz-hyphens: none;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;word-break: break-word;-webkit-hyphens: none;-ms-text-size-adjust: 100%;hyphens: none;font-family:Open Sans,Arial,Helvetica,sans-serif;font-size:20px;line-height: 25px;color: #ac5e2a;border-collapse: collapse;padding: 15px;padding:10px 20px">Dear Admin,</td>
			</tr>
			<tr>		
				<td style="-moz-hyphens: none;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;word-break: break-word;-webkit-hyphens: none;-ms-text-size-adjust: 100%;hyphens: none;font-family:Open Sans,Arial,Helvetica,sans-serif;font-size: 15px;line-height: 25px;color: #000;border-collapse: collapse;padding:10px 20px">
					You have received a new Feedback from Code8. Below are the details <br>			
				</td>
			</tr>
			<tr>		
				<td style="-moz-hyphens: none;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;word-break: break-word;-webkit-hyphens: none;-ms-text-size-adjust: 100%;hyphens: none;font-family:Open Sans,Arial,Helvetica,sans-serif;font-size:14px;line-height:normal;color: #000;border-collapse: collapse;padding:10px 20px 10px 20px;">
					<table cellpadding="0" cellspacing="0" border="0" width="100%">
						<tr>
							<th align="left" style="border:1px solid #eee;padding:5px">Name</th>
							<td align="left" style="border:1px solid #eee;padding:5px">'.$fullname.'</td>
						</tr>
						<tr>
							<th align="left" style="border:1px solid #eee;padding:5px">Mobile</th>
							<td align="left" style="border:1px solid #eee;padding:5px">'.$mobile.'</td>
						</tr>	
						<tr>
							<th align="left" style="border:1px solid #eee;padding:5px">Email ID</th>
							<td align="left" style="border:1px solid #eee;padding:5px">'.$email.'</td>
						</tr>
						<tr>
							<th align="left" style="border:1px solid #eee;padding:5px">Comments</th>
							<td align="left" style="border:1px solid #eee;padding:5px">'.$comments.'</td>
						</tr>					
					</table>
				</td>
			</tr>	
			<tr>		
				<td style="-moz-hyphens: none;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;word-break: break-word;-webkit-hyphens: none;-ms-text-size-adjust: 100%;hyphens: none;font-family:Open Sans,Arial,Helvetica,sans-serif;font-size: 15px;line-height: 25px;color: #000;border-collapse: collapse;padding:10px 20px 10px 20px">			
				</td>
			</tr>	
		</table>
		</td></tr>
		</table>
		</body>
		</html>';			
		$mail->send();
		echo '<script>alert("Feedback sent successfully!!")</script>';
	} else {		
		echo '<script>alert("Wrong captcha entered!!")</script>';
	}
}
?>
<section class="innerpages">
	<div class="container clearfix">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<h1 class="text-center fullwidth">Code8 <span>اتصال</span></h1>
			</div>
			<div class="col-lg-6 col-md-6 contact-column">
				<div class="my-cart-items gold-color-bg">
					<h4>معلومات العنوان</h4>
					<div class="address-review">
						<h3>عنوان</h3>
						<p><?php echo $contactpage_res['addressar']; ?></p>
						<h3>هاتف</h3>
						<p><?php echo $contactpage_res['telephone']; ?></p>
						<h3>ص. صندوق</h3>
						<p><?php echo $contactpage_res['pobox']; ?></p>
						<h3>البريد الإلكتروني</h3>
						<p><a href="mailto:<?php echo $contactpage_res['email']; ?>"><?php echo $contactpage_res['email']; ?></a></p>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 contact-column">
				<div class="my-cart-items gold-color-bg">
					<h4>ردود الفعل</h4>
					<form method="post" name="feedback">
						<div class="profileforma">
							<div class="form-group">
								<div class="inputbox"><input type="text" value="" name="fullname" required placeholder="Full Name..." class="form-control"></div>
							</div>
							<div class="form-group">
								<div class="inputbox"><input type="text" value="" name="mobile" required placeholder="Mobile..." class="form-control"></div>
							</div>
							<div class="form-group">
								<div class="inputbox"><input type="email" value="" name="email" required placeholder="Email..." class="form-control"></div>
							</div>
							<div class="form-group">
								<div class="inputbox"><textarea placeholder="Comments..." required name="comments" class="form-control"></textarea></div>
							</div>
							<div class="form-group">
								<label><p style="font-size:16px">لأجل الانتعاش:</strong></label><br/>
								<input required type="text" name="captcha" class="form-control"/>
							</div>
							<div class="form-group">
								<p>
								<img src="captcha.php?rand=<?php echo rand(); ?>" id='captcha_image'>
								</p>
								<p style="font-size:16px">لا تستطيع قراءة الصورة؟
								<a style="color:#fff; font-size:16px" href='javascript: refreshCaptcha();'>انقر هنا</a>
								لأجل الانتعاش</p>
							</div>
							<div>
							<input type="submit" value="إرسال" name="submit" class="button">
							</div>
						</div>
					</form>	
				</div>
			</div>
		</div>
	</div>
</section>
<?php include "footer.php"; ?>
