<html>
<head>
<style>
body
{
 margin:0 auto;
 padding:0px;
 text-align:center;
 width:100%;
 font-family: "Myriad Pro","Helvetica Neue",Helvetica,Arial,Sans-Serif;
 background-color:#F79F81;
}
#wrapper
{
 margin:0 auto;
 padding:0px;
 text-align:center;
 width:995px;
}
#wrapper h1
{
 margin-top:50px;
 font-size:45px;
 color:#B43104;
}
#wrapper h1 p
{
 font-size:18px;
}
#convert_div input[type="text"]
{
 width:300px;
 height:55px;
 padding-left:10px;
 font-size:18px;
 margin-bottom:15px;
 color:#424242;
 font-weight:bold;
 border:none;
}
#convert_div select
{
 margin:0px;
 padding:0px;
 width:150px;
 height:55px;
 font-size:15px;
 margin-bottom:15px;
 color:#424242;
 font-weight:bold;
 border:none;
}
#convert_div input[type="submit"]
{
 width:330px;
 height:45px;
 font-size:16px;
 font-weight:bold;
 background-color:#B43104;
 color:white;
 border:none;
 box-shadow:0px 3px 0px 0px #8A2908;
 border-radius:3px;
}
</style>
</head>
<body>
<div id="wrapper">
<div id="convert_div">
<form method="post"action="convert.php">
 <input type="text" name="amount" placeholder="Enter Amount">
 <select name="convert_from">
  <option  value="INR">Indian Rupee</option>
  <option  value="USD">US Dollar</option>
  <option  value="SGD">Singapore Dollar</option>
  <option  value="EUR">Euro</option>
  <option  value="AED">UAE Dirham</option>
 </select>
 <select name="convert_to">
  <option  value="INR">Indian Rupee</option>
  <option  value="USD">US Dollar</option>
  <option  value="SGD">Singapore Dollar</option>
  <option  value="EUR">Euro</option>
  <option  value="AED">UAE Dirham</option>
 </select>
 <br>
 <input type="submit" name="convert_currency" value="Convert Currency">
</form>
</div>
</div>
</body>
</html>