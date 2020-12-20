<?php
if(isset($_POST["submit"]))
{
	$url='localhost';
	$username='dmdemo';
	$password='SzGjuKSJmFLrxRHf';
	$conn=mysqli_connect($url,$username,$password,"code8");
	
	if(!$conn){
		die('Could not Connect My Sql:' .mysqli_error());
	}
	$file = $_FILES['file']['tmp_name'];
	$handle = fopen($file, "r");
	$c = 0;
	while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
	{
	  $lname0 = $filesop[0];
	  $lname1 = $filesop[1];
	  $lname2 = $filesop[2];
	  $lname3 = $filesop[3];
	  $lname4 = $filesop[4];
	  $lname5 = $filesop[5];
	  $lname6 = $filesop[6];
	 	  
	 // print_r($filesop);
	  
	 $sql = "insert into code8_dhl_cityzip(countryid,countryname,statecode,statename,deliverytype,zipfrom,zipto) values ('$lname0','$lname1','$lname2','$lname3','$lname4','$lname5','$lname6')";
	 //die;
	  //$stmt = mysqli_prepare($conn,$sql);
	  mysqli_query($conn,$sql);
	  $c = $c + 1;
	}

	if($sql){
		echo "sucess";
	} else {
		echo "Sorry! Unable to impo.";
	}
}
?>
<!DOCTYPE html>
<html>
<body>
<form enctype="multipart/form-data" method="post" role="form">
    <div class="form-group">
        <label for="exampleInputFile">File Upload</label>
        <input type="file" name="file" id="file" size="150">
        <p class="help-block">Only Excel/CSV File Import.</p>
    </div>
    <button type="submit" class="btn btn-default" name="submit" value="submit">Upload</button>
</form>
</body>
</html>