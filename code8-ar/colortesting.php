<html>
    <head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <style>
            input{
  display: block;
  width: 50%;
  float: left;
  height: 80px;
}
input[type="text"] {
  padding: 20px;
}
input[type="text"]:invalid{
  background: red;
  color: #fff;
}
body {
  font-size: 30px; 
  padding: 3em;
  display: flex;
  min-height: 100vh;
  justify-content: center;
  align-items: center;
}
            
        </style>
        
    </head>
    
    <body>

<input type="color" id="colorpicker" name="color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#bada55"> 
 
<input type="text" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#bada55" id="hexcolor"></input>
    
</div>
        
    </body>
    
</html>

<script>
   
$('#colorpicker').on('change', function() {
	$('#hexcolor').val(this.value);
});
$('#hexcolor').on('change', function() {
  $('#colorpicker').val(this.value);
});
</script>




