<?php
require_once("seg.php");
require_once('funciones.php');
conectar('10.10.3.164', 'root', 'localhost', 'importaciones');
$nombreE = $_SESSION["nombre"];
?>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<link href="css/bootstrap.min.css" rel="stylesheet"/>
        <link href="css/styles.css" rel="stylesheet" />
        <title>Importaciones</title>
		
</head>
<body>

<div class="container">
    <div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12" ><img src="images/ImportacionesCyberlux.png" width="100%"/></div>
  </div>
    <div class="row">
        
    <nav role="navigation" class="navbar navbar-default ">
        
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand"><img src="images/cyberlux.png" width="50%"/></a>
        </div>

        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="reporte_pd.php"style="border-width: 0; cursor: pointer">Reporte General</a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="active"><a href="Lista_anulado.php" style="border-width: 0; cursor: pointer">Anulados</a></li>
            </ul>
            <form class="navbar-form navbar-left" role="search" action="buscarS.php" method="POST">
                <div class="form-group">
                    <select name="status" id="status" class="form_pool"  >
                         <option value="0">...Seleccione...</option>
                         <option value="Embarcando">Embarcando</option>
                         <option value="En Transito">En Transito</option>
                         <option value="En puerto">En puerto</option>
                         <option value="Nacionalizando">Nacionalizando</option>
                         <option value="Proceso Culminado">Proceso Culminado</option>
                      
                         
                    </select>
                </div>
                
                <button type="submit" class="btn btn-default">Buscar</button>
            </form>
          
            <p class="navbar-text pull-right">
            
            Bienvenid@ <?php echo $nombreE; ?> - <a href="logout.php" class="navbar-link">Salir</a>
        </p>
      
        </div>
</nav>
            
        </div>
    
<div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12">
    			<?php   
