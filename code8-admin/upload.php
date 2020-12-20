<?php
error_reporting(0);
 
foreach($_FILES['file']['name'] as $key=>$value)
{	
	move_uploaded_file($_FILES['file']['tmp_name'][$key], '../uploads/adminfiles/' . $_FILES['file']['name'][$key]);

	print_r('uploads/adminfiles/' . $_FILES['file']['name'][$key]);	
}
 
