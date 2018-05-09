<?php 
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

/*
*Desarrollador: Jose Virriel
*Fecha: 1-12-2015
*/
include ('../lib/php/menu.php');
 include ('../lib/core.lib.php');
 include ('../css/cxfactweb.php');
 if($_SESSION['tipo_authuser']=='1' || $_SESSION['tipo_authuser']=='2'){
 }else{
      header('Location: cerrar_sesion.php');
 }
//--- G  E  T
//$obj_empr				esa= new class_empresa;
//$arr_empresa=$obj_empresa->get_empresa('','',1,'','','','',1);
//$obj_sucursal= new class_sucursal;
//$arr_sucursal=$obj_sucursal->get_sucursal('');
//--- F  I  N     G  E  T



?>
<?php   
if(isset($_POST["cargar_inf"]))
{
	

// Recibimos por POST los datos procedentes del formulario   

$container = $_POST["container"];   
$tipol = $_POST["tipol"];   
$mercancia = $_POST["mercancia"]; 
$empresa = $_POST["empresa"];   
$almacens = $_POST["almacens"];   
$fechasalida = $_POST["fechasalida"];
$fechallegada = $_POST["fechallegada"];  
$status = $_POST["status"];   
$observaciones = $_POST["observaciones"];

// Abrimos la conexion a la base de datos   
include("../lib/conn.php");   
/*
INSERT INTO reporte_pd (container,tipol,mercancia,empresa,almacens,fechasalida,fechallegada,status,observaciones) VALUES ('$container','$tipol','$mercancia','$empresa','$almacens','$fechasalida','$fechallegada','$status','$observaciones')"*/
echo "   
<p>Los datos han sido guardados con exito.</p> 

<p><a href='javascript:history.go(-1)'>VOLVER ATRÁS</a></p>   
";


// Cerramos la conexion a la base de datos   
include("../lib/conn.php"); 

// Confirmamos que el registro ha sido insertado con exito   
   
$i=0;
if(isset($_FILES['archivo'])){
    foreach ($_FILES['archivo']['error'] as $key => $error){
        if ($error == UPLOAD_ERR_OK) {
            $factura="../FacPDF/".$_FILES["archivo"]["name"][$i];
            move_uploaded_file($_FILES['archivo']['tmp_name'][$i],$factura) or die("Ocurrio un problema al intentar subir el archivo.");
            $GRABAR_SQL = "INSERT INTO `reporte_pd` (`id`, `factura` `container`, `tipol`, `mercancia`, `empresa`, `almacens`, `fechasalida`, `fechallegada`, `status`, `observaciones`) VALUES (NULL,'$factura', '$container', '$tipol', '$mercancia', '$empresa', '$almacens', '$fechasalida', '$fechallegada', '$status', '$observaciones');";

mysql_query($GRABAR_SQL);
        }
        $i++;
    }
}
 
} else {
?>   
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="image/x-icon" rel="shortcut icon" href="../images/icono.ico">
<link href="../css/cyberlux.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="all"  href="../lib/js/calendar/skins/aqua/aqua.css"  title="win2k-cold-1" />
<title><?php echo SYSTEM_NAME; ?></title>
<script type="text/javascript" src="../lib/js/jquery/jquery-1.2.1.js"></script>
<script type="text/javascript" src="../lib/js/funciones.js"></script>
<script type="text/javascript" src="../lib/js/calendar/calendar.js"></script>
<script type="text/javascript" src="../lib/js/calendar/lang/calendar-es.js"></script>
<script type="text/javascript" src="../lib/js/calendar/calendar-setup.js"></script>
<script language="javascript">
function enviar(numero,sucursal,id_nomina){
	var sucur=document.getElementById('id_sucursal').value.split('|');
	//alert(sucur[1]);
	//document.getElementById('id_sucursal').value=sucur[0];
	imprimir_cheque(numero,sucursal,id_nomina,sucur[1]);
}
</script>
</head>

<body id="todo"> 


  <div id="sustituir">
  
<div  class="marco" style="padding: 70px;float: left;margin: auto;margin-left: 20px;margin-bottom: 15px;width: 70%;" >

<!-- CODIGO PARA CUENTA REGRESIVA

<!--<center><span class="Apple-style-span" style="color: red; font-family: 'Trebuchet MS', sans-serif;">Faltan solamente</span></center><center><script language="JavaScript" type="text/javascript">
//<![CDATA[ CUENTA REGRESIVA
TargetDate = "12/24/2015 11:59 PM";
BackColor = "white";
ForeColor = "black";
CountActive = true;
CountStepper = -1;
LeadingZero = true;
DisplayFormat = "%%D%% Días, %%H%% Horas, %%M%% Minutos, %%S%% Segundos";
FinishMessage = "Feliz fin del mundo!!!";
//]]>
</script><script language="JavaScript" src="http://scripts.hashemian.com/js/countdown.js" type="text/javascript">
</script></center><center><span class="Apple-style-span" style="color: red; font-family: 'Trebuchet MS', sans-serif;">Para el fin del mundo</span></center>-->
       <input type="hidden" id="cantidad_filas" name="cantidad_filas" />
         <div id="tabla" align="center">
           <form name="form1">
                                	<table width="80%" border="1"  style="border-collapse:collapse;border-color: white;"  >
<!--<div id="capa_superior" style="display:none; background-color:  #848484;" align="center"></div>
            <div id="capa_superior1" class="sombra12" style="display:none; "> </div>
    <div id="contenedor" >
		  <div id="header" ></div>-->
  <div id="menu" >
    <?php include ("../lib/common/menu_superior.php");?>
  </div>
  <div id="contenido" > 
          	<div id="menu_visual" ></div>
            <div id="espacio_trabajo" >
            <br/>
            <span class="form_titulo">Reporte General</span>
              <!--AQUI VA EL CONTENIDO CAMBIANTE Y DEMAS COMO TAL EL FORMULARIO DEL SISTEMA-->
              <form name="form1" id="form1" action="anular_orden_pago.php" method="post"  >
              <input type="hidden" name="monto_neto" id="monto_neto" value="0">
              <input type="hidden" name="iva" id="iva" value="0">
              <input type="hidden" name="monto_iva" id="monto_iva" value="0">
              <input type="hidden" name="retencion" id="retencion" value="0">
              <input type="hidden" name="retencion_monto" id="retencion_monto" value="0">
              <input type="hidden" name="pago_caja" id="pago_caja" value="0">
              <input type="hidden" name="pago_afiliado" id="pago_afiliado" value="0">
			  <input type="hidden" name="anulado" id="anulado" value="0">
               	 <table border="1" style="border-collapse:collapse;border-color:#00FFFF;">
               	<tr class="form_label">
       	   <form enctype="multipart/form-data" action="reporte_pd.php" method="POST">
    <label for="file">Subir Factura:</label>
    <span class="form-group">
    <input name="archivo[]" class="multi form-control" type="file" id="archivo" placeholder="Adjunte Imagen" />
    </span>
    <div class="resultado">

				<tr class="form_label">
				  <td>Container</td><td><p>
				    <input type="text" name="container" id="container" onkeypress="elim_Punto('monto_orden',0);" onkeyup="elim_Punto('monto_orden',1);">
		     </p></td></tr>
                  <tr class="form_label"><td>Tipo de Linea:</td>	
				<td><p>
				    <input type="text" name="tipol" id="tipol" >
				<tr class="form_label">
				  <td>Mercancia</td><td><p>
				    <input name="mercancia" id="mercancia" onkeypress="elim_Punto('monto_orden',0);" onkeyup="elim_Punto('monto_orden',1);">
				    
				<tr class="form_label"><td>Empresa:</td>	
				<td><p>
			      
				    <select name="empresa" id="empresa" class="form_pool" >
				      <option value="0">...Seleccione...</option>
                      <option value="Cyberlux">Cyberlux</option>
                      <option value="Frigilux">Frigilux</option>
                      <option value="Sigma">Sigma</option>
                      <option value="Consesionarialux">Consesionaria Lux</option>
                      <option value="Lumiere">Lumiere</option>
                      
				      
			      </select>
				</p>
                
                </tr>
                <tr>
                   <td  class="form_label" >Almacen de sucursal :</td>
                   <td>
                     <p>
                       <select name="almacens" id="almacens" class="form_pool"  >
                         <option value="0">...Seleccione...</option>
                         <option value="Guacara">Guacara</option>
                         
                       </select>
                     </p></td>
      </tr>
			    <tr>
                               	    <td valign="center" title="Fecha de Creacion de la Guia desde - hasta">Fecha</td>
                               	    <td><input name="fechasalida" type="text" id="fechasalida"   readonly="readonly" value="<?php echo $_GET['fechasalida'];?>" />
                                <script type="text/javascript">
                                    Calendar.setup({
                                        inputField     :    "fechasalida",     // id of the input field
                                        ifFormat       :    "%d/%m/%Y",      // format of the input field
                                        button         :    "fechasalida",  // trigger for the calendar (button ID)
                                        align          :    "Bl",           // alignment (defaults to "Bl")
                                        singleClick    :    true
                                    });
                                </script>
                                    </td>
                               	    <td>
                                      <p>
                                        <input name="fechallegada" type="text" id="fechallegada"   readonly="readonly" value="<?php echo $_GET['fechallegada'];?>"  />
                                    <script type="text/javascript">
                                    Calendar.setup({
                                        inputField     :    "fechallegada",     // id of the input field
                                        ifFormat       :    "%d/%m/%Y",      // format of the input field
                                        button         :    "fechallegada",  // trigger for the calendar (button ID)
                                        align          :    "Bl",           // alignment (defaults to "Bl")
                                        singleClick    :    true
                                    });
                                      </script></p></td>
      </tr>
      <tr class="form_label">
				  <td>Status</td><td><p>
				   <select name="status" id="status" class="form_pool"  >
                         <option value="0">...Seleccione...</option>
                         <option value="Saliendo">Saliendo</option>
                         <option value="En camino">En camino</option>
                         <option value="Llegando">Llegando</option>
                         <option value="En almacen">En almacen</option>
                         
                       </select>
				  </p></td></tr>
				
				<tr class="form_label"><td>Observaciones:</td><td><textarea id="observaciones" name="observaciones" cols="25" rows="7"></textarea></td></tr>
	  <tr style="background-color:#00FFFF;"><td colspan="2" align="center">
      
      
      <input type="SUBMIT" class="form_botones" name="cargar_inf" id="cargar_inf" value="Cargar" >&nbsp;&nbsp;<input type="reset" class="form_botones" name="limpiar" id="limpiar" value="Limpiar" ></td></tr>
				
                
                <table border="0">
               	 <?php
               	 echo $imprimir;
               	 ?>
      </table>
           </form>
             
              <!--AQUI VA EL CONTENIDO CAMBIANTE Y DEMAS COMO TAL EL FORMULARIO DEL SISTEMA-->
          </div>
  </div>
          
		 <!-- <div id="footer" >
		  	<?php
}/*?><?php include ("../lib/common/footer.php"); ?><?php */?>
          </div>-->
