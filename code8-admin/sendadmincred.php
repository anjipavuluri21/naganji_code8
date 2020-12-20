<?php
include "../connection.php";
include "auth.php";
//require '../PHPMailer.php';
//require '../class.smtp.php';
$id = mysqli_real_escape_string($con,$_REQUEST['id']);
$banner_que = mysqli_query($con,"SELECT * from bargain_dealers where id=$id");
$banner_result = mysqli_fetch_array($banner_que);	
$collegename = $banner_result['collegename'];
$collegemail = $banner_result['email'];
	
	if($banner_result['dealername']!="" && $banner_result['password']!=""){ 
			
		$toemail = $collegemail;	
		//$toemail = "chanikya.kodati@gmail.com";	
		$mail = new PHPMailer;					//Enable SMTP debugging. 
		$mail->SMTPDebug = 3;   
		//Set PHPMailer to use SMTP.
		$mail->isSMTP();  
		//Set SMTP host name
		$mail->Host = "";
		//Set this to true if SMTP host requires authentication to send email	
		$mail->SMTPAuth = true; 
		//Provide username and password 
		$mail->Username = "";
		$mail->Password = ""; 
		//If SMTP requires TLS encryption then set it
		$mail->SMTPSecure = "ssl"; 
		//Set TCP port to connect to 
		$mail->Port = 465;  
		$mail->From = "";
		$mail->FromName = "Bargain";	
		$mail->addAddress($toemail, $banner_result['collegename']);
						
		//$mail->addAttachment($blocation1); //Filename is optional		
		$mail->isHTML(true);
		$mail->Subject = "Bargain - Admin Credentials for Dealer";	
		// Compose a simple HTML email message	
		$mail->Body = '<html>
						<head>
						<meta charset="utf-8">
						<title>Bargain - Admin Credentials for Dealer</title>
						</head>
						<body style="margin: 0px;padding: 0px">
						<table cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td style="padding: 25px;background:#eee ">
									<table cellpadding="0" cellspacing="0" border="0" style="background: #ffffff">
										<tr align="center">
											<td style="padding:10px 20px;"><div style="border-bottom:1px solid #d1b555;padding-bottom:15px;align:center "><img src="../img/logo.png" alt="Bargain" /></div></td>
										</tr>
										<tr>
											<td style="-moz-hyphens: none;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;word-break: break-word;-webkit-hyphens: none;-ms-text-size-adjust: 100%;hyphens: none;font-family:Open Sans,Arial,Helvetica,sans-serif;font-size:20px;line-height: 25px;color: #000;border-collapse: collapse;padding: 15px;padding:10px 20px">Bargain - Admin Credentials for Dealer</td>
										</tr>
										<tr>
											<td style="-moz-hyphens: none;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;word-break: break-word;-webkit-hyphens: none;-ms-text-size-adjust: 100%;hyphens: none;font-family:Open Sans,Arial,Helvetica,sans-serif;font-size:15px;line-height: 25px;color: #000;border-collapse: collapse;padding:10px 20px">
												Hello 
												<strong style="-moz-hyphens: none;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;word-break: break-word;-webkit-hyphens: none;-ms-text-size-adjust: 100%;hyphens: none;font-family:Open Sans,Arial,Helvetica,sans-serif;font-size:18px;line-height: 25px;color: #ac5e2a;border-collapse: collapse;"></strong>

											</td>
										</tr>				
										<tr>		
											<td style="-moz-hyphens: none;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;word-break: break-word;-webkit-hyphens: none;-ms-text-size-adjust: 100%;hyphens: none;font-family:Open Sans,Arial,Helvetica,sans-serif;font-size:15px;line-height: 25px;color: #000;border-collapse: collapse;padding:10px 20px">
												We have created Admin Credentials for dealer account. Below are the details
											</td>
										</tr>									
										<tr>		
											<td style="-moz-hyphens: none;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;word-break: break-word;-webkit-hyphens: none;-ms-text-size-adjust: 100%;hyphens: none;font-family:Open Sans,Arial,Helvetica,sans-serif;font-size:14px;line-height:normal;color: #000;border-collapse: collapse;padding:10px 20px 10px 20px;">
												<table cellpadding="0" cellspacing="0" border="0" width="100%">
													<tr>
														<th align="left" style="border:1px solid #eee;padding:5px">Username</th>
														<td align="left" style="border:1px solid #eee;padding:5px">'.$banner_result[username].'</td>
													</tr>
													<tr>
														<th align="left" style="border:1px solid #eee;padding:5px">Password</th>
														<td align="left" style="border:1px solid #eee;padding:5px">'.$banner_result[secretcode].'</td>
													</tr>																			
												</table>
											</td>
										</tr>
										<tr>		
											<td style="-moz-hyphens: none;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;word-break: break-word;-webkit-hyphens: none;-ms-text-size-adjust: 100%;hyphens: none;font-family:Open Sans,Arial,Helvetica,sans-serif;font-size:15px;line-height: 25px;color: #000;border-collapse: collapse;padding:10px 20px">
												Regards,<br>
												Bargain.
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						</body>
						</html>';	
			// Sending email	
		if($mail->send()){
			echo "<script>alert('e-Mail sent successfully!!')</script>";
			echo "<script>window.location='viewalldealers.php'</script>";	
		} else {
			echo "<script>alert('Failed sending e-Mail!!')</script>";
			echo "<script>window.location='viewalldealers.php'</script>";
		}
	} else {
		echo "<script>alert('Admin credentials are not yet created for this account!!')</script>";
		echo "<script>window.location='viewalldealers.php'</script>";	
	}	
	
?>