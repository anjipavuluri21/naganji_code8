<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Forgot Password Form</title>
  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">  
  <link rel="stylesheet" href="vendors/loginstyle.css">  
</head>
<style>
body { background-color: #000; }
</style>
<?php
include "connectionpdo.php"; 
if(isset($_POST['Submit']))
{
	$username 		= ($_POST['username']);
	$password 		= ($_POST['password']);
	$confpassword 	= ($_POST['confpassword']);
	
	if($password != $confpassword)
	{
		echo "<script>alert('Confirm Password is not matching')</script>";
	} else {		
		$login_query = "SELECT * from code8_adminuser where status=1 AND username='$username'";
		$database = new Database();
		$dbCon = $database->getConnection();
		$stmt = $dbCon->prepare($login_query);  
		$stmt->execute();
		$count = $stmt->rowCount();
		$menbanner_res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($menbanner_res as $login_res)
		{		
			$db_username = $login_res['username'];			
			if($username==$db_username)
			{
				$newpass = md5($password);
								
				$login_query = "UPDATE code8_adminuser SET password='$newpass' where status=1 AND username='$username'";
				$database = new Database();
				$dbCon = $database->getConnection();
				$stmt = $dbCon->prepare($login_query);  
				$stmt->execute();
				
				echo "<script>alert('Changed Successfully!!')</script>";
				echo "<script>window.location='index.php'</script>";				
			}
			else {				
				echo "<script>alert('Incorrect Username')</script>";
			}
		}
	}
}
?>
<body>
  <div class="form" style="margin-top:200px">      
	  <form id="loginform" class="form-vertical" method="post" >
		  <div class="tab-content"> 	   
			 <div align="center">
				<img src="images/logo.png" style="margin-bottom:18px;">	
			 </div>       
			  <form action="" method="post">          
				<div class="field-wrap">            
				<input type="text" required placeholder="Username*" name="username" />
			  </div>			  
			  <div class="field-wrap">            
				<input type="password" name="password" required placeholder="Password*" />
			  </div>
			   <div class="field-wrap">            
				<input type="password" name="confpassword" required placeholder="Confirm Password*" />
			  </div>			  
			  <p class="forgot"><a href="index.php">Login?</a></p>			  
			 <input type="submit" name="Submit" class="button button-block" value="Update"/>
			  </form>        
		  </div><!-- tab-content -->
      </form>	  
</div> <!-- /form -->  
</body>
</html>
