<?php
if ((($_FILES["archivo"]["type"]=="image/gif")||($_FILES["archivo"]["type"]=="image/jpeg")||($_FILES["archivo"]["type"]=="PDF/PDF")||($_FILES["archivo"]["type"]=="image/pjpeg"))&&($_FILES["archivo"]["size"]<200000000)){ 
     
    //Si es que hubo un error en la subida, mostrarlo, de la variable $_FILES podemos extraer el valor de [error], que almacena un valor booleano (1 o 0).
      if ($_FILES["archivo"]["error"]>0) {
        echo $_FILES["archivo"]["error"]."<br />"; 
      } else { 
            $fecha_a=date('Y-m-dHis');
            $factura="images/FacPDF/".$fecha_a.$_FILES["archivo"]["name"];
           // Si no es un archivo repetido y no hubo ningun error, procedemos a subir a la carpeta /archivos, seguido de eso mostramos la imagen subida
            move_uploaded_file($_FILES["archivo"]["tmp_name"],"images/FacPDF/".$fecha_a.$_FILES["archivo"]["name"]); 
            $sQuery=("INSERT INTO `reporte_pd` (`id`, `factura`, `container`, `origen`, `tipol`, `proveedor`, `mercancia`, `empresa`, `almacens`, `fechasalida`, `fechallegada`, `status`, `observaciones`) VALUES (NULL,'$factura', $container, '$origen', '$tipol', '$proveedor', '$mercancia', '$empresa', '$almacens', '$fechasalida', '$fechallegada', '$status', '$observaciones');");
            @mysql_query($sQuery);
            echo "Archivo Subido <br/>";
            echo "<button type='submit' class='btn btn-success' onclick='history.back()'>Regresar</button>";
           
      } 
    } 
	?>