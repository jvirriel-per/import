<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

require_once('funciones.php');
conectar('10.10.3.164', 'root', 'localhost', 'importaciones');

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<link href="css/bootstrap.min.css" rel="stylesheet"/>
        <link href="css/styles.css" rel="stylesheet" />
<title>Lista de Importaciones</title>
</head>

<body>
<div class="container">
    <div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12" ><img src="images/ImportacionesCyberlux.png" width="100%"/></div>
  </div>
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
            <form class="navbar-form navbar-left" role="search" action="buscarS2.php" method="POST">
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
            
            Bienvenid@ Señor Yaser - <a href="" class="navbar-link"></a>
        </p>
      
        </div>
</nav>
        
<h1><center>Lista de Productos Importación</center>
</h1>
 
      <?php
		   

$url = "../importaciones/Lista.php";

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

                    <table border="1" class="table table-striped table-condensed">
                        <tbody id="cuerpo_tabla_cabeceras">
                        <tr>
                            <td><b>Numero</b></td>
                            <td><b>Factura</b></td>
                            <td align="center"><b>Bl.</b></td>
                            <td><b>Contenedor(es)</b></td>
                            <td><b>Carga Suelta</b></td>
                            <td><b>Origen</b></td>
                            <td><b>Mercancia</b></td>
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
								echo ' </td><td> ';
								echo $row["container"];
								echo ' </td><td> ';
                                                                echo $row["cargasuelta"];
								echo ' </td><td> ';
								echo $row["origen"];
								echo ' </td><td> ';
								echo $row['mercancia'];
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
								echo ' </td>';
																		                             
							}
	
							?>	
                            
                        </tbody>
                       
                        </table>
<?php
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
 


		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>