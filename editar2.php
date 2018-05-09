<?php
require_once("seg.php");
require_once('funciones.php');
conectar('10.10.3.164', 'root', 'localhost', 'importaciones');
$id = $_POST["eleimagen"];
$eliminar=("DELETE from imagen where id=$id");
$sql=@mysql_query($eliminar);
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

