<?php
require_once("seg.php");
require_once('funciones.php');
conectar('10.10.3.164', 'root', 'localhost', 'importaciones');
$nombreE = $_SESSION["nombre"];
$status= $_POST['status'];
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
                <li class="active"><a href="reporte_pd.php">Reporte General</a></li>
            </ul>
             <ul class="nav navbar-nav">
                 <li class="active"><a href="Lista_anulado.php">Anulados</a></li>
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
            Bienvenid@ <?php echo $nombreE; ?> -
        </p>
      
        </div>
</nav>
            
        </div>
    
<div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12">
    			<h2 class="text-center">Lista de Importaciones por Status <?php echo $status; ?></h2>
    			
    			<hr width="70%">
			
			<br><br>

                    <table border="1" class="table table-striped table-condensed">
                        <tbody id="cuerpo_tabla_cabeceras">
                        <tr>
                            <td><b>Numero</b></td>
                            <td><b>Documentos</b></td>
                            <td align="center"><b>Nº BL</b></td>
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
					  <?php
							//select all records form tblmember table
		 					$query = "SELECT *  FROM reporte_pd WHERE status='".$status."' ORDER BY id DESC";
		 					//execute the query using mysql_query
							$result = @mysql_query($query);
							
							//then using while loop, it will display all the records inside the table
							while ($row = mysql_fetch_array($result)) {
                                                             
                                                            
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

//echo '<a href="'.$row["factura"].'" target="_blank"><img src="images/fact.png" width="20%"/></a>';
								
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
								echo $row['fechasalida'];
								echo ' </td><td> ';
								echo $row['fechallegada'];
								echo ' </td><td> ';
								echo $row['status'];
								echo ' </td><td> ';
								echo $row['observaciones'];
								echo '</td><td>';
                                                                echo $row["expdua"];
								echo ' </td><td> ';
                                
								
								echo '<div class="btn-group">';
                                                                        echo '<form action="editando.php" method="POST"><button name="id" type="submit" class="btn btn-success btn-xs" value="'.$id.'">Editar</button></form>';   
							echo '</td></tr>';
																		                             
							}	
                                                
							?>
					</tbody>
				</table>
			</div>
                        <button type="submit" class="btn btn-success" onClick="history.back()">Regresar</button>
	</div>
 
</div>
</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    		<script src="js/bootstrap.min.js"></script>
</body>
</html>
