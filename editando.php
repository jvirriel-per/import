<?php
require_once("seg.php");
require_once('funciones.php');
conectar('10.10.3.164', 'root', 'localhost', 'importaciones');
$nombreE = $_SESSION["nombre"];
$id = $_GET["id"]; 
$id2 = $id;
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
            <p class="navbar-text pull-right">
            Bienvenid@ <?php echo $nombreE; ?> - <a href="logout.php" class="navbar-link">Salir</a>
        </p>
      
        </div>
</nav>
            
        </div>
    
<div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12">
    			
	
       
               	 <table border="1" class="table table-striped table-condensed">
               	<tr class="form_label">
                <form action="editar.php" method="POST">
    
   <?php
   $query = 'SELECT * FROM reporte_pd WHERE id='.$id;
		 					//execute the query using mysql_query
							$result = @mysql_query($query);
							
							//then using while loop, it will display all the records inside the table
							while ($row = mysql_fetch_array($result)) {
                                                            echo '<input type="hidden" name="id" value="'.$id.'"/>';
                                  echo'<td>Nº BL:</td>
				  <td><p>
				    <input name="bl" type="text" id="bl" cols="25" rows="7" value="'.$row["bl"].'">
                    </p>
	  <tr><td colspan="2" align="center">';   
                                  
                                  echo'<tr class="form_label"><td>Contenedor(es):</td>
				  <td><p>
				    <input name="container" type="text" id="container" cols="25" rows="7" value="'.$row["container"].'">
                    </p>
	  <tr><td colspan="2" align="center">';
                                  
                                  echo'<tr class="form_label"><td>Carga Suelta:</td>
				  <td><p>
				    <input name="cargasuelta" type="text" id="cargasuelta" cols="25" rows="7" value="'.$row["cargasuelta"].'">
                    </p>
	  <tr><td colspan="2" align="center">';
                                  
                                  echo'<tr class="form_label"><td>Origen:</td>
				  <td><p>
				    <input name="origen" type="text" id="origen" cols="25" rows="7" value="'.$row["origen"].'">
                    </p>
	  <tr><td colspan="2" align="center">';
                                  
                                                            
   echo'<tr class="form_label"><td>Mercancia:</td>
				  <td><p>
				    <input name="mercancia" type="text" id="mercancia" cols="25" rows="7" value="'.$row["mercancia"].'">
                    </p>
	  <tr><td colspan="2" align="center">';
   
   echo'<tr class="form_label"><td>Unidades:</td>
				  <td><p>
				    <input name="unidades" type="text" id="unidades" cols="25" rows="7" value="'.$row["unidades"].'">
                    </p>
	  <tr><td colspan="2" align="center">';
   
   
      ?>
                    
                    <tr class="form_label">
				  <td>Proveedor:</td>
				  <td><p>
                                          <?php
				    echo'<select name="proveedor" id="proveedor" class="form_pool" >';
				    echo'  <option value="'.$row["proveedor"].'">'.$row["proveedor"].'</option>';
                                    switch($row["proveedor"]){
                                        case "Panalux HK":
                                            echo'  <option value="Global Trade"> Global Trade </option>';
                                            echo'  <option value="Motoport USA"> Motoport USA </option>';
                                        break;
                                        case "Global Trade":
                                            echo'  <option value="Panalux"> Panalux HK </option>';
                                            echo'  <option value="Motoport USA"> Motoport USA </option>';
                                        break;
                                        case "Motoport USA":
                                            echo'  <option value="Panalux"> Panalux HK </option>';
                                            echo'  <option value="Global Trade"> Global Trade </option>';
                                        break;
                                    
                      }
                      
                      echo' </select>';
				echo'</p>';
                                
                                echo'<tr class="form_label"><td>Naviera:</td>
				  <td><p>
				    <input name="empresa" type="text" id="empresa" cols="25" rows="7" value="'.$row["empresa"].'">
                    </p>
	  <tr><td colspan="2" align="center">';
                                
                                echo'<tr>
                               	    <td valign="center" title="Fecha de Creacion de la Guia desde - hasta">Fecha:</td>
  <td>
    <input  type="date" name="fechasalida" value="'.$row["fechasalida"].'">
	<input  type="date" name="fechallegada" value="'.$row["fechallegada"].'">
</td>
      </tr>';
                                
                                            ?>
      <tr class="form_label">
				  <td>Status:</td>
				  <td><p>
                 
				  	<?php
				  
				
				  echo' <select name="status" id="status" class="form_pool"  >';
                      echo'   <option value="'.$row["status"].'">'.$row["status"].'</option>';
                      if ($row["status"]=="Embarcando"){
                          echo' <option value="En Transito">En Transito</option>';
                         echo'<option value="En puerto">En puerto</option>';
                         echo'<option value="Nacionalizando">Nacionalizando</option>';
                         echo'<option value="Proceso Culminado">Proceso Culminado</option>';
                         echo'<option value="Anulado">Anulado</option>';
                      }else{
                          if ($row["status"]=="En Transito"){
                          echo' <option value="Embarcando">Embarcando</option>';
                          echo'<option value="En puerto">En puerto</option>';
                         echo'<option value="Nacionalizando">Nacionalizando</option>';
                         echo'<option value="Proceso Culminado">Proceso Culminado</option>';
                          echo'<option value="Anulado">Anulado</option>';
                      }else{
                          if ($row["status"]=="En puerto"){
                          echo' <option value="Embarcando">Embarcando</option>';
                         echo' <option value="En Transito">En Transito</option>';
                         echo'<option value="Nacionalizando">Nacionalizando</option>';
                         echo'<option value="Proceso Culminado">Proceso Culminado</option>';
                          echo'<option value="Anulado">Anulado</option>';
                      }else{
                          if ($row["status"]=="Nacionalizando"){
                          echo' <option value="Embarcando">Embarcando</option>';
                         echo' <option value="En Transito">En Transito</option>';
                         echo'<option value="En puerto">En puerto</option>';
                         echo'<option value="Proceso Culminado">Proceso Culminado</option>';
                          echo'<option value="Anulado">Anulado</option>';
                      }
                      if ($row["status"]=="Anulado"){
                          echo' <option value="Embarcando">Embarcando</option>';
                         echo' <option value="En Transito">En Transito</option>';
                         echo'<option value="En puerto">En puerto</option>';
                         echo'<option value="Proceso Culminado">Proceso Culminado</option>';
                         echo'<option value="Nacionalizando">Nacionalizando</option>';
                      }
                      else {
                         echo' <option value="Embarcando">Embarcando</option>';
                         echo' <option value="En Transito">En Transito</option>';
                         echo'<option value="En puerto">En puerto</option>';
                         echo'<option value="Nacionalizando">Nacionalizando</option>';
                          echo'<option value="Anulado">Anulado</option>';
                         }
                      }
                      }
                      }
                      
                      
                      
                        
                         
                  echo'  </select>';
				 echo' </p></td></tr>';
				
								echo'<tr class="form_label"><td>Observaciones:</td><td><textarea id="observaciones" name="observaciones" cols="25" rows="7" >'.$row["observaciones"].'</textarea></td></tr>
	  <tr><td colspan="2" align="center">';
                                                                
                                 echo'<tr class="form_label"><td>Exp. y Dua:</td>
				  <td><p>
				    <input name="expdua" type="text" id="expdua" cols="25" rows="7" value="'.$row["expdua"].'">
                    </p>
	  <tr><td colspan="2" align="center">';                               
								}
				
      ?>
      
      <input type="SUBMIT" class="form_botones" name="cargar_inf" id="cargar_inf" value="Editar" >&nbsp;&nbsp;<input type="reset" class="form_botones" name="limpiar" id="limpiar" value="Limpiar" ></td></tr>
                </form>	
                 </table>

        </div>
    
    
    <div class="col-lg-12 col-md-12 col-xs-12">
        <table border="1" class="table table-striped table-condensed">
            <form action="editar2.php" method="POST">
            <thead>
                <tr class="form_label">
                    
                    <td> Seleccionar:</td>
				   <td> Documento:</td>
                                    
               
            </thead>
            <?php
            $query3 = 'SELECT * FROM imagen WHERE id_reporte='.$id2;
		 					//execute the query using mysql_query
							$result3 = @mysql_query($query3);
							
							//then using while loop, it will display all the records inside the table
							while ($row3 = mysql_fetch_array($result3)) {
                                                      echo "<tr><td> <input type='radio' name='eleimagen' value='".$row3['id']."'/>" ;  
                                                      echo '<td> <a href="'.$row3["url"].'" target="_blank"><img src="images/fact.png" width="10%"/></a> </td></tr>';
                                                      
                                                        }
            
            ?>
            <input type="SUBMIT" class="form_botones" name="eleimagen" id="eleimagen" value="Eliminar" > 
            </form>
            
        </table>
        
        
        <br>
        <form role="form" enctype="multipart/form-data" multiple="multiple" action="editar3.php" method="POST">
            <ul>
		<li>
                    <div class="form-group">
        <label for="file">Subir Documentos:</label>
           </div>
            <div class="form-group">        
            <input type="hidden" name="MAX_FILE_SIZE" value="7000000" />
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <input name="arc[]" class="multi form-control" type="file" id="arc" placeholder="Adjunte Imagen" />
            
           </div>
             <input type="SUBMIT" class="form_botones" name="arc" id="arc" value="Cargar" > 
                </li>
               </ul>
        </form>
            
    </div>
            
</div>
    
                
          
              


    

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    		<script src="js/bootstrap.min.js"></script>
                <script src="js/jquery.MultiFile.js" type="text/javascript"></script>
</body>
</html>
