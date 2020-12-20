<?php
include "connectionpdo.php";
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Code8 - Admin</title>
  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="vendors/loginstyle.css">  
</head>
<style>
body { background-color:#000; }
</style>
<?php
if($_REQUEST!='' && isset($_REQUEST['msg'])=='invalid'){
	echo "<script>alert('Invalid Login credentials!!');</script>";
}
?>
<body>
	<div class="form" style="margin-top:200px">       
	  <form id="loginform" action="loginsubmit.php" class="form-vertical" method="post" >
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
			  <p class="forgot"><a href="forgot.php">Forgot Password?</a></p>			  
			 <input type="submit" name="Submit" class="button button-block" value="Log In"/>
			  </form>        
		  </div><!-- tab-content -->
      </form>	  
	</div> <!-- /form -->  
</body>
</html>
