<?php
require_once("seg.php");
require_once('funciones.php');
conectar('10.10.3.164', 'root', 'localhost', 'importaciones');
$id = $_POST["id"];
$i=0;
    
if(isset($_FILES['arc'])){
    foreach ($_FILES['arc']['error'] as $key => $error){
        if ($error == UPLOAD_ERR_OK) {
            $url="images/FacPDF/".$fecha_a.$_FILES["arc"]["name"][$i];
            move_uploaded_file($_FILES['arc']['tmp_name'][$i],$url) or die("Ocurrio un problema al intentar subir el archivo.");
            $sQuery=("INSERT INTO `imagen` (`id`, `id_reporte`, `url`) VALUES (NULL, ($id), '$url');");
            @mysql_query($sQuery);
            
        }
        $i++;
    }
    ?>
    <script type="text/javascript">
        alert("Archivos adjuntados exitosamente");
        window.location="reporte_pd.php"
    </script>
    <?php
} 
        ?>