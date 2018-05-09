<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php

if (isset($_FILES['imagen'])){
	
	$cantidad= count($_FILES["imagen"]["tmp_name"]);
	
	for ($i=0; $i<$cantidad; $i++){
	//Comprobamos si el fichero es una imagen
	if ($_FILES['imagen']['type'][$i]=='image/png' || $_FILES['imagen']['type'][$i]=='image/jpeg'){
	
	//Subimos el fichero al servidor
	move_uploaded_file($_FILES["imagen"]["tmp_name"][$i], $_FILES["imagen"]["name"][$i]);
	$validar=true;
	}
	else $validar=false;
	
	
}
}

?>
<form method="post" action="" enctype="multipart/form-data">
<input type="file" name="imagen[]" value="" multiple><br>

<input type="submit" value="Subir Imagen">
</form>


<?php if (isset($_FILES['imagen']) && $validar==true){ ?>
<?php $cantidad= count($_FILES["imagen"]["tmp_name"]);
	
	for ($i=0; $i<$cantidad; $i++){?>
<h1><?php echo $_FILES["imagen"]["name"][$i] ?></h1>
<img src="<?php echo $_FILES["imagen"]["name"][$i] ?>" width="100">
<?php } }?>
</body>
</html>