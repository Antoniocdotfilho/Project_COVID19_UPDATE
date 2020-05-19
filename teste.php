<html>
<head>
</head>
<body>

<?php 
$CountryCode_IMG="BR";
    $json_data_IMG = file_get_contents("http://raw.githubusercontent.com/Antoniocfilho/Project_Flags/master/countries.json"); 
    $user_data_IMG = json_decode($json_data_IMG);
     for($i = 0; $i < 186; $i++){
     	$var_IMG = $user_data_IMG->Countries[$i]->CountryCode;
     	 if($var_IMG==$CountryCode_IMG){
     	 	 $link_IMG = $user_data_IMG->Countries[$i]->Flag; 
     	 	}
     	 }

        $Flag_IMG = "$link_IMG";
?>

<img src="<?php echo $Flag_IMG; ?>">
</body>
</html>



