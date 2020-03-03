<link rel="shortcut icon" type="image/x-icon" href="images/map-with-a-pin.png">
<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="style.css">
<link rel= "stylesheet" href="them/green.css">
<?php
  $query = "SELECT *FROM tbl_them where id='1'";
   $theme = $db->select($query);
  while($result = $theme->fetch_assoc()) {
if ($result['them']=='default') {?>
<link rel="stylesheet" href="them/default.css"/>
<?php
}
 elseif ($result['them']=='green') {?>
<link rel="stylesheet" href="them/green.css"/>
	<?php
 } elseif ($result['them']=='red') {?>
 <link rel="stylesheet" href="them/red.css"/>
 <?php
 }
 
 else{
 	?>
<link rel="stylesheet" href="them/red.css">
 	<?php
 }
}
?>