</div>
<div id="total" class="marco" style="width:97%;clear: both;padding-top: 10px;margin: 10px;position:relative;">
          
          <div style="clear: both;margin-bottom: 10px;"><!--<input type="button" style="width:200px;height:50px; " onclick="crearfila('cuerpo_tabla')" value="Agregar BL House">--></div>

                    <table border="1" width="100%" style="border-collapse:collapse;">
                        <tbody id="cuerpo_tabla_cabeceras">
                        <tr>
                            <td><b>Numero</b></td>
                            <td><b>Factura</b></td>
                            <td><b>Container</b></td>
                            <td><b>Tipo de Linea</b></td>
                            <td><b>Mercancia</b></td>
                            <td><b>Empresa</b></td>
                            <td><b>Almacen</b></td>
                            <td><b>Status</b></td>
                            <td><b>observaciones</b></td>
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
								echo $row["container"];
								echo ' </td><td> ';
								echo $row['tipol'];
								echo '</td><td> ';
								echo $row['mercancia'];
								echo ' </td><td> ';
								echo $row['empresa'];
								echo ' </td><td> ';
								echo $row['almacens'];
								echo ' </td><td> ';
								echo $row['status'];
								echo ' </td><td> ';
								echo $row['observaciones'];
								echo '</td></tr>';
                                                                
							}	
 
							?>	
                        </tbody>
                        </table>
         <!--<table border="0" width="100%" style="border-collapse:collapse;">
            <tr>
              <td align="center"><input type="button" value="Guardar" onclick="enviar();"></td>
            </tr>
          </table>-->
          <div id="tabla_cheq"></div>
                    <br>
                    <div id="pregunta" class="pregunta" align="center"></div>
                </div>
</body>
</html> 
