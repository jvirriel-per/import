<?php
require_once("seg.php");
require_once('funciones.php');
conectar('10.10.3.164', 'root', 'localhost', 'importaciones');
$id = $_POST["id"];
$bl = $_POST["bl"];   
$container = $_POST["container"]; 
$cargasuelta = $_POST["cargasuelta"];
$origen = $_POST["origen"];
$mercancia = $_POST["mercancia"]; 
$proveedor = $_POST["proveedor"]; 
$empresa = $_POST["empresa"];      
$fechasalida = $_POST["fechasalida"];
$fechallegada = $_POST["fechallegada"];  
$status = $_POST["status"];   
$observaciones = $_POST["observaciones"];
$fecha_a=date('Y-m-dHis');
$expdua = $_POST["expdua"];
$actualizar=("UPDATE reporte_pd SET bl='$bl', container='$container', cargasuelta='$cargasuelta', origen='$origen',  mercancia='$mercancia', proveedor='$proveedor', empresa='$empresa', fechasalida='$fechasalida', fechallegada='$fechallegada', status='$status', observaciones='$observaciones', expdua='$expdua' WHERE id='$id';");
$sql=@mysql_query($actualizar);
if($sql==true){
    ?>
  <script type="text/javascript">
                alert("Editado exitosamente...!!!");
                window.location="reporte_pd.php"
                </script>
  <?php
}else{
 ?>
  <script type="text/javascript">
                alert("Intente Nuevamente...");
                window.location="reporte_pd.php"
                </script>

  <?php 
 }
?>