if(isset($_POST["cargar_inf"])){
    // Recibimos por POST los datos procedentes del formulario   
$bl = $_POST["bl"];   
$container = $_POST["container"]; 
$cargasuelta = $_POST["cargasuelta"];
$origen = $_POST["origen"];
$mercancia = $_POST["mercancia"]; 
$unidades = $_POST["unidades"];
$proveedor = $_POST["proveedor"]; 
$empresa = $_POST["empresa"];      
$fechasalida = $_POST["fechasalida"];
$fechallegada = $_POST["fechallegada"];  
$status = $_POST["status"];   
$observaciones = $_POST["observaciones"];
$fecha_a=date('Y-m-dHis');   
$i=0;

    $rs = mysql_query("SELECT id FROM reporte_pd ORDER BY id DESC");
    $row = mysql_fetch_row($rs);
        $id_reporte = $row[0];
    

if(isset($_FILES['archivo'])){
    $sQuery=("INSERT INTO `reporte_pd` (`id`, `container`,`cargasuelta`, `bl`, `mercancia`, `unidades`, `proveedor`, `empresa`, `expdua`, `fechasalida`, `fechallegada`, `status`, `observaciones`, `origen`) "
            . "VALUES (NULL, '$container','$cargasuelta', '$bl', '$mercancia', '$unidades', '$proveedor', '$empresa', '', '$fechasalida', '$fechallegada', '$status', '$observaciones', '$origen');");
    @mysql_query($sQuery);
    foreach ($_FILES['archivo']['error'] as $key => $error){
        if ($error == UPLOAD_ERR_OK) {
            $url="images/FacPDF/".$fecha_a.$_FILES["archivo"]["name"][$i];
            move_uploaded_file($_FILES['archivo']['tmp_name'][$i],$url) or die("Ocurrio un problema al intentar subir el archivo.");
            $sQuery=("INSERT INTO `imagen` (`id`, `id_reporte`, `url`) VALUES (NULL, ($id_reporte+1), '$url');");
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
} else { 
        ?>
	<table border="1" align="center" class="table table-striped table-condensed table-responsive">
                        <tbody id="cuerpo_tabla_cabeceras">
                        <tr>
                            <td><b>Numero</b></td>
                            <td><b>Documentos</b></td>
                            <td align="center"><b>Bl.</b></td>
                            <td><b>Contenedor(es)</b></td>
                            <td><b>Carga Suelta</b></td>
                            <td><b>Origen</b></td>
                            <td><b>Mercancia</b></td>
                            <td><b>Unidades</b></td>
                            <td><b>Proveedor</b></td>
                            <td><b>Empresa</b></td>
                            <td><b>Fecha Salida</b></td>
                            <td><b>Fecha Llegada</b></td>
                            <td align="center"><b>Status</b></td>
                            <td><b>observaciones</b></td>
                            <td><b>Exp. y Dua</b></td>
                        </tr>
                        </tbody>
                      <tbody id="cuerpo_tabla">
                      <?php
							//select all records form tblmember table
		 					$query = "SELECT * FROM reporte_pd ORDER BY id DESC";
		 					//execute the query using mysql_query
							$result = @mysql_query($query);
							//then using while loop, it will display all the records inside the table
							while ($row = mysql_fetch_array($result)) {
                                                                echo ' <tr> ';
								echo ' <td> ';
								echo $row["id"];
								echo ' </td><td> ';
								echo $row["factura"];
								echo ' </td><td> ';
                                echo $row["bl"];
								echo ' </td><td> ';
								echo $row["container"];
								echo ' </td><td> ';
                                                                echo $row["cargasuelta"];
								echo ' </td><td> ';
								echo $row["origen"];
								echo ' </td><td> ';
								echo $row['mercancia'];
								echo ' </td><td> ';
                                                                echo $row['unidades'];
								echo ' </td><td> ';
								echo $row['proveedor'];
								echo ' </td><td> ';
								echo $row['empresa'];
								echo ' </td><td> ';
								echo $row['status'];
								echo ' </td><td> ';
								echo $row['fechasalida'];
								echo ' </td><td> ';
								echo $row['fechallegada'];
								echo ' </td><td> ';
								echo $row['observaciones'];
								echo '</td><td>';
                                echo $row["expdua"];
								echo ' </td></tr> ';
							}
                                                        echo "<button type='submit' class='btn btn-success' onclick='history.back()'>Regresar</button>";
                                                }
} else {

?>	
       
               	 
       	   <form role="form" enctype="multipart/form-data" multiple="multiple" action="reporte_pd.php" method="POST">
               <ul>
		<li>
           <div class="form-group">
            <label for="file">Subir Documentos:</label>
           </div>
            <div class="form-group">        
            <input type="hidden" name="MAX_FILE_SIZE" value="7000000" />
            <input name="archivo[]" class="multi form-control" type="file" id="archivo" placeholder="Adjunte Imagen" />
            
           </div>
                </li>
               </ul>
    <table border="1" class="table table-striped table-condensed">
        
        <tr class="form_label"><td>Nº BL:</td>	
				<td><p>
				    <input type="text" name="bl" id="bl" >
                                     </p></td></tr>
               	<tr class="form_label">

				<tr class="form_label">
				  <td>Contenedor(es):</td>
				  <td><p>
				    <input type="text" align="center" name="container" id="container">
		     </p></td></tr>
                                <tr class="form_label">

		<tr class="form_label">
				  <td>Carga Suelta:</td>
				  <td><p>
				    <input type="text" align="center" name="cargasuelta" id="cargasuelta">
		     </p></td></tr>
             
             <tr class="form_label">
				  <td>Origen:</td>
				  <td><p>
				    <input type="text" name="origen" id="origen">
		     </p></td></tr>
                  
				<tr class="form_label">
				  <td>Mercancia:</td>
				  <td><p>
				    <input name="mercancia" id="mercancia">
                    </p>
                     <tr class="form_label">
				  <td>Unidades:</td>
				  <td><p>
				    <input type="text" name="unidades" id="unidades">
		     </p></td></tr>
                    <tr class="form_label">
				  <td>Proveedor:</td>
				  <td><p>
				    <select name="proveedor" id="proveedor" class="form_pool" >
				      <option value="0">...Seleccione...</option>
                      <option value="Panalux HK">Panalux HK</option>
                      <option value="Global Trade">Global Trade</option>
                      <option value="Motoport USA">Motorport USA</option>
                       </select>
				</p>
				    
				<tr class="form_label"><td>Naviera:</td>	
				<td><p>
			      <input name="empresa" id="empresa">
				    
				</p>
                
                </tr>
                
      
			    <tr>
                               	    <td valign="center" title="Fecha de Creacion de la Guia desde - hasta">Fecha:</td>
  <td>
    <input  type="date" name="fechasalida" value="<?php echo date("Y-m-d");?>">
	<input  type="date" name="fechallegada" value="<?php echo date("Y-m-d");?>">
</td>
      </tr>
      <tr class="form_label">
				  <td>Status:</td>
				  <td><p>
				   <select name="status" id="status" class="form_pool"  >
                         <option value="0">...Seleccione...</option>
                         <option value="Embarcando">Embarcando</option>
                         <option value="En Transito">En Transito</option>
                         <option value="En puerto">En puerto</option>
                         <option value="Nacionalizando">Nacionalizando</option>
                         <option value="Proceso Culminado">Proceso Culminado</option>
                        
                         
                    </select>
				  </p></td></tr>
				
				<tr class="form_label"><td>Observaciones:</td><td><textarea id="observaciones" name="observaciones" cols="25" rows="7"></textarea></td></tr>
	  <tr><td colspan="2" align="center">
      
      
      <input type="SUBMIT" class="form_botones" name="cargar_inf" id="cargar_inf" value="Cargar" >&nbsp;&nbsp;<input type="reset" class="form_botones" name="limpiar" id="limpiar" value="Limpiar" ></td></tr>
				
                
                
           </form>
           
           <?php
		   

$url = "../importaciones/reporte_pd.php";

$consulta_noticias = "SELECT * FROM reporte_pd";
$rs_noticias = @mysql_query($consulta_noticias);
$num_total_registros = @mysql_num_rows($rs_noticias);
//Si hay registros
if ($num_total_registros > 0) {
	//Limito la busqueda
	$TAMANO_PAGINA = 10;
        $pagina = false;

	//examino la pagina a mostrar y el inicio del registro a mostrar
        if (isset($_GET["pagina"]))
            $pagina = $_GET["pagina"];
        
	if (!$pagina) {
		$inicio = 0;
		$pagina = 1;
	}
	else {
		$inicio = ($pagina - 1) * $TAMANO_PAGINA;
	}
	//calculo el total de paginas
	$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
        ?>
           
                <br><br>

                    <table width="190%" border="1" class="table table-striped table-condensed table-responsive">
                        <tbody id="cuerpo_tabla_cabeceras">
                        <tr>
                            <td><b>Numero</b></td>
                            <td><b>Documentos</b></td>
                            <td align="center"><b>BL</b></td>
                            <td><b>Contenedor(es)</b></td>
                            <td><b>Carga Suelta</b></td>
                            <td><b>Origen</b></td>
                            <td><b>Mercancia</b></td>
                            <td><b>Unidades</b></td>
                            <td><b>Proveedor</b></td>
                            <td><b>Naviera</b></td>
                            <td><b>Fecha Salida</b></td>
                            <td><b>Fecha Llegada</b></td>
                            <td align="center"><b>Status</b></td>
                            <td><b>observaciones</b></td>
                            <td><b>Exp. y Dua</b></td>
                        </tr>
                        
                        
                        </tbody>
                      <tbody id="cuerpo_tabla">
                      <?php
	
	$consulta = "SELECT * FROM reporte_pd WHERE status!='Anulado' ORDER BY id DESC LIMIT ".$inicio."," . $TAMANO_PAGINA;
	$rs = @mysql_query($consulta);
	while ($row = @mysql_fetch_array($rs)) {
		$id= $row["id"]; 
                                                             $query2 = 'SELECT url FROM imagen WHERE id_reporte='.$id;
                                                             $result2 = @mysql_query($query2);
                                                             $filas= mysql_num_rows($result2); 
								
                                           
                                                           
                                                          
								echo ' <tr> ';
								echo ' <td> ';
								echo $row["id"];
								echo ' </td><td> ';
                                                                while ($row2 = mysql_fetch_row($result2)){
                                                                    echo '<a href="'.$row2[0].'" target="_blank"><img src="images/fact.png" width="40%"/></a>';
                                                                }
								echo ' </td><td> ';
                                                                echo $row["bl"];
								echo ' </td><td align="center"> ';
								echo $row["container"];
								echo ' </td><td align="center"> ';
                                                                echo $row["cargasuelta"];
								echo ' </td><td align="center"> ';
								echo $row["origen"];
								echo ' </td><td align="center"> ';
								echo $row['mercancia'];
								echo ' </td><td align="center"> ';
                                                                echo $row['unidades'];
								echo ' </td><td align="center"> ';
								echo $row['proveedor'];
								echo ' </td><td> ';
								echo $row['empresa'];
								echo ' </td><td align="center"> ';
								echo $row['fechasalida'];
								echo ' </td><td align="center"> ';
								echo $row['fechallegada'];
								echo ' </td><td> ';
								echo $row['status'];
								echo ' </td><td> ';
								echo $row['observaciones'];
								echo '</td><td>';
                                                                echo $row["expdua"];
								echo ' </td><td> ';
                                
								echo '<div class="btn-group">';
                                                                        echo '<a href="editando.php?id='.$id.'"><button type="button" class="btn btn-success btn-xs">Editar</button></a>';   
                                                                       
							echo '</td></tr>';
                                                        
                                                       
																		                             
							}
	
							?>	
                            
                        </tbody>
                       
                        </table>
<?php
}
}
?>
	
    <nav>
    <div align="center">
<?php
echo '<p>';

	if ($total_paginas > 1) {
		if ($pagina != 1)
			echo '<a href="'.$url.'?pagina='.($pagina-1).'"><img src="images/izq.gif" border="0"></a>';
		for ($i=1;$i<=$total_paginas;$i++) {
			if ($pagina == $i)
				//si muestro el ï¿½ndice de la pï¿½gina actual, no coloco enlace
				echo $pagina;
			else
				//si el ï¿½ndice no corresponde con la pï¿½gina mostrada actualmente,
				//coloco el enlace para ir a esa pï¿½gina
				echo '  <a href="'.$url.'?pagina='.$i.'">'.$i.'</a>  ';
		}
		if ($pagina != $total_paginas)
			echo '<a href="'.$url.'?pagina='.($pagina+1).'"><img src="images/der.gif" border="0"></a>';
	}
	echo '</p>';

?>
</div>
</nav>
</div>
</div>
</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    		<script src="js/bootstrap.min.js"></script>
            <script src="js/jquery.MultiFile.js" type="text/javascript"></script>
</body>
</html>
