<?php
include "PHPMailer.php";
include "class.smtp.php";

$mail = new PHPMailer;					 
$mail->SMTPDebug = 4;
$mail->isSMTP();					                   
$mail->Host = "smtp.gmail.com";					
$mail->SMTPAuth = true;
$mail->Username = "code8.ecom@gmail.com";                 
$mail->Password = "code8@code8";
$mail->SMTPSecure = "tls";
$mail->Port = 587;
$mail->From = "code8.ecom@gmail.com";
$mail->FromName = "TEST";
$mail->addAddress('chanikya@design-master.com', 'Chani');
$mail->isHTML(true);
$mail->Subject = "Test";
					
$mail->Body = '<html>
<head>
<meta charset="utf-8">
<title>FAWSEC Online Recruitment system</title>
<style type="text/css">
	a:hover{background:#ac5e2a!important;border:1px solid #ac5e2a!important }
</style>
</head>

<body style="margin: 0px;padding: 0px">
<table cellpadding="0" cellspacing="0" border="0">
	<tr><td style="padding: 25px;background:#eee ">
<table cellpadding="0" cellspacing="0" border="0" style="background: #ffffff">
	<tr>
		<td style="padding:10px 20px;"><div style="border-bottom:1px solid #d1b555;padding-bottom:15px "><img src="/images/logo.png" width="177" height="130" alt="FAWSEC Online Recruitment system" /></div></td>
	</tr>
	<tr>
		<td style="-moz-hyphens: none;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;word-break: break-word;-webkit-hyphens: none;-ms-text-size-adjust: 100%;hyphens: none;font-family:Open Sans,Arial,Helvetica,sans-serif;font-size:20px;line-height: 25px;color: #000;border-collapse: collapse;padding: 15px;padding:10px 20px">Welcome to FAWSEC Online Recruitment system</td>
	</tr>
	<tr>
		<td style="-moz-hyphens: none;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;word-break: break-word;-webkit-hyphens: none;-ms-text-size-adjust: 100%;hyphens: none;font-family:Open Sans,Arial,Helvetica,sans-serif;font-size:20px;line-height: 25px;color: #ac5e2a;border-collapse: collapse;padding: 15px;padding:10px 20px">Hello,</td>
	</tr>
	
	
	<tr>		
		<td style="-moz-hyphens: none;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;word-break: break-word;-webkit-hyphens: none;-ms-text-size-adjust: 100%;hyphens: none;font-family:Open Sans,Arial,Helvetica,sans-serif;font-size: 15px;line-height: 25px;color: #000;border-collapse: collapse;padding:10px 20px 10px 20px">
			Thanks,<br>FAWSEC Online Recruitment system.
		</td>
	</tr>	
</table>
</td></tr>
</table>
</body>
</html>';			
	
$mail->send();
?>